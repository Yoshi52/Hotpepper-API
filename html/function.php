<?php

function h($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'utf-8');
}

function get_get($name){
    if(isset($_GET[$name]) === true){
      return $_GET[$name];
    };
    return '';
}

function get_post($name){
  if(isset($_POST[$name]) === true){
    return $_POST[$name];
  };
  return '';
}

function v($str) {
  return var_dump($str);
}

function get_url() {
  return (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

//表示件数を取得
function get_result($cnt, $page, $max_contents) {
  /*
  $cnt = 店の取得件数
  $page = 現在のページ数
  $max_contents = 1ページに表示できる最大件数 
   */
  if($cnt === 0) {
    return '';
  } else {
    if($cnt < $page * $max_contents) {
      if($page === 1) {
        return array(1, $cnt);
      } else {
        return array(($page - 1) * $max_contents + 1, $cnt);
      }
    } else {
      if($page === 1) {
        return array(1, $max_contents);
      } else {
        return array((($page - 1) * $max_contents) + 1, ($page * $max_contents));
      }
    }
  }
}

function getXml_shops($base_url, $args) { 
  $baseurl = $base_url;
  $params = array();
  $params['key'] = '2c70aac628cb9683';
  foreach($args as $key => $v){
    $params[$key] = $v;
  }

  $req = '';
  foreach ($params as $key => $v) {
    $req .= '&' . $key . '=' . $v;
  }
  $req = substr($req, 1);

  // リクエストURLに統合
  $url = $baseurl . '?' . $req;

  $xml = @simplexml_load_file($url) or die("XMLパースエラー");

  return $xml;
}

function getXml($base_url) { 
  $baseurl = $base_url;
  $params = array();
  $params['key'] = '2c70aac628cb9683';
  
  $req = '';
  foreach ($params as $key => $v) {
    $req .= '&' . $key . '=' . $v;
  }
  $req = substr($req, 1);

  // リクエストURLに統合
  $url = $baseurl . '?' . $req;

  $xml = @simplexml_load_file($url) or die("XMLパースエラー");

  return $xml;
}

function get_shops($params) {
  global $cnt;
  $xml = getXml_shops('http://webservice.recruit.co.jp/hotpepper/gourmet/v1/', $params);
  $shops = array();
  foreach($xml->shop as $shop){
    $shops[] = array(
                    'id'     => $shop->id,
                    'name'   => $shop->name,
                    'addres' => $shop->address,
                    'photo'  => $shop->photo->pc->m,
                    'catch'  => $shop->catch,
                    'genre'  => $shop->genre->name,
                    'budget' => $shop->budget->name
                    );
  }
  if(!empty($shops)) {
      $cnt = count($shops);
  } else {
      $cnt = 0;
  }
  return $shops; 
}

function get_genre() {
  $xml = getXml('http://webservice.recruit.co.jp/hotpepper/genre/v1/');
  $genres = array();
  foreach($xml->genre as $genre){
    $genres[] = array(
                      'code' => $genre->code,
                      'name' => $genre->name
                      );
  }
  return $genres;
}

function get_area() {
  $xml = getXml('http://webservice.recruit.co.jp/hotpepper/large_area/v1/');
  $large_areas = array();
  foreach($xml->large_area as $large_area){
    $large_areas[] = array(
                              'large_area_code' => $large_area->code,
                              'large_area_name' => $large_area->name
                              );
  }
  return $large_areas;
}

function get_page($totalpage) {
  if (isset($_GET["page"]) && $_GET["page"] > 0 && $_GET["page"] <= $totalpage) {
    return (int)$_GET['page'];
  } else {
    return 1;
  }
}
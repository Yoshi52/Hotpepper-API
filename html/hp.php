<?php
require_once 'function.php';

$url = "hp_process.php";

//範囲を取得
$range = array('' => '---', 1 => '300m', 2 => '500m', 3 => '1000m', 4 => '2000m', 5 => '3000m');

//ジャンルを取得
$xml = getXml('http://webservice.recruit.co.jp/hotpepper/genre/v1/');
$genres = array();
foreach($xml->genre as $genre){
  $genres[] = array(
                    'code' => $genre->code,
                    'name' => $genre->name
                    );
}

//エリアを取得
$xml = getXml('http://webservice.recruit.co.jp/hotpepper/large_area/v1/');
$large_areas = array();
foreach($xml->large_area as $large_area){
  $large_areas[] = array(
                            'large_area_code' => $large_area->code,
                            'large_area_name' => $large_area->name
                            );
}

//1ページに表示する件数
$max_contents = 10;
//最大ページ番号
$totalpage = (int)ceil($cnt / $max_contents);
$pagerange = 3;

if (isset($_GET["page"]) && $_GET["page"] > 0 && $_GET["page"] <= $totalpage) {
  $page = (int)$_GET['page'];
} else {
  $page = 1;
}

$current_url = get_url();

//ページごとの表示件数の最小値と最大を取得
$result_display = get_result($cnt, $page, $max_contents);

if(!empty($shops)) {
  //現在のページに表示する店の情報を取得
  $onepage_shops = array_slice($shops, $result_display[0] - 1, $max_contents);
  $result_comment = ($result_display[0] . '〜' . $result_display[1] . '件を表示');
}

include_once 'hp_view.php'
?>
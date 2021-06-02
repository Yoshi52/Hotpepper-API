<?php
require_once 'function.php';

$url = "hp_process.php";

//範囲を取得
$range = array('' => '---', 1 => '300m', 2 => '500m', 3 => '1000m', 4 => '2000m', 5 => '3000m');

//ジャンルを取得
$genres = get_genre();

//エリアを取得
$large_areas = get_area();

//1ページに表示する件数
$max_contents = 10;

//最大ページ番号
$totalpage = (int)ceil($cnt / $max_contents);
$pagerange = 3;

//現在のページ番号を取得
$page = get_page($totalpage);

//現在のURLを取得
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
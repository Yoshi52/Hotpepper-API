<?php
require_once 'function.php';

$location = get_get('location');

//現在位置が取得できていたら条件の店を検索
if(empty($location)) {
    $radius_num = get_get('range');
    if(!empty($radius_num)) {
        $lat = get_get('latitude');
        $lng = get_get('longitude');
        $params = [
                'lat' => $lat,
                'lng' => $lng,
                'range' => $radius_num,
                'start' => 1,
                'count' => 50
                ];
    $shops = get_shops($params);
    }
}
include_once 'hp.php';
?>
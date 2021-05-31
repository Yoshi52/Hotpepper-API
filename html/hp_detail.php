<?php
require_once 'function.php';

$id = get_get('id');
$api_key = "2c70aac628cb9683";
$base_url = "http://webservice.recruit.co.jp/hotpepper/gourmet/v1/";

$xml = simplexml_load_file($base_url . '?key=' . $api_key . '&id=' . $id);
    foreach($xml->shop as $shop) {
        $shop_detail[] = array(
                        'name'           => $shop->name,
                        'kana'           => $shop->name_kana,
                        'addres'         => $shop->address,
                        'access'         => $shop->access,
                        'photo'          => $shop->photo->pc->l,
                        'open'           => $shop->open,
                        'cap'            => $shop->capacity,
                        'party_cap'      => $shop->party_capacity,
                        'private_room'   => $shop->private_room,
                        'tatami'         => $shop->tatami,
                        'genre'          => $shop->genre->name,
                        'catch'          => $shop->genre->catch,
                        'ave'            => $shop->budget->average,
                        'l_area'         => $shop->large_area->name,
                        'm_area'         => $shop->middle_area->name,
                        'close'          => $shop->close
                        );
}

include_once 'hp_detail_view.php';
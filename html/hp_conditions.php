<?php
require_once 'function.php';

if(isset($_GET['search_conditions'])) {
    if(!empty(($_GET['genre']) || $_GET['large_area'])) {
        $params = [
            'start' => 1,
            'count' => 50
            ];
        if(isset($_GET['genre'])) {
            $genre = get_get('genre');
            $add_genre = ['genre' => $genre];
            $params = $params + $add_genre;
        }
        if(isset($_GET['large_area'])) {
            $large_area = get_get('large_area');
            $add_large_area = ['large_area' => $large_area];
            $params = $params + $add_large_area;
        }    
    $shops = get_shops($params);    
    }
}

include_once 'hp.php';
?>
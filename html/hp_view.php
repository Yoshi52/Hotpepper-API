<?php
//検索が押された場合の処理
if(isset($_POST['search_location'])) {
    if(isset($_POST['radius'])) {
        $radius_num = get_post('radius');
?>
        <script type="text/javascript">
            if(navigator.geolocation) {
                // 現在の位置情報取得を実施
                navigator.geolocation.getCurrentPosition(
                // 位置情報取得成功
                function (position) { 
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    var radius_num = <?php print json_encode($radius_num); ?>;
                    //位置情報をGET送信
                    if(latitude && longitude){
                        window.location.href = "<?php print $url; ?>?latitude=" + latitude + "&longitude=" + longitude + "&range=" + radius_num;
                    } else {
                        var location ="位置情報が取得できませんでした。";
                        window.location.href = "<?php print $url; ?>?location=" + location;
                    }
                },
                // 位置情報取得失敗
                function (position) { 
                    var location ="位置情報が取得できませんでした。";
                    window.location.href = "<?php print $url; ?>?location=" + location;
                });
            } else {
                window.alert("本ブラウザではGeolocationが使えません");
            }
        </script>
    <?php } else { ?>
        <script type="text/javascript">
            var location ="現在位置からの距離を選択してください。";
            window.location.href = "<?php print $url; ?>?location=" + location;
        </script>
    <?php } 
 } ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php print 'hp.css'; ?>">
    <title></title>
</head>
<body>
<div class="container">
    <?php print $location; ?>
    <div class="fluid-box">
        <p class="container fluid-box-inner title">Gourmet Picks</p>
    </div>
    <div class="row">
        <div class="col-sm">
            <form action="hp.php" method="post" class="search-form-location">
                <div class="form-group">
                    <label>現在位置からの距離:</label>
                    <select name="radius" class="form-control">
                        <?php foreach($range as $key => $value) { ?>
                            <option value="<?php print $key;?>"<?php if($key == $_GET['range']) {print "selected";} ?>>
                                <?php print h($value); ?>
                            </option>
                        <?php } ?>
                    </select>
                    <span class="botton">
                    <input name="search_location" type="submit" value="検索" class="btn btn-primary">
                    </span>
                </div>
            </form>
        </div>

        <div class="col-sm">
            <form action="hp_conditions.php" method="get" class="search-form-conditions">
                <div class="form-group">
                    <label>お店のジャンル:</label>
                    <select name="genre" class="form-control">
                        <option value="">---</option>
                        <?php foreach($genres as $value) { ?>
                        <option value="<?php print $value['code']; ?>"<?php if($value['code'] == $_GET['genre']) {print "selected";} ?>>
                            <?php print h($value['name']); ?>
                        </option>
                        <?php } ?>
                    </select>
                    <label>場所:</label>
                    <select name="large_area" class="form-control">
                        <option value="">---</option>
                        <?php foreach($large_areas as $value) { ?>
                        <option value="<?php print $value['large_area_code']; ?>"<?php if($value['large_area_code'] == $_GET['large_area']) {print "selected";} ?>>
                            <?php print h($value['large_area_name']); ?>
                        </option>
                        <?php } ?>
                    </select>
                    <input name="search_conditions" type="submit" value="検索" class="btn btn-primary botton">
                </div>
            </form>
        </div>
    </div>

    <?php if(isset($cnt)) { ?>
        <p>
            検索結果<span class="result"><?php print $cnt; ?></span>件
            <span class="small"><?php print $result_comment; ?></span>
        </p>
        <?php if(!empty($shops)) {
            foreach($onepage_shops as $info) { ?>
                <div class="search-result">
                    <a href="hp_detail.php?id=<?php print $info['id']; ?>"><img src="<?php print h($info['photo']); ?>"></a>
                    <div class="result-text">
                        <ul>
                            <li><?php print h($info['genre']); ?></li>
                            <li><?php print h($info['budget']); ?><li>
                        </ul>
                        <a href="hp_detail.php?id=<?php print $info['id']; ?>">
                            <h5><?php print h($info['name']); ?></h5>
                        </a>
                        <p class="line">
                            <img src="icon/pen_icon.jpeg" class="icon"><?php print h($info['catch']); ?><br>
                            <img src="icon/map_icon.png" class="icon"><?php print h($info['addres']); ?>
                        </p>
                    </div>
                </div>
            <?php } ?>

            <p class="center line-top">
                <?php
                //ページング 
                if ($page > 1) { ?>
                    <a href="<?php print $current_url; ?>&page=<?php print ($page - 1); ?>">前のページへ</a>
                <?php } ?>
        
                <?php for ($i = $pagerange; $i > 0; $i--) { 
                    if ($page - $i < 1) {
                        continue; 
                    } ?>
                    <a href="<?php print $current_url; ?>&page=<?php print ($page - $i); ?>"><?php print ($page - $i); ?></a>
                <?php } ?>
            
                <span>
                    <?php print $page; ?>
                </span>
                <?php for ($i = 1; $i <= $pagerange; $i++) {
                    if ($page + $i > $totalpage) {
                        break;
                    } ?>
                    <a href="<?php print $current_url; ?>&page=<?php print ($page + $i); ?>"><?php print ($page + $i); ?></a>
                <?php } ?>
            
                <?php if ($page < $totalpage) { ?>
                    <a href="<?php print $current_url; ?>&page=<?php print ($page + 1); ?>">次のページへ</a>
                <?php } ?>
            </p>
            
        <?php }
    } ?>
</div>
</body>
</html>
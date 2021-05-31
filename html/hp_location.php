<?php
require_once 'function.php';


//検索が押された場合の処理
if(isset($_POST['search'])) {
    if(isset($_POST['radius'])) {
        $radius_num = $_POST['radius'];
?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script type="text/javascript">
            if(navigator.geolocation) {
                // 現在の位置情報取得を実施
                navigator.geolocation.getCurrentPosition(
                // 位置情報取得成功
                function (position) { 
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    var radius_num = <?php print $radius_num; ?>
                    //位置情報をGET送信
                    if(latitude && longitude){
                        $.ajax({
                            type: 'POST', // HTTPリクエストメソッドの指定
                            url: 'hp_process.php', // 送信先URLの指定
                            dataType: 'json', // 受信するデータタイプの指定
                            timeout: 10000, // タイムアウト時間の指定
                            data: {
                                latitude: latitude,
                                longitude: longitude,
                                radius_num: radius_num
                            }
                        })
                        .success(function(data) {
                            alert('送信完了');
                            // 通信が成功したときの処理
                            window.location.href = "<?php print $url; ?>";
                        })
                        .fail(function() {
                            // 通信が失敗したときの処理
                            console.log('a');
                        });


                        //window.location.href = "<?php print $url; ?>?latitude=" + latitude + "&longitude=" + longitude + "&range=" + radius_num;
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
 } 
 
 
 ?>
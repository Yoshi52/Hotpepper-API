<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php print 'hp_detail.css'; ?>">
    <title></title>
</head>
<body>
<div class="container">
    <div class="fluid-box">
        <h1 class="container fluid-box-inner">title</h1>
    </div>
    <?php foreach($shop_detail as $value) { ?>
        <h5><?php print h($value['name']); ?></h5>
        <p class="small kana"><?php print h($value['kana']); ?></p>
        <div class="flex_info">
            <img src="<?php print h($value['photo']); ?>">
            <div class="vertical">
                <p>
                    <span class="line-bottom"><?php print $value['catch']; ?></span>
                </p>
                <p>
                    <span class="enclose small">ジャンル</span>
                    <span class="line-bottom"><?php print $value['genre']; ?></span>
                </p>
                <p>
                    <span class="enclose small">予算</span>
                    <span class="line-bottom"><?php print $value['ave']; ?></span>
                </p>
                <p>
                    <span class="enclose small">エリア</span>
                    <span class="line-bottom">
                        <?php print $value['l_area']; ?>
                        <?php print $value['m_area']; ?>
                    </span>
                </p>
                <p>
                    <span class="enclose small">定休日</span>
                    <span class="line-bottom"><?php print $value['close']; ?></span>
                </p>
            </div>
        </div>
    <?php } ?>

    <div class="table-container">
        <table class="table table-bordered">
            <caption>基本情報</caption>
            <?php foreach($shop_detail as $info) { ?>
            <tr>
                <th>店名</th>
                <td><?php print h($info['name']); ?></td>
            </tr>
            <tr>
                <th>住所</th>
                <td><?php print h($info['addres']); ?></td>
            </tr>
            <tr>
                <th>アクセス</th>
                <td><?php print h($info['access']); ?></td>
            </tr>
            <tr>
                <th>営業時間</th>
                <td><?php print h($info['open']); ?></td>
            </tr>
            <?php } ?>
        </table>

        <table class="table table-bordered">
            <caption>お席情報</caption>
            <?php foreach($shop_detail as $info) { ?>
            <tr>
                <th>総席数</th>
                <td><?php print h($info['cap']); ?></td>
            </tr>
            <tr>
                <th>最大宴会収容人数</th>
                <td><?php print h($info['party_cap']); ?></td>
            </tr>
            <tr>
                <th>個室</th>
                <td><?php print h($info['private_room']); ?></td>
            </tr>
            <tr>
                <th>座敷</th>
                <td><?php print h($info['tatami']); ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <p class="center line-top">
        <?php
        //ホスト名取得
        $h = $_SERVER['HTTP_HOST'];
        // リファラ値があれば、かつ外部サイトでなければaタグで戻るリンクを表示
        if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$h) !== false)) {
            print '<a href="' . $_SERVER['HTTP_REFERER'] . '">戻る</a>'; 
        }
        ?>
    </p>
</div>
</body>
</html>
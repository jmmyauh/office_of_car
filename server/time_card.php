<?php 
$date = date('Y年m月d日 H時i分s秒'); ?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/_head.php' ?>

<body>
    <div class = front_page>
    <h4><?=$date ?></h4>
    <form class="time_card" action="" method="post">
            <label class="email_label" for="number">社員番号</label>
            <input type="number" name="number" id="number" placeholder="number" >
            <label class="password_label" for="password">パスワード</label>
            <input type="password" name="password" id="password" placeholder="Password">
            <div class="button_area">
                <input type="submit" value="開始" class="start_button">
                <a href="list.php" class="finish_button">終了</a>
            </div>
    </div>
    </form>
</body>

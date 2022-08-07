<?php
require_once __DIR__ . '/common/functions.php';
// $date = date('Y年m月d日 H時i分s秒'); 
$office_number = '';
$input_manage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $office_number = $_POST['office_number'];
    $input_manage = find_input_manage_by_office_number($office_number);

    if (isset($_POST['start_button'])) {
        if (empty($input_manage) || isset($input_manage['finishtime'])) {
            time_card_start($office_number);
        }
    } elseif (isset($_POST['finish_button'])) {
        time_card_finish($office_number);
        header("Location: input_manage.php?id=${input_manage['id']}");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/_head.php' ?>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="front_page.php">公用車</a>
        </div>
    </nav>
    <p class="reservation_title" aria-current="page">ータイムカードー</p>
    <div class=front_page>
        <h4 id="RealtimeClockArea2"></h4>
        <!-- <p id="RealtimeClockArea2"></p> -->
        <form class="time_card" action="" method="post">
            <label class="email_label" for="number">社員番号</label><br>
            <input type="number" name="office_number" id="number" placeholder="入力してください" required><br>
            <!-- <label class="password_label" for="password">パスワード</label><br>
            <input type="password" name="password" id="password" placeholder="Password"><br> -->
            <div class="button_area">
                <input type="submit" value="開始" class="start_button" name="start_button">
                <input type="submit" name="finish_button" class="finish_button" value="終了">
            </div>
        </form>
    </div>
    <script src="js/time.js"></script>
</body>

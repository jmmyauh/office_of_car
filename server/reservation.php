<?php

require_once __DIR__ . '/common/functions.php';

$name = '';
$day_number = '';
$starttime = '';
$finishtime = '';
$car_type = '';

$select_car = '';

$cars = ['車A', '車B', '車C'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $day_number = $_POST['day_number'];
    $starttime = $_POST['starttime'];
    $finishtime = $_POST['finishtime'];
    $car_type = $_POST['car_type'];

    reservation($name, $day_number, $starttime, $finishtime, $car_type);
}

?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/_head.php' ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="front_page.php">公用車</a>
        </div>
    </nav>
    <p class="reservation_title" aria-current="page">ー予約ー</p>
    <div class=front_page>
        <!-- <form action="reservation_list.php" method="POST"> -->
        <form action="" method="POST">
            <label for="">名前</label><br>
            <input type="text" name=name class=name required><br>
            <label for="">日付</label><br>
            <input type="date" name=day_number class=day_number required><br>
            <div class="time_wapper">
                <div class="starttime_wrapper">
                    <label for="">出発時刻</label><br>
                    <input class=starttime type="time" name="starttime" required><br>
                </div>
                <div>
                    <label for="">帰庁時刻</label><br>
                    <input class=finishtime type="time" name="finishtime" required><br>
                </div>
            </div>
            <label for="">車種</label><br>
            <select name="car_type" class="form-select" aria-label="Default select example" required>
                    <option value="" selected>Open this select menu</option>
            <!-- <select name="car_type" class="car_type"> -->
                <?php foreach ($cars as $key) : ?>
                    <option value="<?= $key ?>"><?= $key ?></option>
                <?php endforeach; ?>
            </select>
            <br><br>
            <div class="register_button_wrapper">
            <input class="register_button" type="submit" value="登録">
            </div>
        </form>
    </div>
    <header>
    </header>
</body>

</html>

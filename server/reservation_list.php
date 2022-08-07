<?php

require_once __DIR__ . '/common/functions.php';

// $dbh = connect_db();

$reservation_items = reservation_list();
$id = filter_input(INPUT_GET, 'id');

delete_reservation_list($id)



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
    <p class="reservation_title" aria-current="page">ー予約表ー</p>
    <header>
    </header>
    <main class=>
        <table class="reservation_table">
            <tr>
                <th>名前</th>
                <th>日付</th>
                <th>開始時刻</th>
                <th>帰庁時刻</th>
                <th>車種</th>
                <th>　　</th>
            </tr>

            <?php foreach ($reservation_items as $item) : ?>
                <tr>
                    <td>
                        <p><?= h($item['name']) ?></p>
                    </td>
                    <td>
                        <p><?= h($item['day_number']) ?></p>
                    </td>
                    <td>
                        <p><?= h($item['starttime']) ?></p>
                    </td>
                    <td>
                        <p><?= h($item['finishtime']) ?></p>
                    </td>
                    <td>
                        <p><?= h($item['car_type']) ?></p>
                    </td>
                    <td>
                        <a href="reservation_list.php?id=<?=h($item['id']) ?>"class="btn btn-outline-dark">削除</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    </main>
</body>

</html>


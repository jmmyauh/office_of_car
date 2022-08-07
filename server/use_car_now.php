<?php

require_once __DIR__ . '/common/functions.php';

// $dbh = connect_db();
$i = [];
$reservation_items = reservation_list();
// $now_time = new DATETIME();
$now_time = strtotime('now');


$count = count($reservation_items);
for ($i = 0; $i < $count - 1; $i++) {
    $new_finishtime = strtotime($reservation_items[$i]["finishtime"]);
    $new_starttime = strtotime($reservation_items[$i]["starttime"]);
    $ns_time = $now_time - $new_starttime;
    $nf_time = $now_time - $new_finishtime;

    if ($ns_time >= 0 && $nf_time <= 0) {
        $items[] = $reservation_items[$i];
    }
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
    <p class="reservation_title" aria-current="page">ー現在使用している車ー</p>
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

            <?php foreach ($items as $item) : ?>
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
                        <a href="reservation_list.php?id=<?= h($item['id']) ?>" class="btn btn-outline-dark">削除</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    </main>
</body>

</html>

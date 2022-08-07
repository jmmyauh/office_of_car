<?php
require_once __DIR__ . '/config.php';

// 接続処理を行う関数
function connect_db()
{
    try {
        return new PDO(
            DSN,
            USER,
            PASSWORD,
            [PDO::ATTR_ERRMODE =>
            PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}

// エスケープ処理を行う関数
function h($str)
{
    // ENT_QUOTES: シングルクオートとダブルクオートを共に変換する。
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function reservation($name, $day_number, $starttime, $finishtime, $car_type)
{
    $dbh = connect_db();

    $sql = <<<EOM
    INSERT INTO
        reservation
        (name, day_number, starttime, finishtime, car_type)
    VALUES
        (:name, :day_number, :starttime, :finishtime, :car_type);
    EOM;

    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':day_number', $day_number, PDO::PARAM_STR);
    $stmt->bindValue(':starttime', $starttime, PDO::PARAM_STR);
    $stmt->bindValue(':finishtime', $finishtime, PDO::PARAM_STR);
    $stmt->bindValue(':car_type', $car_type, PDO::PARAM_STR);

    $stmt->execute();
}

function reservation_list()
{
    $dbh = connect_db();

    $sql = <<<EOM
    SELECT * 
    FROM reservation
    WHERE day_number >= CURDATE()
    ORDER BY day_number
    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function update_input_manage($task, $destination, $distance, $name, $headcount, $oil, $remarks, $id)
{
    $dbh = connect_db();

    $sql = <<<EOM
    UPDATE
        input_manage
    SET
        task = :task,
        destination = :destination,
        distance = :distance,
        name = :name,
        headcount = :headcount,
        oil = :oil,
        remarks = :remarks
    WHERE
        id = :id
    EOM;

    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':task', $task, PDO::PARAM_STR);
    $stmt->bindValue(':destination', $destination, PDO::PARAM_STR);
    $stmt->bindValue(':distance', $distance, PDO::PARAM_STR);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':headcount', $headcount, PDO::PARAM_INT);
    $stmt->bindValue(':oil', $oil, PDO::PARAM_STR);
    $stmt->bindValue(':remarks', $remarks, PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);

    $stmt->execute();
}


function time_card_finish($office_number)
{
    $dbh = connect_db();

    $sql = <<<EOM
    UPDATE
        input_manage
    SET
        finishtime = CURRENT_TIMESTAMP
    WHERE
        office_number = :office_number ;
    EOM;

    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':office_number', $office_number, PDO::PARAM_STR);
    $stmt->execute();
}

function time_card_start($office_number)
{
    $dbh = connect_db();

    $sql = <<<EOM
    INSERT INTO
        input_manage
        (starttime, office_number)
    VALUES
        (CURRENT_TIMESTAMP, :office_number)
    EOM;

    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':office_number', $office_number, PDO::PARAM_STR);
    $stmt->execute();
}

function find_input_manage_by_office_number($office_number)
{
    $dbh = connect_db();

    $sql = <<<EOM
    SELECT * FROM 
        input_manage 
    WHERE 
        office_number = :office_number
    ORDER BY id DESC
    LIMIT 1 ;
    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':office_number', $office_number, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function manage_list()
{
    $dbh = connect_db();

    $sql = <<<EOM
    SELECT
        IFNULL(starttime, 0) as starttime,
        IFNULL(task, '') as task,
        IFNULL(destination, '') as destination,
        IFNULL(finishtime, 0) as finishtime,
        IFNULL(distance, 0) as distance,
        IFNULL(name, '') as name,
        IFNULL(headcount, 0) as headcount,
        IFNULL(oil, 0) as oil,
        IFNULL(remarks, '') as remarks
    FROM
        input_manage
    ORDER BY
        starttime
    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function delete_reservation_list($id)
{
    $dbh = connect_db();

    $sql = <<<EOM
    DELETE FROM 
        reservation
    WHERE 
        id = :id;
    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

function search_contents($search_word)
{
    // データベースに接続
    $dbh = connect_db();
    // 引数あり
    if (!empty($search_word)) {
        // SQL文の組み立つ
        $sql = <<<EOM
        SELECT
            IFNULL(starttime, 0) as starttime,
            IFNULL(task, '') as task,
            IFNULL(destination, '') as destination,
            IFNULL(finishtime, 0) as finishtime,
            IFNULL(distance, 0) as distance,
            IFNULL(name, '') as name,
            IFNULL(headcount, 0) as headcount,
            IFNULL(oil, 0) as oil,
            IFNULL(remarks, '') as remarks
        FROM
            input_manage
        WHERE
            starttime LIKE :keyword OR
            task LIKE :keyword OR
            destination LIKE :keyword OR
            finishtime LIKE :keyword OR
            name LIKE :keyword ;
        EOM;

        $keyword_param = "%" . $search_word . "%";

        // プリペアドステートメントの準備
        // $dbh->query($sql) でも良い
        $stmt = $dbh->prepare($sql);
    
        // パラメータのバインド
        $stmt->bindValue(':keyword', $keyword_param, PDO::PARAM_STR);

        // プリペアドステートメントの実行
        $stmt->execute();
    }
    // 引数なし
    else {
        // SQL文の組み立て
        $sql = <<<EOM
        SELECT
            IFNULL(starttime, 0) as starttime,
            IFNULL(task, '') as task,
            IFNULL(destination, '') as destination,
            IFNULL(finishtime, 0) as finishtime,
            IFNULL(distance, 0) as distance,
            IFNULL(name, '') as name,
            IFNULL(headcount, 0) as headcount,
            IFNULL(oil, 0) as oil,
            IFNULL(remarks, '') as remarks
        FROM
            input_manage
        EOM;

        // プリペアドステートメントの準備
        // $dbh->query($sql) でも良い
        $stmt = $dbh->prepare($sql);

        // プリペアドステートメントの実行
        $stmt->execute();
    }


    // 結果の受け取り
    $content = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $content;
}

function use_car_now()
{
    $dbh = connect_db();

    $sql = <<<EOM
    SELECT *
    FROM
        reservation
    WHERE 
        office_number = :office_number
    ORDER BY id DESC
    LIMIT 1 ;
    EOM;
}


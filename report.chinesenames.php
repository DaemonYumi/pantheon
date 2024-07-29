<?php

include 'database.php';

$curr_sy = 2024;

// Get all students enrolled in 2024
$sql_enrolled = "SELECT spn, lastname, firstname, level, status FROM masterlist WHERE schoolyear = ?
    ORDER BY CASE
        -- WHEN level = 'Nursery' then 1
        WHEN level = 'Pre-Kinder' then 2 
        WHEN level = 'Kinder' then 3
        WHEN level = 'Grade 1' then 4
        WHEN level = 'Grade 2' then 5
        WHEN level = 'Grade 3' then 6
        WHEN level = 'Grade 4' then 7
        WHEN level = 'Grade 5' then 8
        WHEN level = 'Grade 6' then 9
        WHEN level = 'Grade 7' then 10
        WHEN level = 'Grade 8' then 11
        WHEN level = 'Grade 9' then 12
        WHEN level = 'Grade 10' then 13
        WHEN level = 'Grade 11' then 14
        WHEN level = 'Grade 12' then 15
    END ASC";

$result = $pdo -> prepare($sql_enrolled);
$result -> execute([$curr_sy]);
$enrolled = $result -> fetchAll(PDO::FETCH_ASSOC);

// print_r($enrolled);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="assets/vendor/css/core.css">
</head>
<body>

<div class="container">
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Level</th>
        <th scope="col">Status</th>
        <th scope="col">Chinese Name</th>
        </tr>
    </thead>
    <tbody>

        <?php 
        header('Content-Type: text/html; charset=utf-8');
            $count = 0;

            foreach ($enrolled as $es) { 
                $count++;
                $spn = $es['spn'];

                $sql_chinese = "SELECT chinesename as cn FROM student WHERE spn = ?";
                $result = $pdo -> prepare($sql_chinese);
                $result -> execute([$spn]);
                $chinese_name = $result -> fetch(PDO::FETCH_ASSOC)['cn'];

        ?>

        <tr>
            <th scope="row"><?php echo $count; ?></th>
            <td scope="row"><?php echo $es['lastname'] .', '. $es['firstname']; ?></td>
            <td scope="row"><?php echo $es['level']; ?></td>
            <td scope="row"><?php echo $es['status']; ?></td>
            <td scope="row"><?php echo $chinese_name; ?></td>
        </tr>
        <?php } ?>

    </tbody>
    </table>
</div>

<script src="libs/popper/popper.js"></script>
</body>
</html>
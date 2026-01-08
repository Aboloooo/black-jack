<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $serverName = "localhost";
    $username = "root";
    $password = "AhmAb795";
    $db = "MusicDB";

    $conn = mysqli_connect($serverName, $username, $password, $db);
    if ($conn) {
        echo "Connection established. \n";
    } else {
        echo "Connection could not be established.\n";
        die(print_r(mysqli_connect_error(), true));
    }
    ?>
    <form method="post">
        <h1>Display information from MusicDB</h1>
        <input type="text" name="tableN" placeholder="Table Name">
        <input type="text" name="tableC" placeholder="Column Name">
        <input type="submit" name="submitBtn" value="submit">
    </form>
    <?php
    $counter = 0;
    if (isset($_POST['submitBtn'])) {
        if (!empty($_POST['tableN']) && !empty($_POST['tableC'])) {
            $tableInfo = $conn->prepare("SELECT ? FROM ?");
            $tableInfo->bind_param("ss", $_POST['tableN'], $_POST['tableC']);
            $tableInfo->execute();
            $result = $tableInfo->get_result();
            if ($result) {
                $counter++;
                while ($row = $result->fetch_assoc()) {
    ?>
                    <?= $counter ?>: <?= $row[$_POST['tableC']] ?>
    <?php
                }
            } else {
                echo "Getting result got problem!";
            }
        } else {
            echo "Table name and column are required!";
        }
    }
    ?>
</body>

</html>
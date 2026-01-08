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
    if (isset($_POST['submitBtn'])) {
        if (!empty($_POST['tableN']) && !empty($_POST['tableC'])) {
            $tableN = $_POST['tableN'];
            $tableC = $_POST['tableC'];
            $query = ("SELECT $tableC FROM $tableN");
            $result = mysqli_query($conn, $query);

            if ($result) {
                $counter = 0;
    ?>
                <h2>Result for: <?= $tableN ?> table and <?= $tableC ?> column</h2>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $counter++;
                ?>
                    <?= $counter ?>: <?= $row[$tableC] ?>
                    <br>
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
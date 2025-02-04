<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blackjack Game</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            background-image: url("../img/background.jpg");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }

        .chips {
            background-color: white;
            border-radius: 5px;
        }

        .chips h2 {
            color: black;
        }
    </style>
</head>

<body>
    <?php
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SESSION["numberOfHittedBtn"])) {
        $_SESSION["numberOfHittedBtn"] = 0;
    }
    if (!isset($_SESSION["playerHand"])) {
        $_SESSION["playerHand"] = [];
    }
    if (!isset($_SESSION["DealerHand"])) {
        $_SESSION["DealerHand"] = [];
    }
    if (!isset($_SESSION["firstCard"])) {
        $_SESSION["firstCard"] = ""; // Initialize firstCard in session for dealer
    }
    if (!isset($_SESSION["DealerCards"])) {
        $_SESSION["DealerCards"] = [];
    }

    $sumOfPlayerHand = 0;
    $sumOfDealerHand = 0;

    $refreshBtn = false;
    if (isset($_POST["hit"])) {
        $refreshBtn = true;
    }
    function giveMeARandomCard()
    {
        $differentTypeOfCard = ["clubs", "diamonds", "hearts", "spades"];
        $randomCartNumber = rand(1, 13);
        $randomN = rand(0, 3);
        $randomCardType =  $differentTypeOfCard[$randomN];

        return [$randomCardType, $randomCartNumber];
    }

    ?>
    <div class="chips">
        <h2>Bet now!</h2>
        <img src="../img/chips/5.PNG" class="chip5" alt="">
        <img src="../img/chips/10.PNG" class="chip10" alt="">
        <img src="../img/chips/25.PNG" class="chip25" alt="">
        <img src="../img/chips/100.PNG" class="chip100" alt="">
        <img src="../img/chips/500.PNG" class="chip500" alt="">
    </div>
    <div class="game-container">
        <h1>Black-jack</h1>

        <!-- Dealer's Hand -->
        <div class="hand" id="dealer-hand">
            <!-- Example card images -->
            <?php
            if ($_SESSION["numberOfHittedBtn"] == 1 && isset($_POST["hit"])) {
                list($randomCardT, $randomCardN) = giveMeARandomCard();
                $_SESSION["firstCard"] = '<img src="../img/' . $randomCardT . '/' . $randomCardN . '.PNG">';
                array_push($_SESSION["DealerCards"], $randomCardN);
                echo $_SESSION["firstCard"];
                echo '<img src="../img/default.PNG">';
            } else {
                echo $_SESSION["firstCard"];
                echo '<img src="../img/default.PNG">';
            }
            ?>
        </div>

        <!-- Player's Hand -->
        <div class="hand" id="player-hand">
            <!-- Example card images -->
            <?php
            if (isset($_POST["hit"])) {
                $_SESSION["numberOfHittedBtn"]++;
            }
            /* create an arrray to save the cards */

            if ($_SESSION["numberOfHittedBtn"] > 0 && isset($_POST["hit"])) {
                for ($i = 0; $i < $_SESSION["numberOfHittedBtn"]; $i++) {
                    list($randomCardT, $randomCardN) = giveMeARandomCard();
                    $randomCard = '<img src="../img/' . $randomCardT . '/' . $randomCardN . '.PNG">';

                    array_push($_SESSION["playerHand"], $randomCard);
                    for ($i = 0; $i < count($_SESSION["playerHand"]); $i++) {
                        echo $_SESSION["playerHand"][$i];
                    }
                }
            } else {
                echo '<img src="../img/default.PNG">';
            }

            if (isset($_POST["refreshBtn"])) {
                header("Refresh:0");
                session_unset();
                session_destroy();
            }
            ?>

        </div>

        <!-- Buttons for actions -->
        <form class="buttons" method="post">
            <button id="hit-btn" name="hit">Hit</button>
            <button id="stand-btn" name="stand">Stand</button>
            <br>
            <br>
            <?= $refreshBtn ? "<button name='refreshBtn'>Refresh</button>" : "" ?>
        </form>


        <!-- Game result -->
        <div class="result" id="game-result"></div>
    </div>
</body>

</html>
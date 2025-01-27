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

    $refreshBtn = false;
    if (isset($_POST["hit"])) {
        $refreshBtn = true;
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
            $imgPath = giveMeARandomCard();
            $imgPath2 = giveMeARandomCard();
            ?>
            <img src="<?= isset($_POST["hit"]) ? $imgPath : '../img/default.PNG' ?>" alt="Card Back">
            <img src="<?= isset($_POST["hit"]) ? $imgPath2 : '../img/default.PNG' ?>" alt="Card Back">
        </div>

        <!-- Player's Hand -->
        <div class="hand" id="player-hand">
            <!-- Example card images -->
            <?php
            function giveMeARandomCard()
            {

                $differentTypeOfCard = ["clubs", "diamonds", "hearts", "spades"];
                $randomCartNumber = rand(1, 13);
                $randomN = rand(0, 3);
                $randomCardType =  $differentTypeOfCard[$randomN];
                for ($i = 0; $i < count($differentTypeOfCard); $i++) {
                    if ($randomCardType == $differentTypeOfCard[$i]) {
                        return "../img/" . $differentTypeOfCard[$i] . "/" . $randomCartNumber . ".PNG";
                    }
                }
            }


            if (isset($_POST["hit"])) {
                $randomCard = giveMeARandomCard();
                $imgTag = '<img src=' . $randomCard . '>';
                echo $imgTag;
            }
            if (isset($_POST["refreshBtn"])) {
                header("Refresh:0");
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
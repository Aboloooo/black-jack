<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blackjack Game</title>
    <link rel="stylesheet" href="../style.css">
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
    <div class="game-container">
        <h1>Black-jack</h1>

        <!-- Dealer's Hand -->
        <div class="hand" id="dealer-hand">
            <!-- Example card images -->
            <img src="images/card-back.png" alt="Card Back">
            <img src="images/card-back.png" alt="Card Back">
        </div>

        <!-- Player's Hand -->
        <div class="hand" id="player-hand">
            <!-- Example card images -->
            <?php
            function giveMeARandomCard()
            {
                /* $differentTypeOfCard = ["clubs", "diamonds", "hearts", "spades"];
                $numberOfCart = rand(1, 13);
                $randomN = rand(0, 3);
                $randomCardType =  $differentTypeOfCard[$randomN];
                for ($i = 0; $i < count($differentTypeOfCard); $i++) {
                    if ($randomCardType == $differentTypeOfCard[$i]) {
                        return "../img/" . $differentTypeOfCard[$i] . "/" . $numberOfCart . ".PNG";
                    }
                } */
                $randomNumbers = [];
                $randomN = rand(0, 3);
            }
            $imgPath = giveMeARandomCard();

            if (isset($_POST["hit"])) {
            ?>
                <img src="<?= $imgPath ?>">
            <?php
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
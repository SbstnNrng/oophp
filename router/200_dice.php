<?php

/**
 * Init game and redirect to dice100
 */
$app->router->get("dice100/init", function () use ($app) {
    $_SESSION["dice"] = new Seb\Dice100\Game100();
    $game = $_SESSION["dice"];
    // init session to start game";
    return $app->response->redirect("dice100/play");
});

$app->router->get("dice100/play", function () use ($app) {
    // echo "Some debugging information";
    $title = "Dice 100";

    //incoming variables
    $handVal = $_SESSION["handVal"] ?? null;
    $check = $_SESSION["check"] ?? null;

    $_SESSION["doCheat"] = null;

    $data = [
        "handVal" => $handVal,
        "check" => $check,
        "playerScore" => $_SESSION["dice"]->getPlayerScore(),
        "computerScore" => $_SESSION["dice"]->getComputerScore(),
        "turnScore" => $_SESSION["dice"]->getTurnScore()
    ];

    $app->page->add("dice100/play", $data);
    //$app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});

/**
 * Play make-guess
 */
$app->router->post("dice100/play", function () use ($app) {
    // echo "Some debugging information";
    $title = "Play";

    //incoming variables
    $doDice = $_POST["doDice"] ?? null;
    $doEnd = $_POST["doEnd"] ?? null;
    $doRestart = $_POST["doRestart"] ?? null;

    if ($doDice) {
        $handVal = $_SESSION["dice"]->rollDice();
        $_SESSION["handVal"] = $handVal;
        $check = $_SESSION["dice"]->checkScore();
        $_SESSION["check"] = $check;
    } elseif ($doEnd) {
        $_SESSION["dice"]->endTurn();
        $check = $_SESSION["dice"]->checkScore();
        $_SESSION["check"] = $check;
    } elseif ($doRestart) {
        $_SESSION = [];
        $_SESSION["dice"] = new Seb\Dice100\Game100();
        $game = $_SESSION["dice"];
    }

    return $app->response->redirect("dice100/play");
});

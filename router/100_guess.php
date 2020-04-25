<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init game and redirect to game
 */
$app->router->get("guess/init", function () use ($app) {
    $_SESSION["game"] = new Seb\Guess\Guess();
    $game = $_SESSION["game"];
    $game->random();
    // init session to start game";
    return $app->response->redirect("guess/play");
});



/**
 * Play - show status
 */
$app->router->get("guess/play", function () use ($app) {
    // echo "Some debugging information";
    $title = "Play";

    //incoming variables
    $res = $_SESSION["res"] ?? null;
    $guess = $_SESSION["guess"] ?? null;
    $doCheat = $_SESSION["doCheat"] ?? null;

    $_SESSION["doCheat"] = null;
    $_SESSION["res"] = null;
    $_SESSION["guess"] = null;

    $data = [
        "guess" => $guess ?? null,
        "res" => $res,
        "doGuess" => $doGuess ?? null,
        "doCheat" => $doCheat ?? null,
        "tries" => $_SESSION["game"]->tries(),
        "number" => $_SESSION["game"]->number(),
    ];

    $app->page->add("guess/play", $data);
    //$app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});

/**
 * Play make-guess
 */
$app->router->post("guess/play", function () use ($app) {
    // echo "Some debugging information";
    $title = "Play";

    //incoming variables
    $guess = $_POST["guess"] ?? null;
    $doInit = $_POST["doInit"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;
    $doCheat = $_POST["doCheat"] ?? null;

    $tries = $_SESSION["game"]->tries();
    $number = $_SESSION["game"]->number();

    if ($doGuess) {
        $guess = intval($guess);
        $res = $_SESSION["game"]->makeGuess($guess);
        $_SESSION["res"] = $res;
        $_SESSION["guess"] = $guess;
    } elseif ($doCheat) {
        $_SESSION["doCheat"] = $doCheat;
    } elseif ($doInit) {
        $_SESSION = [];
        $_SESSION["game"] = new Seb\Guess\Guess();
        $game = $_SESSION["game"];
        $game->random();
    }

    return $app->response->redirect("guess/play");
});

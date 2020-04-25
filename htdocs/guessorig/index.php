<?php

include(__DIR__ . "/autoload.php");
include(__DIR__ . "/src/config.php");

session_name("guessGame");
session_start();

if (!isset($_SESSION["game"])) {
    $_SESSION["game"] = new Guess();
    $game = $_SESSION["game"];
    $game->random();
}
$game = $_SESSION["game"];

//incoming variables
$guess = $_POST["guess"] ?? null;
$doInit = $_POST["doInit"] ?? null;
$doGuess = $_POST["doGuess"] ?? null;
$doCheat = $_POST["doCheat"] ?? null;

if ($doInit) {
    $_SESSION = [];
    $_SESSION["game"] = new Guess();
    $game = $_SESSION["game"];
    $game->random();
} elseif ($doGuess) {
    $guess = intval($guess);
    $res = $game->makeGuess($guess);
}

include(__DIR__ . "/view/number_game.php");

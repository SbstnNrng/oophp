<?php
/**
 * Show all movies.
 */
$app->router->get("movie", function () use ($app) {
    $title = "Movie database ";

    $app->db->connect();
    $sql = "SELECT * FROM movie;";
    $res = $app->db->executeFetchAll($sql);

    $app->page->add("movie/index", [
        "resultset" => $res,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->get("search", function () use ($app) {
    $title = "Movie database ";

    $searchTitle = $_SESSION["searchTitle"] ?? null;
    $searchYear1 = $_SESSION["searchYear1"] ?? null;
    $searchYear2 = $_SESSION["searchYear2"] ?? null;

    $app->db->connect();
    $sql = "SELECT * FROM movie;";
    $res = $app->db->executeFetchAll($sql);

    if ($searchTitle) {
        $sql = "SELECT * FROM movie WHERE title LIKE ?;";
        $res = $app->db->executeFetchAll($sql, [$searchTitle]); 
    }

    if ($searchYear1 && $searchYear2) {
        $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?;";
        $res = $app->db->executeFetchAll($sql, [$searchYear1, $searchYear2]); 
    }

    $app->page->add("movie/search", [
        "resultset" => $res,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->post("search", function () use ($app) {

    $doTitleSearch = $_POST["doTitleSearch"] ?? null;
    $doYearSearch = $_POST["doYearSearch"] ?? null;

    if ($doTitleSearch) {
        $searchTitle = $_POST["searchTitle"];
        $_SESSION["searchTitle"] = ("%" . $searchTitle . "%");
        $_SESSION["searchYear1"] = null;
        $_SESSION["searchYear2"] = null;
    } elseif ($doYearSearch) {
        $searchYear1 = $_POST["searchYear1"];
        $_SESSION["searchYear1"] = ($searchYear1);
        $searchYear2 = $_POST["searchYear2"];
        $_SESSION["searchYear2"] = ($searchYear2);
        $_SESSION["searchTitle"] = null;
    }

    return $app->response->redirect("search");
});

$app->router->get("manage", function () use ($app) {
    $title = "Movie database ";

    $app->db->connect();
    $sql = "SELECT * FROM movie;";
    $res = $app->db->executeFetchAll($sql);

    $app->page->add("movie/manage", [
        "resultset" => $res,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->post("manage", function () use ($app) {

    $movieId = $_POST["movieId"] ?? null;

    $doAdd = $_POST["doAdd"] ?? null;
    $doEdit = $_POST["doEdit"] ?? null;
    $doDelete = $_POST["doDelete"] ?? null;

    if ($doAdd) {
        return $app->response->redirect("add");
    } elseif ($doEdit) {
        $_SESSION["movieId"] = intval($movieId);
        return $app->response->redirect("edit");
    } elseif ($doDelete) {
        $sql = "DELETE FROM movie WHERE id = ?;";

        $app->db->connect();
        $app->db->executeFetchAll($sql, [$movieId]);
        return $app->response->redirect("manage");
    }
});

$app->router->get("add", function () use ($app) {
    $title = "Movie database ";

    $app->db->connect();
    $sql = "SELECT * FROM movie;";
    $res = $app->db->executeFetchAll($sql);

    $app->page->add("movie/add", [
        "resultset" => $res,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->post("add", function () use ($app) {

    $movieTitle = $_POST["movieTitle"] ?? null;
    $movieYear = $_POST["movieYear"] ?? null;

    $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";

    $app->db->connect();
    $res = $app->db->executeFetchAll($sql, [$movieTitle, $movieYear, "img/noimage.png"]);

    return $app->response->redirect("manage");
});

$app->router->get("edit", function () use ($app) {
    $title = "Movie database ";

    $movieId = $_SESSION["movieId"];

    $app->db->connect();
    $sql = "SELECT * FROM movie WHERE id = ?;";
    $res = $app->db->executeFetchAll($sql, [$movieId]);

    $app->page->add("movie/edit", [
        "resultset" => $res,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->post("edit", function () use ($app) {

    $movieId = $_SESSION["movieId"];

    $movieTitle = $_POST["movieTitle"] ?? null;
    $movieYear = $_POST["movieYear"] ?? null;
    $movieImage = $_POST["movieImage"] ?? "img/noimage.png";

    $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";

    $app->db->connect();
    $res = $app->db->executeFetchAll($sql, [$movieTitle, $movieYear, $movieImage, $movieId]);

    return $app->response->redirect("manage");
});

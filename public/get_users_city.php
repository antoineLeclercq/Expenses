<?php

    require(__DIR__ . "/../includes/config.php");

    // ensure proper usage
    if (empty($_GET["geo"]))
    {
        http_response_code(400);
        exit;
    }

    // numerically indexed array of expenses
    $location = [];

    $rows = query("
            SELECT latitude, longitude
            FROM places a
            INNER JOIN (
                SELECT zipcode
                FROM users
                WHERE id = ?
            ) b
            ON a.postal_code = b.zipcode
        "
        , $_SESSION["id"]);

    // iterate over items in channel
    foreach ($rows as $row)
    {
        // add article to array
        $expenses[] = [
            "description" => $row["description"],
            "amount" => $row["amount"],
            "date" => substr($row["date"], 0, 10)
        ];
    }

    // output articles as JSON (pretty-printed for debugging convenience)
    header("Content-type: application/json");
    print(json_encode($expenses, JSON_PRETTY_PRINT));

?>

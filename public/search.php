<?php

    require(__DIR__ . "/../includes/config.php");

    // numerically indexed array of places
    $places = [];

    // TODO: search database for places matching $_GET["geo"]
    $normalized_input = ucwords($_GET["geo"]);
    $normalized_input_sql_space_before = "% ".$normalized_input;
    $normalized_input_sql_space_after = $normalized_input." %";
    //$places = query("SELECT * FROM places WHERE place_name = ? OR place_name LIKE '? %' OR place_name LIKE '% ?' OR admin_name1 = ? OR admin_name1 LIKE '? %' OR admin_name1 LIKE '% ?' OR postal_code = ?", $normalized_input, $normalized_input, $normalized_input, $normalized_input, $normalized_input, $normalized_input, $normalized_input);
    $places = query("SELECT * FROM places WHERE place_name = ? OR admin_name1 = ? OR postal_code = ? OR place_name LIKE ? OR place_name LIKE ? OR place_name LIKE ? OR admin_name1 LIKE ? OR admin_name1 LIKE ?", $normalized_input, $normalized_input, $normalized_input, $normalized_input, $normalized_input_sql_space_before, $normalized_input_sql_space_after, $normalized_input_sql_space_before, $normalized_input_sql_space_after);

    // output places as JSON (pretty-printed for debugging convenience)
    header("Content-type: application/json");
    print(json_encode($places, JSON_PRETTY_PRINT));

?>

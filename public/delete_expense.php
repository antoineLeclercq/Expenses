<?php

     // configuration
    require("../includes/config.php");

    // insert new user in database
    $inserts = query("DELETE FROM expenses WHERE ",
        $_SESSION["id"], $_POST["date"], $_POST["amount"], $_POST["country"], $_POST["state"], $_POST["city"], $_POST["zipcode"], $_POST["description"]);

    if ($inserts === false) {
        apologize("Something went wrong, try to delete your expense again.");
    }

    //redirect to index.php
    redirect("wallet.php");

?>
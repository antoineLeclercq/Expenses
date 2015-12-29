<?php

     // configuration
    require("../includes/config.php");

    if ( ($_SERVER["REQUEST_METHOD"] == "GET") ) {
        render("expense_form.php");
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // insert new user in database
        $inserts = query("INSERT INTO expenses (id, date, amount, country, state, city, zipcode, description) VALUES(?, to_timestamp(?,'YYYY-MM-DD'), ?, ?, ?, ?, ?, ?)",
            $_SESSION["id"], $_POST["date"], $_POST["amount"], $_POST["country"], $_POST["state"], $_POST["city"], $_POST["zipcode"], $_POST["description"]);

        if ($inserts === false) {
            apologize("Something went wrong, try to add your expense again.");
        }

        //redirect to index.php
        redirect("wallet.php");
    }

?>
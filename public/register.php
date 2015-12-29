<?php

     // configuration
    require("../includes/config.php");

    if ( ($_SERVER["REQUEST_METHOD"] == "GET") && (array_key_exists("id", $_SESSION) === false || $_SESSION["id"] === "" ) ) {
        render("register_form.php");
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // insert new user in database
        $inserts = query("INSERT INTO users (email, password, country, state, city, zipCode) VALUES(?, ?, ?, ?, ?, ?)",
            $_POST["email"], crypt($_POST["password"]), $_POST["country"], $_POST["state"], $_POST["city"], $_POST["zipcode"]);

        if ($inserts === false) {
            apologize("Something went wrong, try to register again.");
        }
        else {

            $rows = query("SELECT id from users where email = ?", $_POST["email"]);

            if ( count($rows) == 1 )
            {
                $row = $rows[0];
                $id = $row["id"];

                // remember user is looged in
                $_SESSION["id"] = $id;
            }
        }

        // send confirmation email
        $subject = "My Expenses registration confirmation";
        $body = "
            <div>
                <p>Congratulations for signing up on <b>My expenses</b>!</p>
                <p>
                    <ul>
                        <li><b>Email</b>: {$_POST["email"]}</li>
                        <li><b>Password</b>: {$_POST["password"]}</li>
                    <ul/>
                </p>
            </div>
        ";
        if ( send_email($_POST["email"], $body, $subject, $_POST["password"]) ) {
            //redirect to index.php
            redirect("index.php");
        }

        apologize("Something went wrong wwith the email confirmation");
    }
    else if ( array_key_exists("id", $_SESSION) ) {
        apologize("You are already logged in with an account. If you wish to create a new account, log out first.");
    }

?>
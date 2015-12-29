<?php

    // configuration
    require("../includes/config.php");

    // query history table with id
    $rows_expenses = query("SELECT * FROM expenses WHERE id = ? ORDER BY date DESC", $_SESSION["id"]);

    if ( $rows_expenses === false)
    {
        apologize("Something went wrong.");
    }

    if ( !empty($rows_expenses) )
    {
        // for each row
        $rows = [];
        foreach ( $rows_expenses as $row )
        {
            // store type, symbol, shares, price, date, id in array
            $rows[] = [
                "date" => substr($row["date"], 0, 10),
                "amount" => $row["amount"],
                "description" => $row["description"],
                "country" => $row["country"],
                "state" => $row["state"],
                "city" => $row["city"],
                "zipcode" => $row["zipcode"]
            ];
        }

        // render portfolio
        render("expenses_history.php", ["rows" => $rows, "title" => "History"]);
    }

    else if ( empty($rows_expenses) )
    {
        render("/expense_form.php");
    }

?>

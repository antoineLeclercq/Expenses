<!DOCTYPE html>

<html>

    <head>

        <title>Expenses</title>

        <!-- CSS Libraries -->
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">

        <!-- CSS library for responsive grids -->
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-min.css">

        <!-- style sheet CSS -->
        <link rel="stylesheet" href="css/style.css">

        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>

    <body>

        <div class="header">
            <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">
                <a class="pure-menu-heading" href="index.php">My Expenses</a>

                <ul class="pure-menu-list">
                    <li class="pure-menu-item"><a href="index.php" class="pure-menu-link">Home</a></li>
                    <li class="pure-menu-item"><a href="wallet.php" class="pure-menu-link">My Wallet</a></li>
                    <li class="pure-menu-item"><a href="map.php" class="pure-menu-link">Map</a></li>
                    <?php
                        if ( array_key_exists("id", $_SESSION) && $_SESSION["id"] !== "" ) {
                            echo '<li class="pure-menu-item"><a href="logout.php" class="pure-menu-link" id="logout-btn">Log Out</a></li>';
                        }
                        else {
                            echo '<li class="pure-menu-item"><a href="login.php" class="pure-menu-link">Log In</a></li>';
                        }
                    ?>
                </ul>
            </div>
        </div>
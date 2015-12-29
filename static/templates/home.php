<div class="splash-container">
    <div class="splash">
        <h1 class="splash-head">Manage Your Expenses</h1>
        <p class="splash-subhead">
            Create an account and manage your expenses
        </p>
        <p class="splash-subhead">
            View the location of your expenses on a map
        </p>
        <?php
            if ( array_key_exists("id", $_SESSION) === false || $_SESSION["id"] === "" ) {
                echo '<p><a href="register.php" class="pure-button pure-button-primary">Sign Up Now</a></p>';
            }
        ?>
    </div>
</div>

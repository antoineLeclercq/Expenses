<div>
    <table class="pure-table pure-table-bordered is-center-object">
        <thead>
            <tr>
                <th>Date</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Country</th>
                <th>State</th>
                <th>City</th>
                <th>Zip code</th>
            </tr>
        </thead>
        <?php foreach ($rows as $row): ?>

            <tr>
                <td><?= htmlspecialchars($row["date"]) ?></td>
                <td><?= htmlspecialchars('$'.$row["amount"]) ?></td>
                <td><?= htmlspecialchars($row["description"]) ?></td>
                <td><?= htmlspecialchars($row["country"]) ?></td>
                <td><?= htmlspecialchars($row["state"]) ?></td>
                <td><?= htmlspecialchars($row["city"]) ?></td>
                <td><?= htmlspecialchars($row["zipcode"]) ?></td>
            </tr>

        <?php endforeach ?>
    </table>
</div>
<div class="is-center-text">
    <p><a href="/add_expense.php" class="pure-button pure-button-primary  ">Add an expense</a></p>
</div>
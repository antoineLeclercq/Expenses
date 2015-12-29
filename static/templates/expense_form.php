<div class="l-box is-center-object">
    <form action="add_expense.php" method="post" class="pure-form pure-form-stacked">
        <fieldset>

            <label>Date of Expense</label>
            <input autofocus class="form-control" name="date" placeholder="YYYY-MM-DD" type="text" required/>

            <label>Amount</label>
            <input autofocus class="form-control" name="amount" placeholder="Amount" type="text" required/>

            <label>Country</label>
            <input autofocus class="form-control" name="country" placeholder="Country" type="text" required/>

            <label>State</label>
            <input autofocus class="form-control" name="state" placeholder="State" type="text" required/>

            <label>City</label>
            <input autofocus class="form-control" name="city" placeholder="City" type="text" required/>

            <label>Zip Code</label>
            <input autofocus class="form-control" name="zipcode" placeholder="Zip Code" type="text" required/>

            <label>Description</label>
            <input class="form-control" name="description" placeholder="Description" type="text"/>

            <button type="submit" class="pure-button" id="add-expense-btn">Add Expense</button>

        </fieldset>
    </form>
</div>
<script src="/js/add_expense.js"></script>
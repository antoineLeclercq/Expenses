<div class="l-box is-center-object">
    <form action="register.php" method="post" class="pure-form pure-form-stacked">
        <fieldset>

            <label>Email</label>
            <input autofocus class="form-control" name="email" placeholder="Email" type="text" required/>

            <label>Confirm Email</label>
            <input autofocus class="form-control" name="confirm-email" placeholder="Email" type="text" required/>

            <label>Country</label>
            <input autofocus class="form-control" name="country" placeholder="Country" type="text" required/>

            <label>State</label>
            <input autofocus class="form-control" name="state" placeholder="State" type="text" required/>

            <label>City</label>
            <input autofocus class="form-control" name="city" placeholder="City" type="text" required/>

            <label>Zip Code</label>
            <input autofocus class="form-control" name="zipcode" placeholder="Zip Code" type="text" required/>

            <label>Password</label>
            <input class="form-control" name="password" placeholder="Password" type="password" required/>

            <label>Confirm Password</label>
            <input class="form-control" name="confrim-password" placeholder="Password" type="password" required/>

            <button type="submit" class="pure-button" id="sign-up-btn">Sign Up</button>

        </fieldset>
    </form>
</div>
<script src="/js/register.js"></script>
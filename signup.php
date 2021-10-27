<?php
  $_title = 'Sign up';
  require_once('components/header.php');
?>
<div id="signupPage">
    
    <form id="signupForm" onsubmit="return false">
        <h1>Sign up</h1>
        <div class="form-group">
            <label for="firstName">First name</label>
            <input name="firstName" type="text" placeholder="Enter your first name">
        </div>
        <div class="form-group">
            <label for="lastName">Last name</label>
            <input name="lastName" type="text" placeholder="Enter your last name">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input name="email" type="text" placeholder="Enter your email address">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input name="password" type="password" placeholder="Enter a password"   autocomplete="on">
        </div>
        <button onclick="signUp()">Sign up</button>
        <span class="txtSmall">Already have an account? <a href="login">login</a> </span>
    </form>
</div>
<script src="js/signup.js"></script>
<?php
    require_once('components/footer.php');
?>
<?php
    $_title = 'Login';
    // require_once(__DIR__.'/../components/header.php'); // This doesnt read variables??
    require_once('components/header.php'); // this does
?>   
<div id="loginPage">
    <!-- <form onsubmit="validate(login); return false"> -->
    <form onsubmit="return false" id="loginForm"> 
        <h1>Login</h1>
        <div class="form-group">
            <label for="email">Email</label>
            <input
            id="emailInput" 
            type="text" 
            name="email" 
            placeholder="Enter email"
            >
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input 
                id="passwordInput"
                type="password"
                name="password" 
                placeholder="Enter password"
                data-validate="str"
                data-min="6"
                data-max="20"
                autocomplete="on"
            >
        </div>
        <span class="errorMsg"></span>
        <button type="submit" onclick="login(event)">Login</button>
        <span class="txtSmall">No account? <a href="signup">Sign up</a> </span>
    </form>
</div>

<script src="js/validator.js"></script>
<script src="js/login.js"></script>
<?php
    require_once('components/footer.php');
?>
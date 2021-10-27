<?php
    $_title = 'Welcome';
    $page = 'home';
    // require_once(__DIR__.'/../components/header.php'); // This one doesnt take variables
    require_once('components/header.php');
    require_once('components/session-check.php');   
?>  
<div id="home">
    <?php 
     require_once('components/main-nav.php');   
    ?>
    <main>
        <h1>"Amazon" managing system</h1>
        <h2>Welcome <?= $_SESSION['user_name']?>!</h2>
    </main>

</div>
<?php
    require_once('components/footer.php');
?>

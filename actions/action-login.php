<?php
    include "../classes/User.php";

    # Create an object
    $user = new User;

    # call the login method
    $user->login($_POST);
    # Note: $_POST -- holds our data coming from the login form
?>
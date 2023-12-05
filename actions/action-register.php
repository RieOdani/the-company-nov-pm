<?php
    include "../classes/User.php";
    
    #Instantiate an object
    $user = new User;

    # Call the method
    $user->store($_POST); //$_POST -- hold the data coming from the registration form
?>
<?php
    require 'admin/config/constants.php';
    //destroy all session and redirect user to loginpage
    session_destroy();
    header('location: '. ROOT_URL);
    die();

?>
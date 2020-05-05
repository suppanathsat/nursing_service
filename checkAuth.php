<?php
    session_start();
    if(!isset($_SESSION['auth'])){
        header( "Location: login.html" );
    }
?>
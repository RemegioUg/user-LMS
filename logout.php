<?php
session_start();
if(isset($_SESSION['Reg_No']))
{
    unset($_SESSION['Reg_No']);
}
header("location: ../index.php");
die;
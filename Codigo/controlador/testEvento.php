<?php
if(!isset($_SESSION))session_start();
$_GET['info'] = 1;
$_SESSION['data'] = 0;
$_SESSION['ajuste'] = 0;
include_once ("cEventoCrear.php");


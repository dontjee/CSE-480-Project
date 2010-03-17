<?php

require_once("std.php");

$Template->CSS("signup");
$Template->CSS("form");
$Template->Header();

$Auth->Login(1);
?>


<h2>Which type of account would you like to create?</h2>
<p><a href="signupemp.php">Prospective Employee</a></p>

<?php
$Template->Footer();

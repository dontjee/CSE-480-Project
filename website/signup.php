<?php

require_once("std.php");

$Template->CSS("signup");
$Template->CSS("form");
$Template->Header();
?>

<h2>Which type of account would you like to create?</h2>
<p><a href="signupemp.php">Prospective Employee</a></p>
<p><a href="signupemployer.php">Employer</a></p>

<?php
$Template->Footer();

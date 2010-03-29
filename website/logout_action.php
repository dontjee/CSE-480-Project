<?php

require_once("std.php");

$Auth->Logout();

header("Location: index.php");
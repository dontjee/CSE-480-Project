<?php

require_once("std.php");

$Auth->Restrict(User::$EMPLOYER);


$Template->CSS("home");
$Template->JS("home");
$Template->Title("Homepage");
$Template->Header();

?>

<!-- Bookmarks -->
<div id="bookmarks" class="panel">
	<span class="title">Bookmarks</span>

	<?php
	for($i=0; $i<6; $i++){
	?>
		<span class="bookmark">
			<span class="remove">X</span>
			<span class="employer">ABC Corp</span>
			<span class="job">Web Developer</span>
		</span>
	<?php } ?>
	
</div>
	
<!-- Notifications -->
<div id="notifications" class="panel">
	<span class="title">Notifications</span>

	<?php
	for($i=0; $i<6; $i++){
	?>
		<span class="notification">
			<span class="remove">X</span>
			<span class="from">ABC Corp</span>
			<span class="message">ABC Corp is interested in you</span>
		</span>
	<?php } ?>
	
</div>
	
<?php
$Template->Footer();
?>

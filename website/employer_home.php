<?php

require_once("std.php");
require_once("classes/Notification.php");

$Auth->Restrict(User::$EMPLOYER);


$Template->CSS("home");
$Template->JS("panel");
$Template->Title("Homepage");
$Template->Header();

?>
	
<!-- Notifications -->
<div id="notifications" class="panel">
	<span class="title">Notifications</span>

	<?php
	$notifs = Notification::GetNotificationsTo($Auth->User()->userID);
	
	if($notifs){
		foreach($notifs as $notif){
		?>
			<div class="notification">
				<span class="message">
					<?php
						echo "<a href='viewemployee.php?id={$notif->from->userID}'>{$notif->from->FullName()}</a>
							has expressed interest in the job
							<a href='jobposting.php?id={$notif->job->jobID}'>{$notif->job->title}</a>";
					?>
				</span>
				<div class="details">
					<span class="posted"><?php echo PrettyDate($notif->timestamp); ?></span>
					<a class="delete" href="delete_notification.php?<?php echo $notif->KeyToVars(); ?>">Delete</a>
				</div>
			</div>
		<?php }
	}else{
		echo "<span class='none'>No new notifications.</span>";
	}
	?>
	
</div>
	
<?php
$Template->Footer();
?>

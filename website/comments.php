<?php

require_once("std.php");
require_once("classes/CommentRepository.php");
require_once("classes/Comment.php");

if(!$Auth->LoggedIn())
{
	header("location:index.php");
}
$Auth->Restrict("Employer");

$user = $Auth->User();

$Template->Title("Comments");
$Template->Header();

$comments = CommentRepository::GetComments($user->userID);
?>
<table>
    <tr>
	    <th style="width:175px;"><b>Potential Employee Name</th>
	    <th style="width:150px;"><b>Message</th>
	    <th style="width:150px;"><b>Posted Time</th>
    </tr>
<?php
foreach( $comments as &$comment )
{?>
    <tr>
	<td>
	    <?php echo $comment->employeeName;?>
	</td>
	<td>
	    <? echo $comment->message; ?>
	</td>
	<td>
	    <? echo $comment->postedTime; ?>
	</td>
    </tr>
<?php } ?>
</table>

<?php
$Template->Footer();
?>

<?php

require_once("std.php");
require_once("classes/Bookmark.php");
require_once("classes/BookmarkRepository.php");

if(!$Auth->LoggedIn())
{
	header("location:index.php");
}
$Auth->Restrict("Employee");

$user = $Auth->User();

$Template->Title("Bookmarks");
$Template->Header();

$bookmarks = BookmarkRepository::GetBookmarks($user->userID);
?>
<table>
    <tr>
	    <th style="width:175px;"><b>Employer Name</th>
	    <th style="width:150px;"><b>Job Title</th>
    </tr>
<?php
foreach( $bookmarks as &$bookmark )
{?>
    <tr>
	<td>
	    <?php echo $bookmark->employerName;?>
	</td>
	<td>
	    <a href="jobposting.php?id=<?php echo $bookmark->jobID;?>" style="color:#CCC; text-decoration:underline;"><?php echo $bookmark->jobTitle;?></a>
	</td>
    </tr>
<?php } ?>
</table>

<?php
$Template->Footer();
?>

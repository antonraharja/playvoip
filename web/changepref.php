<?
include "header.php";

$submit = $_POST['submit'];

if ($submit)
{
    $ok = false;
    $phone = $_POST['phone'];
    $secret = $_POST['secret'];
    $up_realname = $_POST['up_realname'];
    $up_email = $_POST['up_email'];
    $up_location = $_POST['up_location'];
    if ($phone && $secret && $up_realname && $up_email && $up_location)
    {
	$db_query = "SELECT id FROM tblUser WHERE phone='$phone' AND secret='$secret'";
	$db_result = mysql_query($db_query);
	$db_row = @mysql_fetch_array($db_result);
	if ($id = $db_row['id'])
	{
	    $db_query = "UPDATE tblUser SET realname='$up_realname',callerid='$up_realname',email='$email',location='$up_location',flag_update='1' WHERE id='$id'";
	    $db_result = mysql_query($db_query);
	    if (@mysql_affected_rows())
	    {
		$ok = true;
	    }
	}
    }
    if ($ok)
    {
    	$content = "
	    <p>You have successfully changed your preferences.
	    <p>Your phone number : $phone
	    <p>Your new real name : $up_realname
	    <p>Your new email : $up_email
	    <p>Your new location : $up_location
	    <p>Your updated preferences will be fully activated within the next 1 minutes.
	    <p>Please write above information on a note, dont loose it !
	    <p>Thank you.
	    <p>
	    <li>Back to <a href=index.php>home</a>
	";
    }
    else
    {
	$content = "
	    <p>You have failed to change your preferences
	    <p>
	    <li>Try again <a href=changepref.php>once more</a> or back to <a href=index.php>home</a>
	";
    }
    echo $content;
}
else
{
    $content = "
	<table cellpadding=1 cellspacing=1 border=0>
	<form action=changepref.php method=post>
	<tr><td colspan=3>Update preferences</td></tr>
	<tr><td colspan=3>&nbsp;</td></tr>
	<tr><td><p>Phone number</td><td> : </td><td><input type=text maxlength=50 size=20 name=phone></td></tr>
	<tr><td><p>Current password</td><td> : </td><td><input type=text maxlength=200 size=20 name=secret></td></tr>
	<tr><td colspan=3>&nbsp;</td></tr>
	<tr><td><p>Update real name</td><td> : </td><td><input type=text maxlength=50 size=20 name=up_realname></td></tr>
	<tr><td><p>Update email address</td><td> : </td><td><input type=text maxlength=50 size=20 name=up_email></td></tr>
	<tr><td><p>Update location</td><td> : </td><td><input type=text maxlength=50 size=20 name=up_location></td></tr>
	<tr><td colspan=3>&nbsp;</td></tr>
	<tr><td colspan=3><p><input type=submit class=button name=submit value=Update></td></tr>
	</form>
	</table>
	<p>
	<li>Back to <a href=index.php>home</a>
    ";
    echo $content;
}

include "footer.php";
?>
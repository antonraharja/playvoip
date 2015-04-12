<?
include "header.php";

$submit = $_POST['submit'];

if ($submit)
{
    $ok = false;
    $phone = $_POST['phone'];
    $secret = $_POST['secret'];
    $new_secret = $_POST['new_secret'];
    if ($phone && $secret && $new_secret)
    {
	$db_query = "SELECT secret FROM tblUser WHERE phone='$phone'";
	$db_result = mysql_query($db_query);
	$db_row = @mysql_fetch_array($db_result);
	$current_secret = $db_row['secret'];
	if ($current_secret && ($current_secret==$secret))
	{
	    $secret = $new_secret;
	    $db_query = "UPDATE tblUser SET secret='$secret',flag_update='1' WHERE phone='$phone'";
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
	    <p>You have successfully changed your password.
	    <p>Your phone number : $phone
	    <p>Your new password : $secret
	    <p>Your new password will be fully activated within the next 1 minutes.
	    <p>Please write above information on a note, dont loose it !
	    <p>Thank you.
	    <p>
	    <li>Back to <a href=index.php>home</a>
	";
    }
    else
    {
	$content = "
	    <p>You have failed to change the password
	    <p>
	    <li>Try again <a href=changepassword.php>once more</a> or back to <a href=index.php>home</a>
	";
    }
    echo $content;
}
else
{
    $content = "
	<table cellpadding=1 cellspacing=1 border=0>
	<form action=changepassword.php method=post>
	<tr><td colspan=3>Change password</td></tr>
	<tr><td colspan=3>&nbsp;</td></tr>
	<tr><td><p>Phone number</td><td> : </td><td><input type=text maxlength=50 size=20 name=phone></td></tr>
	<tr><td><p>Current password</td><td> : </td><td><input type=text maxlength=200 size=20 name=secret></td></tr>
	<tr><td><p>New password</td><td> : </td><td><input type=text maxlength=50 size=20 name=new_secret></td></tr>
	<tr><td colspan=3>&nbsp;</td></tr>
	<tr><td colspan=3><p><input type=submit class=button name=submit value=Change></td></tr>
	</form>
	</table>
	<p>
	<li>Back to <a href=index.php>home</a>
    ";
    echo $content;
}

include "footer.php";
?>
<?
include "header.php";

$submit = $_POST['submit'];

if ($submit)
{
    $ok = false;
    $realname = $_POST['realname'];
    $email = $_POST['email'];
    $location = $_POST['location'];
    if ($realname && $email && $location)
    {
	$phone = "ERROR";
	$username = "ERROR";
	$secret = "ERROR";
	$callerid = $realname;
	$mailbox = "ERROR";
	$db_query = "
	    INSERT INTO tblUser 
	    (creation_datetime, realname, email, location, protocol, phone, username, secret, host, callerid, context, dtmfmode, mailbox, nat, canreinvite, flag_configured, flag_inactive)
	    VALUES (NOW(),'$realname','$email','$location','all','$phone','$username','$secret','dynamic','$callerid','default','rfc2833','$mailbox','no','yes','0','1')
	";
	$db_result = mysql_query($db_query);
	$last_insert_id = mysql_insert_id();
	if ($last_insert_id)
	{
	    $phone = $conf_first_number + $last_insert_id;
	    $username = $phone;
	    $secret = "abc".$last_insert_id;
	    $mailbox = $phone;
	    $db_query = "UPDATE tblUser SET phone='$phone',username='$username',secret='$secret',mailbox='$mailbox',flag_inactive='0' WHERE id='$last_insert_id'";
	    $db_result = mysql_query($db_query);
	    if (mysql_affected_rows())
	    {
		$ok = true;
	    }
	}
    }
    if ($ok)
    {
    	$content = "
	    <p>Hello $realname, you have successfully registered new phone number.
	    <p>Your phone number : $phone
	    <p>Your username is your phone number ($username)
	    <p>Your password : $secret
	    <p>Our VoIP server : voip.ictcentre.net
	    <p>Your VoIP account will be fully usable within the next 1 minutes.
	    <p>Please write above information on a note, dont loose it !
	    <p>Thank you.
	    <p>
	    <li>Back to <a href=index.php>home</a>
	";
    }
    else
    {
	$content = "
	    <p>You have failed to register new phone number.
	    <p>
	    <li>Register <a href=register.php>once more</a> or back to <a href=index.php>home</a>
	";
    }
    echo $content;
}
else
{
    $content = "
	<table cellpadding=1 cellspacing=1 border=0>
	<form action=register.php method=post>
	<tr><td colspan=3>Register new phone number</td></tr>
	<tr><td colspan=3>&nbsp;</td></tr>
	<tr><td>Real Name</td><td> : </td><td><input type=text maxlength=50 size=20 name=realname></td></tr>
	<tr><td>Email</td><td> : </td><td><input type=text maxlength=200 size=20 name=email></td></tr>
	<tr><td>Location (City)</td><td> : </td><td><input type=text maxlength=50 size=20 name=location></td></tr>
	<tr><td colspan=3>&nbsp;</td></tr>
	<tr><td colspan=3>Note: Please use your current email address and location</td></tr>
	<tr><td colspan=3>&nbsp;</td></tr>
	<tr><td colspan=3><input type=submit class=button name=submit value=Register></td></tr>
	</form>
	</table>
	<p>
	<li>Back to <a href=index.php>home</a>
    ";
    echo $content;
}

include "footer.php";
?>
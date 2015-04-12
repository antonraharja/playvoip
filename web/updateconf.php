<?
include "init.php";

$db_query = "SELECT * FROM tblUser WHERE flag_configured='0'";
$db_result = mysql_query($db_query);
while ($db_row = mysql_fetch_array($db_result))
{
    $email = $db_row['email'];
    $realname = $db_row['realname'];
    $phone = $db_row['phone'];
    $type = "friend";
    $username = $phone;
    $secret = $db_row['secret'];
    $host = "dynamic";
    $callerid = $db_row['callerid'];
    $context = "default";
    $dtmfmode = "rfc2833";
    $nat = "yes";
    $canreinvite = "no";
    if (conf_add_record ($conf_sip, $phone, $username, $secret, $callerid, $host, $type, $context, $dtmfmode, $nat, $canreinvite))
    {
	if (conf_add_record ($conf_iax, $phone, $username, $secret, $callerid, $host, $type, $context, $dtmfmode, $nat, $canreinvite))
	{
	    if (conf_add_voicemail ($conf_voicemail, $phone, $realname, $email))
	    {
		$db_query1 = "UPDATE tblUser SET flag_configured='1' WHERE phone='$phone'";
		$db_result1 = mysql_query($db_query1);
	    }
	}
    }
}

$db_query = "SELECT * FROM tblUser WHERE flag_update='1'";
$db_result = mysql_query($db_query);
while ($db_row = mysql_fetch_array($db_result))
{
    $email = $db_row['email'];
    $realname = $db_row['realname'];
    $phone = $db_row['phone'];
    $type = "friend";
    $username = $phone;
    $secret = $db_row['secret'];
    $host = "dynamic";
    $callerid = $db_row['callerid'];
    $context = "default";
    $dtmfmode = "rfc2833";
    $nat = "yes";
    $canreinvite = "no";
    if (conf_update_record ($conf_sip, $phone, $username, $secret, $callerid, $host, $type, $context, $dtmfmode, $nat, $canreinvite))
    {
	if (conf_update_record ($conf_iax, $phone, $username, $secret, $callerid, $host, $type, $context, $dtmfmode, $nat, $canreinvite))
	{
	    $db_query1 = "UPDATE tblUser SET flag_update='0' WHERE phone='$phone'";
	    $db_result1 = mysql_query($db_query1);
	}
    }
}

?>
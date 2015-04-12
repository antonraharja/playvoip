<?

function is_phone_exists($phone)
{
    $db_query = "SELECT id FROM tblUser WHERE phone='$phone' AND flag_inactive='0' LIMIT 1";
    $db_result = mysql_query($db_query);
    if ($db_row = mysql_fetch_array($db_result))
    {
	return true;
    }
    return false;
}

?>
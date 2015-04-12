<?

function sip_peers_online()
{
    global $conf_peers_sip, $conf_peers_iax;
    $fd = @fopen($conf_peers_sip,"r");
    $peers_content = @fread($fd,filesize($conf_peers_sip));
    @fclose($fd);
    $peers_online = array();
    $lines = explode("\n",$peers_content);
    $j = 0;
    for($i=0;$i<count($lines);$i++)
    {
	$peers = explode("                ",$lines[$i]);
	$phones = trim($peers[0]);
	$next_peers = trim($peers[1]);
	
	$peers = explode("D   N",$next_peers);
	$ip = trim($peers[0]);
	$next_peers = trim($peers[1]);
	$phone = explode("/",$phones);
	$phone = $phone[0];
	
	$peers = explode("   ",$next_peers);
	$status = trim($peers[1]);
	
	if ($phone && $ip && ($ip!="(Unspecified)"))
	{
	    if (is_phone_exists($phone))
	    {
		$sip_peers_online[$j] = array($phone,$ip,$status);
		$j++;
	    }
	}
    }
    return $sip_peers_online;
}

function iax_peers_online()
{
    global $conf_peers_iax, $conf_peers_iax;
    $fd = @fopen($conf_peers_iax,"r");
    $peers_content = @fread($fd,filesize($conf_peers_iax));
    @fclose($fd);
    $peers_online = array();
    $lines = explode("\n",$peers_content);
    $j = 0;
    for($i=0;$i<count($lines);$i++)
    {
	$peers = explode("255.255.255.255",$lines[$i]);
	$phones_and_ip = trim($peers[0]);
	$statuses = trim($peers[1]);
	
	$peers = explode("      ",$phones_and_ip);
	$phones = trim($peers[0]);
	$phone = explode("/",$phones);
	$phone = $phone[0];

	$ips = $peers[1];
	$next_peers = trim($ips);
	$peers = explode("(D)",$next_peers);
	$ip = trim($peers[0]);
	
	$peers = explode("        ",$statuses);
	$status = trim($peers[1]);
	
	if ($phone && $ip && ($ip!="(Unspecified)"))
	{
	    if (is_phone_exists($phone))
	    {
		$iax_peers_online[$j] = array($phone,$ip,$status);
		$j++;
	    }
	}
    }
    return $iax_peers_online;
}

?>
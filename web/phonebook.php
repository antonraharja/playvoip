<?
include "header.php";

$page = $_GET['page'];
if(!$page){$page = 1;}

$line_per_page = 30;
$sip_peers_online = sip_peers_online();
$num_of_sip_peers = count($sip_peers_online);

$content = "
    <p>Service numbers and prefixes:
    <p>
    <table cellpadding=1 cellspacing=1 border=0 width=310>
    <tr>
	<td class=box_title width=10>*</td>
    	<td class=box_title width=100>Phone/Prefix</td>
    	<td class=box_title width=200>Name</td>
    </tr>
";
foreach($services as $key => $value)
{
    $i++;
    $tr_param = "bgcolor=#e0e0e0";
    if($i % 2){$tr_param="bgcolor=#f0f0f0";} 
    $content .= "
	<tr $tr_param>
    	    <td class=box_text>$i.</td>
    	    <td class=box_text><center>$key</center></td>
    	    <td class=box_text>$value</a></td>
	</tr>
    ";
}
$content .= "
    </table>
";

$sip_peers_online = sip_peers_online();
$num_of_sip_peers = count($sip_peers_online);
$content .= "
    <p>
    <p>Online SIP phones: $num_of_sip_peers
    <p>
    <table cellpadding=1 cellspacing=1 border=0 width=710>
    <tr>
        <td class=box_title width=10>*</td>
        <td class=box_title width=100>Phone</td>
        <td class=box_title width=200>Name</td>
        <td class=box_title width=200>Location</td>
        <td class=box_title width=200>Status</td>
    </tr>
";
$j = 0;
for($i=0;$i<count($sip_peers_online);$i++)
{
    $j++;
    $peers = $sip_peers_online[$i];
    $phone = $peers[0];
    $ip = $peers[1];
    $status = $peers[2];
    $db_query = "SELECT realname,location FROM tblUser WHERE phone='$phone'";
    $db_result = mysql_query($db_query);
    $db_row = @mysql_fetch_array($db_result);
    $realname = $db_row['realname'];
    $location = $db_row['location'];
    $tr_param = "bgcolor=#e0e0e0";
    if($j % 2){$tr_param="bgcolor=#f0f0f0";}
    $content .= "
	<tr $tr_param>
    	    <td class=box_text>$j.</td>
    	    <td class=box_text><center>$phone</center></td>
    	    <td class=box_text>$realname</td>
    	    <td class=box_text>$location</td>
    	    <td class=box_text><center>$status</center></td>
	</tr>
    ";
}
$content .= "
    </table>
    <font size=-2>Note: update per minute</font>
";

$iax_peers_online = iax_peers_online();
$num_of_iax_peers = count($iax_peers_online);
$content .= "
    <p>
    <p>Online IAX phones: $num_of_iax_peers
    <p>
    <table cellpadding=1 cellspacing=1 border=0 width=710>
    <tr>
        <td class=box_title width=10>*</td>
        <td class=box_title width=100>Phone</td>
        <td class=box_title width=200>Name</td>
        <td class=box_title width=200>Location</td>
        <td class=box_title width=200>Status</td>
    </tr>
";
$j = 0;
for($i=0;$i<count($iax_peers_online);$i++)
{
    $j++;
    $peers = $iax_peers_online[$i];
    $phone = $peers[0];
    $ip = $peers[1];
    $status = $peers[2];
    $db_query = "SELECT realname,location FROM tblUser WHERE phone='$phone'";
    $db_result = mysql_query($db_query);
    $db_row = @mysql_fetch_array($db_result);
    $realname = $db_row['realname'];
    $location = $db_row['location'];
    $tr_param = "bgcolor=#e0e0e0";
    if($j % 2){$tr_param="bgcolor=#f0f0f0";}
    $content .= "
	<tr $tr_param>
    	    <td class=box_text>$j.</td>
    	    <td class=box_text><center>$phone</center></td>
    	    <td class=box_text>$realname</td>
    	    <td class=box_text>$location</td>
    	    <td class=box_text><center>$status</center></td>
	</tr>
    ";
}
$content .= "
    </table>
    <font size=-2>Note: update per minute</font>
";

$db_query = "SELECT count(*) as count FROM tblUser WHERE flag_configured='1'";
$db_result = mysql_query($db_query);
$db_row = mysql_fetch_array($db_result);
$num_rows = $db_row['count'];

$pages = ceil($num_rows/$line_per_page);
$nav_pages = "<a href=phonebook.php?page=1><<</a> ";
for($i=1;$i<=$pages;$i++)
{
    if ($i == $page)
    {
	$nav_pages .= "$i ";
    }
    else
    {
	$nav_pages .= "<a href=phonebook.php?page=$i>$i</a> ";
    }
}
$nav_pages .= "<a href=phonebook.php?page=$pages>>></a>";

$limit = ($page-1)*$line_per_page;

$content .= "
    <p>
    <p>Registered phone numbers:
    <p>
    $nav_pages
    <table cellpadding=1 cellspacing=1 border=0 width=505>
    <tr>
        <td class=box_title width=5>*</td>
        <td class=box_title width=90>Phone</td>
        <td class=box_title width=200>Name</td>
        <td class=box_title width=200>Location</td>
    </tr>
";
$db_query = "SELECT realname,location,phone FROM tblUser WHERE flag_configured='1' ORDER BY phone DESC LIMIT $limit,$line_per_page";
$db_result = mysql_query($db_query);
$i=$num_rows+1-$limit;
while ($db_row = @mysql_fetch_array($db_result))
{
    $realname = $db_row['realname'];
    $location = $db_row['location'];
    $phone= $db_row['phone'];
    $i--;
    $tr_param = "bgcolor=#e0e0e0";
    if($i % 2){$tr_param="bgcolor=#f0f0f0";}
    $content .= "
	<tr $tr_param>
	    <td class=box_text>$i.</td>
	    <td class=box_text><center>$phone</center></td>
	    <td class=box_text>$realname</td>
	    <td class=box_text>$location</td>
	</tr>
    ";
}
$content .= "
    </table>
    $nav_pages
    <p>
    <li>Back to <a href=index.php>home</a>
";
echo $content;

include "footer.php";
?>
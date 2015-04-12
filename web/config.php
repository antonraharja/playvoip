<?

$conf_db['host'] = "localhost";
$conf_db['user'] = "root";
$conf_db['pass'] = "";
$conf_db['name'] = "voiprakyat_asterisk";

// First assigned number
$conf_first_number = "40000";

// SIP or IAX2 domain tobe used in this server
$voip_domain = "voip.ictcentre.net";


// do not change below properties unless you know what you're doing


// below files must writable by webserver's user and group
// for easy setup, just chmod 666 each of these files
$conf_sip = "/etc/asterisk/sip_additional.conf";
$conf_iax = "/etc/asterisk/iax_additional.conf";
$conf_h323 = "/etc/asterisk/h323_additional.conf";
$conf_voicemail = "/etc/asterisk/voicemail_additional.conf";

// below files do not need tobe chmod
// unless your cron program is not running as root
$conf_peers_sip = "/var/log/asterisk/peers_sip";
$conf_peers_iax = "/var/log/asterisk/peers_iax";
$conf_peers_h323 = "/var/log/asterisk/peers_h323";

// listed as service numbers and prefixes on phonebook
$services = array(
    "900" => "Default Asterisk IVR demo",
    "901" => "Current server time",
    "902" => "Noise tests",
    "903" => "Echo tests",
    "904" => "Voicemail",
    "00" => "Prefix <a href=http://www.e164.org target=_blank>ENUM</a> Record (intl. calls)",
    "021" => "Prefix for <a href=http://voip.ictcentre.net>ICT Centre Jakarta</a>",
    "022" => "Prefix for <a href=http://voip.wankota.org>WANKOTA Bandung</a>",
    "0561" => "Prefix for <a href=http://voip.wanpontianak.net>WAN Pontianak</a>"
);

?>
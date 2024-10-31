<?
///////////////
// constants //
///////////////


define('HOST_NAME',$_SERVER['HTTP_HOST']);
define('CURRENT_URL',"http://".HOST_NAME.$_SERVER['REQUEST_URI']);

$AP_LANGS['catalan'] = "ca";
$AP_LANGS['danish'] = "da";
$AP_LANGS['deutsch'] = "da";
$AP_LANGS['english'] = "en";
$AP_LANGS['french'] = "fr";
$AP_LANGS['german'] = "de";
$AP_LANGS['italian'] = "it";
$AP_LANGS['russian'] = "ru";
$AP_LANGS['turkish'] = "tr";
$AP_LANGS['spanish'] = "es";

//////////////
// includes //
//////////////

include_once PATH_AP_INCLUDES."PEAR.php";
include_once PATH_AP_INCLUDES."http_request/request.php";
include_once PATH_AP_INCLUDES."http_request/net/Socket.php";
include_once PATH_AP_INCLUDES."http_request/net/URL.php";

include_once PATH_AP_INCLUDES."allopass.api.inc.php";
include_once PATH_AP_INCLUDES."flgjs.inc.php";

if ( !class_exists('buttonsnap') ) {
    include_once PATH_AP_INCLUDES."buttonsnap.php";
}

//////////////////
// init scripts //
//////////////////

// selected admin language
if(isset($_POST['ap_lang'])) {
    setcookie("ap_lang",$_POST['ap_lang'],time()+3600*24*365,"/");
    $_COOKIE['ap_lang'] = $_POST['ap_lang'];
}
$lang = (isSet($_COOKIE['ap_lang']))?$_COOKIE['ap_lang']:"english";

if(in_array($lang,array_keys($AP_LANGS))) {
    $lang_code = $AP_LANGS[$lang];
} else {
    $lang_code = "en";
}

include_once PATH_AP_LANGS.$lang.".lang";

///////////////
// functions //
///////////////

function get_languages() {

    $dh = opendir(PATH_AP_LANGS);
    while($f = readdir($dh)) {
        if($f != "." && $f != ".." && $f != "public.lang") {
            $langs[] = str_replace(".lang","",$f);
        }
    }
    return $langs;

}

?>

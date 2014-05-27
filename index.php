<?php /*
#### Einplac CMS ####
#
# Author: Renats Kevrels
# Home page: www.myworld.lv
# Forum: www.privet.lv/forum/
# Skype: renat2985
# Twitter: Ramzies
# E-mail: info@myworld.lv
#
#################
#
# Protected by a Creative Commons Attribution 3.0 License.
# http://creativecommons.org/licenses/by/3.0/
#
# Просьба уважать авторское право и сохранять ссылку на Einplac. CMS распространяются по лицензии Creative Commons Attribution 3.0. 
# Эта лицензия допускает как коммерческое, так и личное использование, но только при условии сохранения ссылки на разработчика в том виде, в котором он указал ее.
#
#################*/

//ini_set('display_errors','On');
//ini_set('display_errors','Off');
//error_reporting(E_ALL);

// ##########################
// 	START CONFIGURE CMS
// ##########################
$version = 'v2.9e';			// Version Einplac CMS
$version_date = '2015.05.27';	// Realise date version
$directory = './files';		// Content folder
$directory_template = './template';	// Template folder
$type_files = '.txt';			// Content type files
$upload_folder = './images/';	// Image upload folder
$upload_max_size = '3000';		// Max size Kb
$upload_file = 'jpg|png|jpeg|gif';	// Allow file
$cookie = 'einplaccms';		// Pass cookie name
$cookie_time = '86400';		// Login time (86400 = 1 day)
$edit_content = 'dblclick';		// Edit content to: dblclick or click or mouseover
$page_name_max = '25';		// Page name max 25 symbol
$multi_lang = 'off';			// Multilanguage: off or en,lv,ru,de
$range_ip = 'all';			// Allow admin IP: 'all' or IP or IP1,IP2,IP3
$salt = '4rGe35ktY';		// Key: Enter here you text 5-10 symbol (Delete password.php)
date_default_timezone_set('Europe/Riga');
// ##########################
// 	END CONFIGURE
// ##########################



function GET($name){return isset($_GET[$name]) ? $_GET[$name] : '';}
function POST($name){return isset($_POST[$name]) ? $_POST[$name] : '';}
function COOKIE($name){return isset($_COOKIE[$name]) ? $_COOKIE[$name] : '';}

$page = preg_replace('#[^a-zA-Z0-9-_]#i', '', GET('page'));
$page = substr($page, 0, $page_name_max);
if (!$page) $page = 'home';
if ($range_ip == 'all') {$ip_user = 'all';} else {$ip_user = $_SERVER['REMOTE_ADDR'];}

// LANGUAGE
// You can download new language here: http://www.myworld.lv/einplaccms.html#language
$lang=array(
'title' => 'Welcome Einplac CMS!',
'navigation' => 'Double click here to edit your <b>navigation</b>.',
'slogan' => 'Double click here to edit your <b>slogan</b>.',
'copyright' => 'Double click here to edit your <b>copyright</b>.',
'attachment' => 'Double click here to edit your <b>attachment',
'description' => 'Enter your description here.',
'keywords' => 'Enter your keywords, here.',
'create_page' => 'Create new page',
'create_page2' => 'Your page named <b>'.$page.'</b> is created.<br />Double click here to edit your new created page.',
'delete_page' => 'Delete this page',
'delete_page2' => 'Do you really want to delete this',
'delete' => 'Delete',
'down_new_version' => 'Download new version!',
'login' => 'Log In',
'logout' => 'Log Out',
'join' => 'Join',
'password' => 'Password',
'pass_new' => 'New Password',
'pass_default' => 'password: <b>admin</b>',
'pass_error1' => 'Error<br />Password not correctly.',
'pass_error2' => 'Error, unable to save password<br />Please make sure read/write permissions are enabled.',
'pass_change' => 'Change your password?',
'pass_change2' => 'Type your <b>old</b> password above, and your new one in the field below.',
'pass_changed' => 'Password changed!<br />Please login again.',
'pass_access' => 'You must login first before you can use this function!',
'loading' => 'Loading...',
'saving' => 'Saving...',
'save' => 'Save',
'cancel' => 'Cancel',
'click_to_edit' => 'Doubleclick to edit...',
'change' => 'Change',
'web_settings' => 'Web Settings',
'edit_view_text' => 'Edit view text',
'template' => 'Template',
'example' => 'Example',
'or' => 'or',
'lang' => 'Language',
'local' => 'Localization',
'other_opt' => 'Other options',
'other' => 'other',
'show_hide' => 'Click to show/hide',
'upload_files' => 'Upload files',
'add' => 'Add',
'add_to_menu' => 'to list menu?',
'allow' => 'Allow',
'support' => 'Support',
'file_manager' => 'File manager',
'image_manager' => 'Image manager',
'upload' => 'Upload',
'open' => 'Open',
'img_size' => 'Image size',
'support2' => 'If you have any questions, please, apply to',
'info_title' => 'Recommended from 10 to 70 characters.',
'info_description' => 'Recommended from 10 to 160 characters.',
'info_keywords' => 'Recommended write the words after the comma.',
'error_404' => 'ERROR 404<br /> Page not found.',
'error_open' => 'Error, unable to open file.<br />Please make sure read/write permissions are enabled.'
);
if (file_exists($directory.'/lang.php')) {
include($directory.'/lang.php');
}

// MULTILANGUAGE
if ($multi_lang != 'off') {
    $multi_lang_get = preg_replace('#[^a-z]#i', '', GET('lang'));
    $multi_lang_get = substr($multi_lang_get, 0, 2); // Lang name max 2 symbol
      if (in_array($multi_lang_get,explode(',',$multi_lang))){
        $multi_lang=$multi_lang_get;
        $type_files='_'.$multi_lang.$type_files;
      } else {$multi_lang='';}
} else {$multi_lang= '';}

// FIRST START
$content[0] = @file_get_contents($directory.'/'.$page.$type_files);
$content[1] = @file_get_contents($directory.'/attachment1'.$type_files);
$content[2] = @file_get_contents($directory.'/attachment2'.$type_files);
$content[3] = @file_get_contents($directory.'/attachment3'.$type_files);
$content[4] = @file_get_contents($directory.'/attachment4'.$type_files);
$content[5] = @file_get_contents($directory.'/attachment5'.$type_files);
$content[6] = @file_get_contents($directory.'/attachment6_'.$page.$type_files);
$content[7] = @file_get_contents($directory.'/attachment7_'.$page.$type_files);
$content[8] = @file_get_contents($directory.'/attachment8_'.$page.$type_files);
$content[9] = @file_get_contents($directory.'/attachment9_'.$page.$type_files);

$title = @file_get_contents($directory.'/title_'.$page.$type_files);
$navigation = @file_get_contents($directory.'/navigation'.$type_files);
$slogan = @file_get_contents($directory.'/slogan'.$type_files);
$description = @file_get_contents($directory.'/description_'.$page.$type_files);
$keywords = @file_get_contents($directory.'/keywords_'.$page.$type_files);
$copyright = @file_get_contents($directory.'/copyright'.$type_files);
$viewtext = @file_get_contents($directory.'/options_viewtext'.$type_files);
$template = @file_get_contents($directory.'/options_template'.$type_files);
if (!file_exists($directory_template.'/'.$template.'.tpl')) $template = 'default';

$password = @file_get_contents($directory.'/password.php');
$password = str_replace('<?php $password="', '', $password); //fix by last version
$password = str_replace('"; ?>', '', $password); //fix by last version
if (!$password) { savePassword('admin'); }


if ((COOKIE($cookie) == $password) and (in_array($ip_user,explode(',',$range_ip)))) {

  if (!$content[1]) $content[1] = $lang['attachment'].'1</b>.';
  if (!$content[2]) $content[2] = $lang['attachment'].'2</b>.';
  if (!$content[3]) $content[3] = $lang['attachment'].'3</b>.';
  if (!$content[4]) $content[4] = $lang['attachment'].'4</b>.';
  if (!$content[5]) $content[5] = $lang['attachment'].'5</b>.';
  if (!$content[6]) $content[6] = $lang['attachment'].'6_'.$page.'</b>.';
  if (!$content[7]) $content[7] = $lang['attachment'].'7_'.$page.'</b>.';
  if (!$content[8]) $content[8] = $lang['attachment'].'8_'.$page.'</b>.';
  if (!$content[9]) $content[9] = $lang['attachment'].'9_'.$page.'</b>.';  

  if (!$title) $title = $lang['title'];
  if (!$navigation) $navigation = $lang['navigation'];
  if (!$slogan) $slogan = $lang['slogan'];
  if (!$description) $description = $lang['description'];
  if (!$keywords) $keywords = $lang['keywords'];
  if (!$copyright) $copyright = $lang['copyright'];
  if (!$viewtext) $viewtext = 'textarea';

  $lstatus = '<a href="./?logout">'.$lang['logout'].'</a>';
  $navigation = '<span id="navigation" class="edittext">'.$navigation.'</span>';
  $slogan = '<span id="slogan" class="edittext">'.$slogan.'</span>';
  $copyright = '<span id="copyright" class="edittext">'.$copyright.'</span>';
  if (!$content[0]) $content[0] = '<p>'.$lang['create_page2'].'</p>
<p id="add_to_menu"><a href="#'.$page.'">'.$lang['add'].'</a> '.$lang['add_to_menu'].'</p>';


// UPDATE CMS - (Need CURL)
if (function_exists('curl_init')) {
if (COOKIE('updatecms') == '') {
  $url = 'http://www.myworld.lv/einplaccms.zip';
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_NOBODY, true);
  curl_setopt($ch, CURLOPT_HEADER, true);
  $headers = curl_exec($ch);
  if(preg_match("#last-modified:\s*(.*)\n#i", $headers, $out)) {
    $ts = strtotime($out[1]);
    $upgrade_date = date('Ymd', $ts);
    $version_date = preg_replace('#[^0-9]#i', '', $version_date);
    if ($upgrade_date > $version_date) {
      setcookie('updatecms', 'new', time()+86400); // 1 day
    } else {
      setcookie('updatecms', 'ok', time()+691200); // 7 day
    }
  } 
}
}
  if (COOKIE('updatecms') == 'new') {
    $new_version = '<li id="new_version"><b><a href="http://www.myworld.lv/einplaccms.html">'.$lang['down_new_version'].'</a> '.$lang['or'].' <a href="#" onclick="createCookie(\'updatecms\',\'ok\',\'30\');showhideOpt(\'new_version\');return false">'.$lang['cancel'].'</a></b></li>';
  } 
  
} else { 
  $lstatus = '<a href="./?login">'.$lang['login'].'</a>';
  if (!$content[0]) {
    $content[0] = '<h2 class="message error_404">'.$lang['error_404'].'</h2>'; 
    $title = strip_tags($lang['error_404']);
    $description = strip_tags($lang['error_404']);
    $keywords = strip_tags($lang['error_404']);
  };
}

if (isset($_REQUEST['login'])) { displayLoginForm(); }
if (isset($_REQUEST['images'])) { displayImagesExplorer(); }

if (isset($_REQUEST['logout'])) {
  setcookie($cookie, '', time()-$cookie_time); // Remove pass cookie
  header('Location: ./');
  exit;
}


// FUNCTIONS
function loginSubmitted() {
  global $cookie, $password, $msg, $cookie_time, $lang, $salt, $ip_user, $range_ip;
    
  if (((md5(md5($salt).md5(POST('password'))) == $password) or (md5(POST('password')) == $password)) and (in_array($ip_user,explode(',',$range_ip)))){
  
  if (POST('newpassword')) {
    savePassword(POST('newpassword'));
    $msg = '<h2 class="message pass_changed">'.$lang['pass_changed'].'</h2>';
    return;
  }
  setcookie($cookie, $password, time()+$cookie_time);
  header('Location: ./');
  exit;
  
  } else {
    $msg = '<h2 class="message pass_error1">'.$lang['pass_error1'].'</h2>';
    return;
  }
}

function savePassword($password) {
  global $directory, $lang, $salt;
  $password = md5(md5($salt).md5($password));
  $file = @fopen($directory.'/password.php', 'w');
  if (!$file) {
    echo '<h2 class="message pass_error2">'.$lang['pass_error2'].'</h2>';
    exit;
  }
  fwrite($file, '<?php $password="'.$password.'"; ?>');
  fclose($file);
}

function displayEditLibrary() {
  global $cookie, $viewtext, $lang, $upload_file, $upload_folder, $upload, $multi_lang, $page, $edit_content, $directory, $password, $ip_user, $range_ip;
  echo '<!-- This page was generated by Einplac CMS. -->
  <script type="text/javascript" src="./js/jquery.min.js"></script>';
  
if ((COOKIE($cookie) == $password) and (in_array($ip_user,explode(',',$range_ip)))) {
  echo '
  <script type="text/javascript" src="./js/jquery.jeditable.js"></script>
  '.($viewtext=='wysiwyg'?('<script type="text/javascript" src="./js/jquery.wysiwyg.js"></script><link rel="stylesheet" type="text/css" href="./css/jquery.wysiwyg.css" />'):'').'
  <script type="text/javascript" src="./js/fileuploader.js" ></script> 
  <script type="text/javascript">$(document).ready(function() {
  $(".edittext").editable("./?edit=on&page='.$page.($multi_lang?('&lang='.$multi_lang):'').'",{
    type:"'.$viewtext.'",indicator:"'.$lang['saving'].'",submit:"'.$lang['save'].'",
    cancel:"'.$lang['cancel'].'",tooltip:"'.$lang['click_to_edit'].'",event:"'.$edit_content.'"
  });
  $(".edittextarea").editable("./?edit=on'.($multi_lang?('&lang='.$multi_lang):'').'",{
    type:"textarea",indicator:"'.$lang['saving'].'",submit:"'.$lang['save'].'",
    cancel:"'.$lang['cancel'].'",tooltip:"'.$lang['click_to_edit'].'",event:"'.$edit_content.'", callback:function(){location.reload();}
  });
  $(".editselect").editable("./?edit=on'.($multi_lang?('&lang='.$multi_lang):'').'", { 
    data:"{\'textarea\':\'textarea\',\'wysiwyg\':\'wysiwyg\'}",
    type:"select",indicator:"'.$lang['saving'].'",submit:"'.$lang['save'].'",
    cancel:"'.$lang['cancel'].'",tooltip:"'.$lang['click_to_edit'].'",event:"'.$edit_content.'", callback:function(){location.reload();}
  });
  $(".editinput").editable("./?edit=on'.($multi_lang?('&lang='.$multi_lang):'').'", { 
    indicator:"'.$lang['saving'].'",submit:"'.$lang['save'].'",
    cancel:"'.$lang['cancel'].'",tooltip:"'.$lang['click_to_edit'].'",event:"'.$edit_content.'", callback:function(){location.reload();}
  });
  
  $("#add_to_menu a").click(function() {
    id_page = $("#add_to_menu a").attr("href").substring(1);
    $("<li><\/li>").appendTo("#navigation ul").html(\'<a href="./?page=\'+id_page+\''.($multi_lang?('&lang='.$multi_lang):'').'">\'+id_page+\'<\/a>\');
    getpost("navigation", $("#navigation").html(),"off");
    $("#add_to_menu").remove();
    return false;
  });
  
  if ($("#title span").html().length < 10 || $("#title span").html().length > 70) {$("#title i").css("display","block")} else {$("#title i").css("display","none")}
  if ($("#description span").html().length < 10 || $("#description span").html().length > 160) {$("#description i").css("display","block")} else {$("#description i").css("display","none")}
  if (/,/.test($("#keywords span").html())){$("#keywords i").css("display","none"); } else { $("#keywords i").css("display","block");}

  });
  
   function getpost(set_id, set_value, reload){     
    $.post("./?edit=on'.($multi_lang?('&lang='.$multi_lang):'').'", {id: set_id, value: set_value},
    function(data) {if(reload!=\'off\'){location.reload(true);}});
  }
  
   function resizeimage(set_src){ 
    $.post("./?img=on", {src: set_src, width:$("#width"+set_src.replace(/[^0-9A-Za-z]/g, \'\')).val(), height:$("#height"+set_src.replace(/[^0-9A-Za-z]/g, \'\')).val()},
    function(data) {$("#status").append("Resize OK.<br>");$(".resbut").val("'.$lang['change'].'");});
  }

  function createCookie(name,value,days){if(days){var date=new Date();date.setTime(date.getTime()+(days*24*60*60*1000));var expires="; expires="+date.toGMTString()}else expires="";document.cookie=name+"="+value+expires+"; path=/"}

  function readCookie(name){var nameEQ=name+"=";var ca=document.cookie.split(\';\');for(var i=0;i<ca.length;i++){var c=ca[i];while(c.charAt(0)==\' \')c=c.substring(1,c.length);if(c.indexOf(nameEQ)==0)return c.substring(nameEQ.length,c.length)}return null}
  
  function showhideOpt(name){$("#"+name).toggle("700",function(){if($("#"+name).css("display")=="none")createCookie(name,"off","365"); else createCookie(name,"on","365");});}

  function downLang(name){if(confirm("Download this lang.php for you directory: '.$directory.'/")){window.location.href="http://www.myworld.lv/lang/"+name+"/lang.php";}}

  $(function(){var btnUpload=$("#upload");var status=$("#status");new AjaxUpload(btnUpload,{action:"index.php?qqfile=on",name:"uploadfile",onSubmit:function(file,ext){if(!(ext&&/^('.$upload_file.')$/.test(ext))){status.text("Only '.$upload_file.' files are allowed");return false}status.text("'.$lang['loading'].'")},onComplete:function(file,response){status.text("");if(response==="success"){$("<li><\/li>").appendTo("#files").html("<a href=\"'.$upload_folder.'"+file+"\">'.$upload_folder.'"+file+"<\/a> (<a href=\"#\" onclick=\"$(\'#img_"+file.replace(/[^0-9A-Za-z]/g, \'\')+"\').toggle(700);return false;\">resize<sup>beta</sup></a>)<ul id=\"img_"+file.replace(/[^0-9A-Za-z]/g, \'\')+"\" style=\"display:none\"><li><b>'.$lang['img_size'].':</b> <input type=\"text\" name=\"width\" id=\"width"+file.replace(/[^0-9A-Za-z]/g, \'\')+"\" value=\"\" style=\"width:30px\" />x<input type=\"text\" name=\"height\" id=\"height"+file.replace(/[^0-9A-Za-z]/g, \'\')+"\" value=\"\" style=\"width:30px\" /> <input type=\"button\" class=\"button resbut\" onclick=\"this.value=\''.$lang['loading'].'\';resizeimage(\'"+file+"\');return false;\" value=\"'.$lang['change'].'\"/></li></ul> ").addClass("success")}else{$("<li><\/li>").appendTo("#files").html("<a href=\"./images/"+file+"\">./images/"+file+"<\/a>").text(file).addClass("error")}}})});
  </script>';
  
  } else {
  
  echo '';
  }

}

function displayMainContent() {
  global $cookie, $content, $page, $password, $ip_user, $range_ip;
if ((COOKIE($cookie) == $password) and (in_array($ip_user,explode(',',$range_ip)))) {
    echo '<span id="'.$page.'" class="edittext">'.$content[0].'</span>';
  } else echo $content[0];
}

function displaySectionContent($number) {
  global $cookie, $content, $password, $ip_user, $range_ip;
if ((COOKIE($cookie) == $password) and (in_array($ip_user,explode(',',$range_ip)))) {
    echo '<span id="'.$number.'" class="edittext">'.$content[$number].'</span>';
  } else echo $content[$number];
}

function displayLoginForm() {
  global $content, $msg, $password, $lang, $salt, $cookie, $page;
  $msg = '';
  $page = '';
 
if (isset($_POST['sub'])) loginSubmitted();
$content[0] = '
<form action="./" id="cmslogin" method="POST">
<h2>'.$lang['login'].'</h2>
<p><label for="password">'.$lang['password'].':</label> <input type="password" id="password" name="password" /> '.(($password==md5(md5($salt).md5('admin')) or ($password==md5('admin')))?('<i>('.$lang['pass_default'].' <a href="#" onclick="$(\'#changepass\').toggle(700);return false;" title="'.$lang['show_hide'].'"'.(COOKIE($cookie)==$password?(' style="display:none"'):'').'>'.$lang['change'].'?</a>)</i>'):'').'<br />
<input type="submit" class="button" name="login" onclick="this.value=\''.$lang['loading'].'\'" value="'.$lang['join'].'"'.(COOKIE($cookie)==$password?(' style="display:none"'):'').' /></p>
'.$msg.'
<p><a href="#" onclick="$(\'#changepass\').toggle(700);return false;" title="'.$lang['show_hide'].'"'.(COOKIE($cookie)==$password?(' style="display:none"'):'').'>'.$lang['pass_change'].'</a></p> 
<p id="changepass" style="display:'.(COOKIE($cookie)==$password?('block'):'none').'">'.$lang['pass_change2'].'<br />
<label for="newpassword">'.$lang['pass_new'].':</label> <input type="text" id="newpassword" name="newpassword" /><br />
<input type="submit" class="button" name="login" onclick="this.value=\''.$lang['loading'].'\'" value="'.$lang['change'].'" />
<input type="hidden" name="sub" value="sub" /></p>
</form>
<script type="text/javascript">$(document).ready(function(){$("#password").focus()});</script>';
}

function displaySettings() {
  global $page, $description, $keywords, $title, $slogan, $copyright, $template, $viewtext, $new_version, $lang, $multi_lang, $upload_max_size, $cookie, $password, $ip_user, $range_ip, $page_name_max;
  
  if ((COOKIE($cookie) == $password) and (in_array($ip_user,explode(',',$range_ip)))) {
  if (!$page) $page = 'home';
  
  echo '
<div id="cmssettings">
<h2 id="title_cmssettings">'.$lang['web_settings'].'</h2>
<ul id="settingcms">'.$new_version.'<li>'.$lang['click_to_edit'].'</li>
  <ul>
    <li id="title"><b>Title:</b> <span id="title_'.$page.'" class="edittextarea">'.$title.'</span> <i>('.$lang['info_title'].')</i></li>
    <li id="title_meta_seo"><b><a href="#" onclick="showhideOpt(\'meta_seo\');return false" title="'.$lang['show_hide'].'">Meta / SEO</a>:</b></li>
  <ul id="meta_seo">
    <li id="description"><b>Description:</b> <span id="description_'.$page.'" class="edittextarea">'.$description.'</span> <i>('.$lang['info_description'].')</i></li>
    <li id="keywords"><b>Keywords:</b> <span id="keywords_'.$page.'" class="edittextarea">'.$keywords.'</span> <i>('.$lang['info_keywords'].')</i></li> 
  </ul>
  <li id="title_other_options"><b><a href="#" onclick="showhideOpt(\'other_options\');return false" title="'.$lang['show_hide'].'">'.$lang['other_opt'].'</a>:</b></li> 
  <ul id="other_options">
    <li><b>'.$lang['edit_view_text'].':</b> <span id="options_viewtext" class="editselect">'.$viewtext.'</span></li>
    <li><b>'.$lang['template'].':</b> <span id="options_template" class="editinput">'.$template.'</span> <i>('.$lang['example'].': <a href="#" onclick="getpost(\'options_template\', \'wuwei\')">wuwei</a>, <a href="#" onclick="getpost(\'options_template\', \'minimalistic\')">minimalistic</a>, <a href="#" onclick="getpost(\'options_template\', \'manifest\')">manifest</a>, <a href="#" onclick="getpost(\'options_template\', \'default\')">default</a> '.$lang['or'].' <a href="http://www.privet.lv/forums/YaBB.pl?board=homesoft">'.$lang['other'].'</a>.)</i></li>
    <li><b>'.$lang['local'].':</b> <a href="#" onclick="downLang(\'ru\')">по-русски</a>, <a href="#" onclick="downLang(\'lv\')">latviski</a> '.$lang['or'].' <a href="http://www.myworld.lv/einplaccms.html#language">'.$lang['other'].'</a>.</li>
    <li><b>'.$lang['password'].'</b>: <a href="./?login">'.$lang['change'].'</a></li>
    <li><b>'.$lang['file_manager'].':</b> <a href="'.(!file_exists('./rz-admin.php')?('http://www.myworld.lv/renzcms.html">'.$lang['upload']):'./rz-admin.php">'.$lang['open']).'</a></li>
    <li><b>'.$lang['image_manager'].':</b> <a href="./?images">'.$lang['open'].'</a></li>
  </ul>
  <li id="create_newpage"><b><a href="#" onclick="showhideOpt(\'formnewpage\');return false" title="'.$lang['show_hide'].'">'.$lang['create_page'].'</a></b></li>
    <ul id="formnewpage" style="display:none">
      <li><form action="./" method="get"><i>./?page=</i><input name="page" value="page-name" maxlength="'.$page_name_max.'" style="display:inline" onfocus="this.value=\'\'" />'.($multi_lang?('<input type="hidden" style="display:none" name="lang" value="'.$multi_lang.'" />'):'').'<button type="submit">'.$lang['save'].'</button><i> ('.$lang['allow'].': a-zA-Z0-9-_)</i></form></li>
    </ul>
  
  <li id="delete_page"><b><a href="#" onclick="if(confirm(\''.$lang['delete_page2'].': \'+window.location.href+\' ?\')){window.location=window.location.href+\'&delete=on\';}">'.$lang['delete_page'].'</a></b></li>
  <li id="upload"><b><a href="#">'.$lang['upload_files'].'</a></b> <i>(Max: '.$upload_max_size.'Kb)</i></li>
  <ul id="files"></ul>
  </ul>
</ul>
<span id="status"></span>	
<br />
  <h2 id="title_supportcms"><a href="#" onclick="showhideOpt(\'supportcms\');return false" title="'.$lang['show_hide'].'">'.$lang['support'].'</a></h2>
  <ul id="supportcms">
    <li>'.$lang['support2'].':</li>
     <ul>
       <li><b>Home page</b>: <a href="http://www.myworld.lv/einplaccms.html">www.myworld.lv</a></li>
       <li><b>Forum</b>: <a href="http://www.privet.lv/forums/YaBB.pl?board=homesoft">www.privet.lv/forum/</a></li>
       <li><b>Skype</b>: <a href="skype:renat2985?chat" style="background:transparent url(http://mystatus.skype.com/smallicon/renat2985) no-repeat scroll 0;padding:0 0 2px 18px">renat2985</a></li>
       <li><b>Twitter</b>: <a href="http://twitter.com/#!/Ramzies">Ramzies</a> / <a href="https://api.twitter.com/1/favorites/Ramzies.rss">rss</a></li>
       <li><b>E-mail</b>: <a href="mailto:info@myworld.lv">info@myworld.lv</a></li>
     </ul>
   </ul>

<b>PayPal</b>: <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=W4PURUNKWMRJW&lc=LV&item_name=Donation%20for%20Einplac CMS.%20Thanks%20You!&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted" style="  background-color:#FEE2AB;border:1px solid #F93;color:#036;padding:1px 5px;font:italic bold 11px Georgia,Palatino,Times;">Donate</a><br />
<small><a href="http://creativecommons.org/licenses/by/3.0/">Creative Commons License</a></small>
</div>
<script type="text/javascript">
  function checkHide(name){if(readCookie(name)=="off"){$("#"+name).css({"display":"none"});}}
  checkHide("meta_seo");checkHide("other_options");checkHide("supportcms");
</script>';
}
}


function displayImagesExplorer() {
  global $content, $msg, $lang, $salt, $page, $cookie, $password, $ip_user, $range_ip, $upload_folder;
  if ((COOKIE($cookie) == $password) and (in_array($ip_user,explode(',',$range_ip)))) {
    $msg = '';
    $page = '';

    $images = scandir($upload_folder);
    $ignore = Array(".", "..");
    $content[0] = '<h2>'.$lang['image_manager'].'</h2>';
    foreach($images as $curimg){
      if(!in_array($curimg, $ignore)) {
        $content[0] .= '<a onclick="if(confirm(\''.$lang['delete_page2'].' '.$curimg.' ?\')){window.location=\'./?delimg='.$curimg.'\';}" href="#">'.$lang['delete'].'</a> - <a href="'.$upload_folder.$curimg.'">'.$curimg.'</a><br>';
      }
    }

  } else $content[0] = $lang['pass_access'];
}



if (GET('edit') == 'on') {
// EDIT PAGE
if ((COOKIE($cookie) == $password) and (in_array($ip_user,explode(',',$range_ip)))) {
$file_name = preg_replace('#[^a-zA-Z0-9-_]#i', '', POST('id'));
$file_name = substr($file_name, 0, $page_name_max+12);

$content = rtrim(stripslashes(POST('value')));
if(!$content) $content = 'Please enter content...';
   
if ($file_name > 0 && $file_name < 6) $fname = 'attachment'.$file_name;
  else if ($file_name > 5 && $file_name < 10) $fname = 'attachment'.$file_name.'_'.$page;
  else $fname = $file_name;
  
$file = @fopen($directory.'/'.$fname.$type_files, 'w');
if (!$file) {
  echo '<h2 class="message error_open">'.$lang['error_open'].'</h2>';
  exit;
}
//fwrite($file, iconv('windows-1251', 'utf-8', $content));  // Cyrillic does not work?
fwrite($file, $content);
fclose($file);

echo $content;

} else {
  echo $lang['pass_access'];
  exit;
}


} else if (GET('delete') == 'on') {
//DELETE FILES
if ((COOKIE($cookie) == $password) and (in_array($ip_user,explode(',',$range_ip)))) {
if (file_exists($directory."/".$page.$type_files)) unlink($directory."/".$page.$type_files);
if (file_exists($directory.'/title_'.$page.$type_files)) unlink($directory.'/title_'.$page.$type_files);
if (file_exists($directory.'/description_'.$page.$type_files)) unlink($directory.'/description_'.$page.$type_files);
if (file_exists($directory.'/keywords_'.$page.$type_files)) unlink($directory.'/keywords_'.$page.$type_files);
if (file_exists($directory.'/attachment6_'.$page.$type_files)) unlink($directory.'/attachment6_'.$page.$type_files);
if (file_exists($directory.'/attachment7_'.$page.$type_files)) unlink($directory.'/attachment7_'.$page.$type_files);
if (file_exists($directory.'/attachment8_'.$page.$type_files)) unlink($directory.'/attachment8_'.$page.$type_files);
if (file_exists($directory.'/attachment9_'.$page.$type_files)) unlink($directory.'/attachment9_'.$page.$type_files);
header('Location: ./');

} else {
  echo $lang['pass_access'];
  exit;
}


} else if (GET('delimg') != '') {
// DELETE IMAGES
if ((COOKIE($cookie) == $password) and (in_array($ip_user,explode(',',$range_ip)))) {

if (file_exists($upload_folder.GET('delimg'))) unlink($upload_folder.GET('delimg'));
header('Location: ./?images');
  
} else {
  echo $lang['pass_access'];
  exit;
}


} else if (GET('img') == 'on') {
// IMAGE RESIZE(BETA)
if ((COOKIE($cookie) == $password) and (in_array($ip_user,explode(',',$range_ip)))) {
#SimpleImage - Author: Simon Jarvis
#Copyright: 2006 Simon Jarvis
class SimpleImage {
   var $image;
   var $image_type;
   function load($filename) {
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=80, $permissions=null) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image,$filename);
      }
      if($permissions != null) {chmod($filename,$permissions);}
   }
   function output($image_type=IMAGETYPE_JPEG) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image);
      }
   }
   function getWidth() {return imagesx($this->image);}
   function getHeight() {return imagesy($this->image);}
   function resizeToHeight($height) {
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }      
}
   $image = new SimpleImage();
   $image->load($upload_folder.POST('src'));
   if (POST('width') != '' and POST('height') == '') {$image->resizeToWidth(POST('width'));}
   if (POST('height') != '' and POST('width') == '') {$image->resizeToHeight(POST('height'));}
   if (POST('height') != '' and POST('width') != '') {$image->resize(POST('width'),POST('height'));}
   $image->save($upload_folder.POST('src'));
   
} else {
  echo $lang['pass_access'];
  exit;
}


} else if (GET('qqfile') != '') {
// UPLOAD FILE
if ((COOKIE($cookie) == $password) and (in_array($ip_user,explode(',',$range_ip)))) {
  if ($_FILES['uploadfile']['size'] < $upload_max_size*1000) {
    $file = $upload_folder . basename($_FILES['uploadfile']['name']); 
    if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) { 
      echo 'success'; 
    } else {echo 'error';}
  } else {echo 'error';}
  
} else {
  echo $lang['pass_access'];
  exit;
}


} else {
// VIEW TEMPLATE
$string = file_get_contents($directory_template.'/'.$template.'.tpl');
if ((strpos($string, '>Einplac')) or (strpos($string, '/button80x15.png" /></a>'))) {
require($directory_template.'/'.$template.'.tpl');
} else {
echo '<a href="http://creativecommons.org/licenses/by/3.0/">Creative Commons License!</a><br/>Please write to file "<i>'.$directory_template.'/'.$template.'.tpl</i>": <br/>- Text: "<b>Powered by:&lt;a href="http://www.myworld.lv/einplaccms.html">Einplac CMS&lt;/a></b>". <br/>- '.$lang['or'].' Image: "<b>&lt;a href="http://www.myworld.lv/einplaccms.html">&lt;img  alt="button 80x15" src="./images/button80x15.png" />&lt;/a></b>". <br /><br />'.$lang['support2'].':<br />- Skype: <a href="skype:renat2985?chat">renat2985</a><br />- E-mail</b>: <a href="mailto:info@myworld.lv">info@myworld.lv</a>';}
} 

?>

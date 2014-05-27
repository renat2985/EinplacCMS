<?php
// Einplac CMS Template
// Last update: 06/06/2011
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title><?php echo $title; ?></title>
    <meta name="description" content="<?php echo $description; ?>" />
    <meta name="keywords" content="<?php echo $keywords; ?>" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="robots" content="index, follow" />
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
    <link rel="stylesheet" type="text/css" href="./css/manifest.css" />
    <?php echo displayEditLibrary(); ?>
    <script type="text/javascript" src="./js/facebox.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/facebox.css" />
    <script type="text/javascript">
      $(document).ready(function() {
        $('a[rel*=facebox], a[href$=".jpg"], a[href$=".jpeg"], a[href$=".gif"], a[href$=".png"]').facebox();
      });
    </script>
  </head>
  <body>
    <div id="siteWrapper">
      <h1><a href="./"><?php echo $title; ?></a></h1>
      <div id="mainNav"><?php echo $navigation; ?></div>
      <div id="siteDescription"><?php echo $slogan; ?></div>
      <div id="coreContent">
        <div class="post">
          <h5><abbr><?php echo displaySectionContent('7'); /* Duplicated on each pages: MIN:1, MAX:5. Individually on each page: MIN:6, MAX:9 */ ?></abbr></h5>
          <div class="entry-content"><?php echo displayMainContent(); ?></div>
        </div>
        <div class="post">
          <h5><abbr><?php echo displaySectionContent('1'); /* Duplicated on each pages: MIN:1, MAX:5. Individually on each page: MIN:6, MAX:9 */ ?></abbr></h5>
          <div class="entry-content"><?php echo displaySectionContent('2'); /* Duplicated on each pages: MIN:1, MAX:5. Individually on each page: MIN:6, MAX:9 */ ?></div>
        </div>
      </div>
      <?php if(COOKIE($cookie) == $password) echo displaySettings().'<a href="#" id="settingopenhide">'.$lang['web_settings'].'</a><script type="text/javascript">$("#cmssettings").hide(0);$("#settingopenhide").click(function(){$(\'#cmssettings\').toggle(500);return false;}); </script>'; ?>
    </div>
    <div id="footer">
      <p><?php echo $lstatus; ?></p>
      <p>
        <?php echo $copyright; ?> Design:<a href="http://demo.jimbarraud.com/manifest/">Jimbarraud.com</a> Powered by:<a href="http://www.myworld.lv/einplaccms.html">Einplac CMS <?php echo $version; ?></a>
      </p>
    </div>
  </body>
</html>
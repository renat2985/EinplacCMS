<?php 
// Einplac CMS Template 
// Last update: 07/06/2011 
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
      <link rel="stylesheet" type="text/css" href="./css/wuwei.css" />
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
      <div id="content">
        <div id="head">
          <?php echo $navigation; ?>
        </div>
        <hr />
        <?php if(COOKIE($cookie)==$password) echo displaySettings().'<script type="text/javascript">$("#cmssettings").hide(0);$("#head").append(\'<ul><li><a href="#" id="settingopenhide">'.$lang['web_settings'].'</a></li></ul>\');$("#settingopenhide").click(function(){$(\'#cmssettings\').toggle(500);return false;});</script>'; ?>
          <h1>
            <a href="./"><?php echo $title; ?></a>
            <span>
              <?php echo $slogan; ?>
            </span>
          </h1>
          <div class="post hr">
            <?php echo displayMainContent(); ?>
          </div>
          <div id="footer" class="hr">
            <div class="col">
              <?php echo displaySectionContent( '4'); /* Duplicated on each pages: MIN:1, MAX:5.
              Individually on each page: MIN:6, MAX:9 */ ?>
            </div>
            <div class="col last">
              <?php echo displaySectionContent( '5'); /* Duplicated on each pages: MIN:1, MAX:5.
              */ ?>
            </div>
            <div class="hr" style="clear:both;">
              <p style="float:left">
                <?php echo $copyright; ?>
                  Design: <a href="http://equivocality.com/wu-wei">Jeff Ngan</a>, <a href="http://www.myworld.lv/">Renats</a>.
                  Powered by: <a href="http://www.myworld.lv/einplaccms.html">Einplac CMS <?php echo $version; ?></a>
              </p>
              <p style="float:right">
                <?php echo $lstatus; ?>
              </p>
            </div>
          </div>
      </div>
    </body>
  
  </html>
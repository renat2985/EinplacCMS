<?php
// Einplac CMS Template
// Last update: 22/05/2011
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
    <link rel="stylesheet" type="text/css" href="./css/minimalistic.css" />
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
      <h1>
        <a href="./"><?php echo $title; ?></a>
        <span><?php echo $slogan; ?></span>
      </h1>
      <?php echo $navigation; ?>
        <div class="post">
          <div class="details">
            <?php echo displaySectionContent('3'); /* Duplicated on each pages: MIN:1, MAX:5. Individually on each page: MIN:6, MAX:9 */ ?>
            <?php echo displaySettings(); ?>
          </div>
          <div class="body">
            <?php echo displayMainContent(); ?>
          </div>
          <div class="x"></div>
        </div>
        <div class="col"><?php echo displaySectionContent('6'); /* Duplicated on each pages: MIN:1, MAX:5. Individually on each page: MIN:6, MAX:9 */ ?></div>
        <div class="col"><?php echo displaySectionContent('4'); /* Duplicated on each pages: MIN:1, MAX:5. Individually on each page: MIN:6, MAX:9 */ ?></div>
        <div class="col last"><?php echo displaySectionContent('5'); /* Duplicated on each pages: MIN:1, MAX:5. Individually on each page: MIN:6, MAX:9 */ ?></div>
        <div id="footer">
          <p style="float:left">
            <?php echo $copyright; ?> Design:<a href="http://www.solucija.com/">Solucija.com</a> Powered by:<a href="http://www.myworld.lv/einplaccms.html">Einplac CMS <?php echo $version; ?></a>
          </p>
          <p style="float:right"><?php echo $lstatus; ?></p>
        </div>
    </div>
  </body>
</html>
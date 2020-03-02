<?php
require 'index.php';
?>
<!-- Testing User Interface -->
<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <body>
    <div class="wrapper">
  <form id="form" class="login" action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="req">
    <p class="title">Auto Site Generator</p>
    <?php
        if (count($replacer) == count($placeholder)) {
            $i = 0;
            foreach ($replacer as $value){
                if (strpos($value, 'img') !== false) {
                    echo ("</b><label style='font-size:12px' type='text' for='".$value."'>".$placeholder[$i]."</label>");
                    echo ("<input type='file' placeholder='".$placeholder[$i]."' name='".$value."'>");
                    echo ("<hr>");
                    $i = $i+1;
                }
                
                elseif (strpos($value, 'pgf') !== false) {
                    echo ("<textarea placeholder='".$placeholder[$i]."' name='".$value."'></textarea>");
                    $i = $i+1;
                }
                

                else {
                    echo ("<input type='text' id='".$value."' placeholder='".$placeholder[$i]."' name='".$value."'>");
                    $i = $i+1;
                }
            } 
        }
        else {
            echo ("Error");
        }
    ?>
    <input type="submit" id="submit">
  </form>
  <footer>NetApps | ideas came to life</footer>
</div>
    </body>
</html>

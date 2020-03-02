<?php
require 'generate.php';
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
                elseif (strpos($value, 'loop') !== false) {
                    echo "<hr>";
                    $tempi = 0;
                    foreach ($tempConfig[$value] as $subvalue){
                        if (strpos($subvalue, 'img') !== false) {
                            $tempph = $tempConfig[$value.'ph'][$tempi];
                            echo ("</b><label style='font-size:12px' type='text' for='".$tempph."'>".$tempph."</label>");
                            echo ("<input type='file' placeholder='".$tempph."' name='".$value."[$subvalue]'>");
                            $tempi = $tempi+1;
                        }
                        
                        elseif (strpos($subvalue, 'pgf') !== false) {
                            $tempph = $tempConfig[$value.'ph'][$tempi];
                            echo $tempph;
                            echo ("<textarea placeholder='".$tempph."' name='".$value."[$subvalue]'></textarea>");
                            $tempi = $tempi+1;
                        }        
                        else {
                            $tempph = $tempConfig[$value.'ph'][$tempi];
                            echo ("<input type='text' id='".$value."[$subvalue]' placeholder='".$tempph."' name='".$value."[$subvalue]'>");
                            $tempi = $tempi+1;
                        }
                    } 

                    $i = $i+1;
                    echo "<hr>";
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

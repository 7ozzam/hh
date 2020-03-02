<?php
require 'index.php';
?>
<!-- Testing User Interface -->
<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <script>
    $("#submit").click(function() {
        $.ajax({
            type: "POST",
            url: 'index.php',
            data: $("form").serialize(),
            ...rest
        });
    });
    </script>
    <body>
        <form method="POST" enctype="multipart/form-data">
        <input type='hidden' name='req'>
            <div class="half left cf">
                <?php
                if (count($replacer) == count($placeholder)) {
                    $i = 0;
                    foreach ($replacer as $value){
                        if (strpos($value, 'img') !== false) {
                            echo ("<input type='file' placeholder='".$placeholder[$i]."' name='".$value."'>");
                            $i = $i+1;
                        }
                        elseif (strpos($value, 'pgf') !== false) {
                            echo ("<textarea placeholder='".$placeholder[$i]."' name='".$value."'></textarea>");
                            $i = $i+1;
                        }
                        else {
                            echo ("<input type='text' placeholder='".$placeholder[$i]."' name='".$value."'>");
                            $i = $i+1;
                        }
                    } 
                }
                else {
                    echo ("Error");
                }
                ?>
            </div>
            <div class="half right cf">
            </div>  
            <input type="submit" value="Submit" id="submit">
        </form>
    </body>
</html>

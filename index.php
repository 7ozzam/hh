
<?php
// header("Content-Type: application/json; charset=UTF-8");

// Reports all errors
error_reporting(E_ALL);
// Do not display errors for the end-users (security issue)
ini_set('display_errors','Off');
// Set a logging file
ini_set('error_log','request.log');

$req_dump = print_r($_REQUEST, TRUE);
$req_dumpo = print_r($_FILES, TRUE);
$fp = fopen('request-param.log', 'a');
fwrite($fp, $req_dump);
fwrite($fp, $req_dumpo);
fclose($fp);

$tempId = 2;

// Get Config Variables
$configs = include('inc/config.php');
$tempConfig = parse_ini_file($configs['templatePath'].$tempId.'.ini');

// Template Configuration
$templatePath = $configs['templatePath'].$tempId;
$generatePath = $configs['generatePath'].$tempId."/";
$imagesPath = $_SERVER['DOCUMENT_ROOT']. $configs['baseUrl'] . $generatePath . $tempConfig['imagesPath'];

$placeholder = $tempConfig['placeHolder'];
$replacer = $tempConfig['replacer'];

// Template Clone/Copy
$indexPath = cloneTemplate($templatePath , $generatePath);

// Execution Logic
if (isset($_REQUEST['req'])) {
  foreach ($replacer as $value) {
      if (strpos($value, 'img') !== false){
        $imgPath = upload($value , $imagesPath, $tempConfig['imagesPath']);
        dataReplace($indexPath, $value, $imgPath);
      }
      
      else {
        if (isset($_REQUEST[$value])) {
            dataReplace($indexPath, $value, $_REQUEST[$value]);
        }
   }
}

if (isset($_REQUEST[$replacer[0]]))  {
    //    echo '<a href="'.$generatePath.'/index.html" target="_blank">Click Me!</a>';
        // $output = $configs['base']. $configs['baseUrl'].$indexPath;
        // $myJSONString = json_encode($output);
        // echo $myJSONString;
        echo "<div class='popup-overlay'>";
        echo '</div>';
        echo "<div class='popup'>";
        echo '<h3><a href="'.$generatePath.'/index.html" target="_blank">Click Me!</a></h3>';
        echo '</div>';
        
     }
    }

     
 
 
// ! Functions
 
// Upload Image Function // TODO: Get Image from URL
function upload($file , $dirTarget , $webPath)  {

    if (is_dir($dirTarget) && is_writable($dirTarget)) {
        $info = pathinfo($_FILES[$file]['name']);
        $ext = $info['extension']; // get the extension of the file
        $newname = $file.'.'.$ext; 
        
        $target = $dirTarget.$newname;
        move_uploaded_file( $_FILES[$file]['tmp_name'], $target);
        echo "<script>alert('". $_FILES[$file]['tmp_name']."')</script>";
        return $webPath.$newname;
    } else {
        // echo 'Upload directory is not writable, or does not exist.';
    }
    
}

// Clone Template Function
function cloneTemplate($src,$dst) { 
     $dir = opendir($src); 
     @mkdir($dst); 
     while(false !== ( $file = readdir($dir)) ) { 
         if (( $file != '.' ) && ( $file != '..' )) { 
             if ( is_dir($src . '/' . $file) ) { 
                cloneTemplate($src . '/' . $file,$dst . '/' . $file); 
             } 
             else { 
                 copy($src . '/' . $file,$dst . '/' . $file); 
             } 
         } 
     } 
     closedir($dir);
     return $dst."/index.html";
} 
 
// Replace Template Content
function dataReplace($FilePath, $OldText, $NewText)    {
     $Result = array('status' => 'error', 'message' => '');
     if(file_exists($FilePath)===TRUE)
     {
         if(is_writeable($FilePath))
         {
             try
             {
                 $FileContent = file_get_contents($FilePath);
                 $FileContent = str_replace($OldText, $NewText, $FileContent);
                 if(file_put_contents($FilePath, $FileContent) > 0)
                 {
                     $Result["status"] = 'success';
                 }
                 else
                 {
                    $Result["message"] = 'Error while writing file';
                 }
             }
             catch(Exception $e)
             {
                 $Result["message"] = 'Error : '.$e;
                 echo $Result;
             }
         }
         else
         {
             $Result["message"] = 'File '.$FilePath.' is not writable !';
         }
     }
     else
     {
         $Result["message"] = 'File '.$FilePath.' does not exist !';
     }
     return $Result;
 }

 ?>



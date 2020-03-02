
<?php
// header("Content-Type: application/json; charset=UTF-8");

// // Reports all errors
// error_reporting(E_ALL);
// // Do not display errors for the end-users (security issue)
// ini_set('display_errors','Off');
// // Set a logging file
// ini_set('error_log','request.log');

// $req_dump = print_r($_REQUEST, TRUE);
// $req_dumpo = print_r(file_get_contents('php://input'),true);
// $fp = fopen('request-param.log', 'a');
// fwrite($fp, $req_dump);
// fwrite($fp, $req_dumpo);
// fclose($fp);


// Get Config Variables
$configs = include('inc/config.php');


// Recieve Json Request
$json = file_get_contents('php://input');
// Converts it into a PHP object
$data = json_decode($json);

// Template Configuration
$tempConfig = parse_ini_file($configs['templatePath'].$data->templateId.'.ini');
$templatePath = $configs['templatePath'].$data->templateId;
$generatePath = $configs['generatePath'].$data->templateId."/";
$imagesPath = $_SERVER['DOCUMENT_ROOT']. $configs['baseUrl'] . $generatePath . $tempConfig['imagesPath'];

// Data Validation
if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    exit;
}
else {
// Variable Declaration and Checking    
    // if ($data->templateId == 3){
    //     $siteData['nalogo'] = $data->mandatory->siteName;
    //     $siteData['namaintitle'] = $data->mandatory->hero_header_title;
    //     $siteData['nasubtitlepgf'] = $data->mandatory->hero_header_subtitle;
    //     $siteData['naheroimg'] = $data->mandatory->heroPhoto->imgURLimport;
    //     $siteData['nasection2title'] = $data->mandatory->name;
    //     $siteData['nasection2pgf'] = $data->mandatory->aboutYou;
    //     $siteData['nasection2img'] = $data->mandatory->aboutYouPhoto->imgURLimport;
    //     $siteData['nafavicon'] = $data->mandatory->favicon->imgURLimport;
    // }
}

if (true) {
// Template Clone/Copy
$indexPath = cloneTemplate($templatePath , $generatePath);

// Sections Modification
foreach ($data->structure as $key => $value) {
    if (!$value) {
        sectionReplace($indexPath,$key);
    }    
}


// Execution Logic
if (false) {
  foreach ($siteData as $key => $val) {
    if (true) {
        dataReplace($indexPath, '['.$key.']', $val);
    }
      
    else {
        
    }
    }
}

echo '<h3><a href="'.$generatePath.'/index.html" target="_blank">Click Me!</a></h3>';
}
     
 
 
// ! Functions
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
 
// Add/Remove Template Sections
function sectionReplace($FilePath,$key) {
    $FileContent = file_get_contents($FilePath);
    
    $regex = "/^" . preg_quote( '<!-- '.$key.' -->', '/') .".*?". preg_quote( '<!-- /'.$key.' -->', '/') . "/sm";
    $FileContent = preg_replace ( $regex, " ", $FileContent);

    file_put_contents($FilePath, $FileContent);
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



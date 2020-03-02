<?php
$aroca = file_get_contents('web.json');
$aroca = json_decode($aroca,true);


// print(searcharray($aroca,"imgURLimport"));
print(searchforvalue($aroca));


function searchforvalue ($data) {
    if (is_array($data)) {
        foreach ($data as $key => $product) {
        print_r($key);
        echo("=>");
        print_r($product);
        echo("<br><br>");
         searchforvalue($data[$key]);
        }
    } 
    
    else {
    }
}

function searcharray($products, $field) {
   foreach($products as $key => $product)
   {
      if (isset($product[$field]))
         return $key;
   }
   return false;
}

function rekey( $input , $prefix ) { 
    $out = array(); 
    foreach( $input as $i => $v ) { 
        if ( is_numeric( $i ) ) { 
            $out[$prefix . $i] = $v; 
            continue; 
        }
        $out[$i] = $v;
    }
    return $out;
}

?>
<?php

$FilePath = "test.html";

$FileContent = file_get_contents($FilePath);

$start = "<!-- Section 1 Start -->";
$end = "<!-- Section 1 End -->";

$regex = "/^" . preg_quote( $start, '/') .".*?". preg_quote( $end, '/') . "/sm";
$FileContent = preg_replace ( $regex, " ", $FileContent);

file_put_contents($FilePath, $FileContent)


?>
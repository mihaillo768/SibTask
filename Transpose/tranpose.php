<?php

function debug(){
    $file = file_get_contents('text.txt');
    $lines = explode("\n", $file);
    print_r( $lines);
    echo "<br />";
    for($i = 0; $i < count($lines); $i++){
        $lines[$i] = explode(",", $lines[$i]);
    }
    print_r( $lines);
    echo "<br />";
    $lines = array_map(null, ...$lines);
    print_r( $lines);
}

debug();
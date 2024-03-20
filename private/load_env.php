<?php 
    $env_file_path = realpath(__DIR__."/../.env");
    if(is_file($env_file_path)) {
        $var_arrs = array();
        $fopen = fopen($env_file_path, 'r');
        if($fopen){
            while (($line = fgets($fopen)) !== false){
                $line_is_comment = (substr(trim($line),0 , 1) == '#') ? true: false;
                if($line_is_comment || empty(trim($line)))
                    continue;
                $line_no_comment = explode("#", $line, 2)[0];
                $env_ex = preg_split('/(\s?)\=(\s?)/', $line_no_comment);
                $env_name = trim($env_ex[0]);
                $env_value = isset($env_ex[1]) ? trim($env_ex[1]) : "";
                $var_arrs[$env_name] = $env_value;
            }
            fclose($fopen);
        }
        foreach($var_arrs as $name => $value){
            putenv("{$name}={$value}");
        }
    }
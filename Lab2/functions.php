<?php
require_once "vendor/autoload.php";

function store_submits_to_file($name, $email)
{
    $fp = fopen(SUBMIT_FILE, "a+");
    if ($fp) {
        $data = date("F j Y g:i a") . "," . $_SERVER["REMOTE_ADDR"] . "," . $name . "," . $email . PHP_EOL;
        if (fwrite($fp, $data)) {
            fclose($fp);
            return true;
        } else {
            fclose($fp);
            return false;
        }
    } else {
        return false;
    }
}

function display_all_submits()
{
    $lines = file(SUBMIT_FILE);
    foreach ($lines as $line) {
        echo "<h3>New User Data</h3>";
        $words = explode(",", $line);
        $i = 1;
        foreach ($words as $word) {
            switch ($i) {
                case 1:
                    echo "<h5>Date: $word</h5>";
                    break;
                case 2:
                    echo "<h5>IP: $word</h5>";
                    break;
                case 3:
                    echo "<h5>Name: $word</h5>";
                    break;
                default:
                    echo "<h5>Email: $word</h5>";
                    break;
            }
            $i++;
        }
    }
}

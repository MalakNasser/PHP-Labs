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
        echo "<h5>Date: $words[0]</h5>";
        echo "<h5>IP: $words[1]</h5>";
        echo "<h5>Name: $words[2]</h5>";
        echo "<h5>Email: $words[3]</h5>";
    }
}

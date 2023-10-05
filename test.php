<?php
$hostname = $_SERVER['HTTP_HOST'];
if (filter_var($hostname, FILTER_VALIDATE_IP)) {
    echo $hostname . '/equipment';
} else {
    echo $hostname;
}
?>
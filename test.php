<?php
include 'vendor/autoload.php';

// dev modify

$aha = new \CherryLu\CompanyWeChat\CompanyWeChat();
echo json_encode($aha->department->departmentList());

<?php
include 'vendor/autoload.php';

// stable modify

$aha = new \CherryLu\CompanyWeChat\CompanyWeChat();
echo json_encode($aha->department->departmentList());

<?php
include 'vendor/autoload.php';

// stable modify 2

$aha = new \CherryLu\CompanyWeChat\CompanyWeChat();
echo json_encode($aha->department->departmentList());

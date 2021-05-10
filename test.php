<?php
include 'vendor/autoload.php';

$aha = new \CherryLu\CompanyWeChat\CompanyWeChat();
echo json_encode($aha->department->departmentList());

<?php
include 'vendor/autoload.php';

// cfy edited

$aha = new \CherryLu\CompanyWeChat\CompanyWeChat();

// cfy edited

echo json_encode($aha->department->departmentList());

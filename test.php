<?php
include 'vendor/autoload.php';

// tlh ....

// tlh ....
$aha = new \CherryLu\CompanyWeChat\CompanyWeChat();

// tlh ....

echo json_encode($aha->department->departmentList());

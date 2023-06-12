<?php
include 'vendor/autoload.php';

// cfy ....

// cfy ....
$aha = new \CherryLu\CompanyWeChat\CompanyWeChat();

// cfy ....

echo json_encode($aha->department->departmentList());

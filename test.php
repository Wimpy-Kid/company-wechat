<?php
include 'vendor/autoload.php';

// tlh .... ggggg  1 123

// tlh .... ggg  1  123  12312312
$aha = new \CherryLu\CompanyWeChat\CompanyWeChat();

// tlh ....  ggg1   123

echo json_encode($aha->department->departmentList());

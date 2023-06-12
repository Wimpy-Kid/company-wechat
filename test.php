<?php
include 'vendor/autoload.php';

// tlh .... ggggg  1 123 灌灌灌灌灌 234234234 12123123 12312312

// tlh .... ggg  1  123   123123123  1231231231312 1212312
$aha = new \CherryLu\CompanyWeChat\CompanyWeChat();

// tlh ....  ggg1   123 999999 234234234 123333 12321312

echo json_encode($aha->department->departmentList());

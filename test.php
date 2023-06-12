<?php
include 'vendor/autoload.php';

// cfy .... cccch hhh  123123

// cfy .... cccc  hhh  12312
$aha = new \CherryLu\CompanyWeChat\CompanyWeChat();

// cfy .... cccc hhh  1233312

echo json_encode($aha->department->departmentList());

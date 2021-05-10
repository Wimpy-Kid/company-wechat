<?php

namespace CherryLu\CompanyWeChat\OA;


use CherryLu\CompanyWeChat\Client;

class Attendance extends Client {

    public function getCheckInData ($fromDate, $toDate, $userList) {
        return $this->get('/cgi-bin/checkin/getcheckindata', [
            'starttime' => strtotime($fromDate),
            'endtime' => strtotime($toDate),
            'userlist' => $userList,
            'opencheckindatatype' => 3, // 查询全部类型打卡
        ]);
    }

}
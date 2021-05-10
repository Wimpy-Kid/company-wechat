<?php

namespace CherryLu\CompanyWeChat;

use CherryLu\CompanyWeChat\OA\Attendance;
use CherryLu\CompanyWeChat\Organization\Department;

/**
 * @property Attendance $attendance
 * @property Department $department
 *
 * Class CompanyWeChat
 * @package CherryLu\CompanyWeChat
 */
class CompanyWeChat {

    protected $client;

    protected $services = [
        'attendance' => Attendance::class,
        'department' => Department::class,
    ];

    public function __get($name) {
        return (new $this->services[$name]);
    }

}
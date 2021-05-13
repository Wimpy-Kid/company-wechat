<?php

namespace CherryLu\CompanyWeChat;

use CherryLu\CompanyWeChat\OA\Attendance;
use CherryLu\CompanyWeChat\Organization\Department;
use CherryLu\CompanyWeChat\Organization\User;

/**
 * @property Attendance $attendance
 * @property Department $department
 * @property User $user
 *
 * Class CompanyWeChat
 * @package CherryLu\CompanyWeChat
 */
class CompanyWeChat {

    protected $services = [
        'attendance' => Attendance::class,
        'department' => Department::class,
        'user' => User::class,
    ];

    public function __get($name) {
        return (new $this->services[$name]);
    }

}
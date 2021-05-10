<?php
/**
 * Created by PhpStorm.
 * User: cfy
 * Date: 2021/5/10
 * Time: 10:31
 */

namespace CherryLu\CompanyWeChat\Organization;


use CherryLu\CompanyWeChat\Client;

class Department extends Client {

    public function departmentList($parentId = null) {
        return $this->get('/cgi-bin/department/list', ['id' => $parentId]);
    }

}
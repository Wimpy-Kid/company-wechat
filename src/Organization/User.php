<?php

namespace CherryLu\CompanyWeChat\Organization;


use CherryLu\CompanyWeChat\Client;

class User extends Client {

    /**
     * @param int $department
     * @param bool $recursive
     *
     * @return mixed
     */
    public function users(int $department, $recursive = true) {
        return $this->get('cgi-bin/user/simplelist', [
            'department_id' => $department,
            'fetch_child' => (int) $recursive,
        ]);
    }

}
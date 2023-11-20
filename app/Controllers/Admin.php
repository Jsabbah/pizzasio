<?php

namespace App\Controllers;

class Admin extends BaseController {
    protected $menu = "users";

    public function getIndex()
    {
        return $this->view('admin/test');
    }

    public function getTest() {
        return $this->view('admin/test');
    }

}
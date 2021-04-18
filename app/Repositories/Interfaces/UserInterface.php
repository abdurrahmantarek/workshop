<?php

namespace App\Repositories\Interfaces;


interface UserInterface {

    public function store($data);

    public function totalUsers();

}

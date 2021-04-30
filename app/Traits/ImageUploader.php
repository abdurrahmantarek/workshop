<?php

namespace App\Traits;

trait ImageUploader {

    public function save($image)
    {
        return $image->store('images');
    }

}

<?php

namespace App\Traits;

use Ramsey\Uuid\Uuid;

trait ModelAutoIdentTrait
{
    public static function bootModelAutoIdentTrait()
    {
        self::creating(function ($model) {
            if (!isset($model->id) || empty($model->id)) {
                $model->id = Uuid::uuid4();
            }
        });
    }
}

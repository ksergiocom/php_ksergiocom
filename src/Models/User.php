<?php

namespace App\Models;

use App\Core\BaseModel;

class User extends BaseModel {
    protected static $collectionName = 'users';

    // Sobre escribe el método del modelo base
    public static function insertOne(array $data) {
        $collection = static::getCollection();

        $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);

        $result = $collection->insertOne($data);
        return static::findById($result->getInsertedId());
    }
}
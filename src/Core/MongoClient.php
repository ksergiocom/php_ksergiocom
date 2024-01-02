<?php

namespace App\Core;

use MongoDB\Client;

class MongoClient {
    private static $client;
    private static $dbName = "php_ksergiocom"; // Cambiar por variables de entorno más adelante.

    public static function initialize() {
        self::$client = new Client("mongodb://localhost:27017"); // Cambiar por variables de entorno más adelante.
    }

    public static function getCollection(string $collectionName) {
        return self::$client->selectDatabase(self::$dbName)->selectCollection($collectionName);
    }
}

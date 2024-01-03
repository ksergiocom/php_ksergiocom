<?php

namespace App\Core;

use MongoDB\BSON\ObjectId;



class BaseModel {
    protected static $collectionName;

    // Valida si el ID es un ObjectId válido o lanza una excepción
    protected static function validateObjectId($id) {
        if (!($id instanceof ObjectId) &&  !preg_match('/^[a-fA-F0-9]{24}$/', $id)) {
            throw new \Exception("El ID proporcionado no es un ObjectId válido en MongoDB.");
        }

        return new ObjectId($id);
    }

    // Método para obtener la colección
    protected static function getCollection() {
        return MongoClient::getCollection(static::$collectionName);
    }

    // CRUD Operations

    // Encuentra un documento por su ID y lo devuelve como un objeto
    public static function findById($id) {
        $id = static::validateObjectId($id);
        $collection = static::getCollection();
        $document = $collection->findOne(['_id' => new ObjectId($id)]);
        return $document;
    }

    // Encuentra documentos basados en un criterio y los devuelve como objetos
    public static function findMany(array $criteria = []) {
        $collection = static::getCollection();
        $documents = $collection->find($criteria);
        $results = [];
        foreach ($documents as $document) {
            $results[] = $document;
        }
        return $results;
    }

    // Inserta un nuevo documento y devuelve el objeto insertado
    public static function insertOne(array $data) {
        $collection = static::getCollection();
        $result = $collection->insertOne($data);
        return static::findById($result->getInsertedId());
    }

    // Actualiza un documento por su ID
    public static function updateById($id, array $data) {
        $id = static::validateObjectId($id);
        $collection = static::getCollection();
        $collection->updateOne(['_id' => new ObjectId($id)], ['$set' => $data]);
        return static::findById($id);
    }

    // Elimina un documento por su ID
    public static function deleteById($id) {
        $id = static::validateObjectId($id);
        $collection = static::getCollection();
        return $collection->deleteOne(['_id' => new ObjectId($id)]);
    }
}

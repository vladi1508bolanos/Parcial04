<?php

// Archivo: models/Genre.php

class Genre
{
    private $pdo;

    // Constructor que recibe la conexión PDO
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Método para obtener todos los géneros
    public function getAllGenres()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM genre");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para obtener un género por su ID
    public function getGenreById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM genre WHERE ID_GENRE = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para agregar un género
    public function addGenre($name)
    {
        $stmt = $this->pdo->prepare("INSERT INTO genre (NAME) VALUES (:name)");
        $stmt->bindParam(':name', $name);
        return $stmt->execute();
    }

    // Método para actualizar un género
    public function updateGenre($id, $name)
    {
        $stmt = $this->pdo->prepare("UPDATE genre SET NAME = :name WHERE ID_GENRE = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name);
        return $stmt->execute();
    }

    // Método para eliminar un género
    public function deleteGenre($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM genre WHERE ID_GENRE = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
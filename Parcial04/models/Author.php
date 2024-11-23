<?php

// Archivo: models/Author.php

class Author
{
    private $pdo;

    // Constructor que recibe la conexión PDO
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Método para obtener todos los autores
    public function getAllAuthors()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM author");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para obtener un autor por su ID
    public function getAuthorById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM author WHERE ID_AUTHOR = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para agregar un autor
    public function addAuthor($fullName, $dateOfBirth, $dateOfDeath = null)
    {
        $stmt = $this->pdo->prepare("INSERT INTO author (FULL_NAME, DATE_OF_BIRTH, DATE_OF_DEATH) VALUES (:fullName, :dateOfBirth, :dateOfDeath)");
        $stmt->bindParam(':fullName', $fullName);
        $stmt->bindParam(':dateOfBirth', $dateOfBirth);
        $stmt->bindParam(':dateOfDeath', $dateOfDeath);
        return $stmt->execute();
    }

    // Método para actualizar un autor
    public function updateAuthor($id, $fullName, $dateOfBirth, $dateOfDeath)
    {
        $stmt = $this->pdo->prepare("UPDATE author SET FULL_NAME = :fullName, DATE_OF_BIRTH = :dateOfBirth, DATE_OF_DEATH = :dateOfDeath WHERE ID_AUTHOR = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':fullName', $fullName);
        $stmt->bindParam(':dateOfBirth', $dateOfBirth);
        $stmt->bindParam(':dateOfDeath', $dateOfDeath);
        return $stmt->execute();
    }

    // Método para eliminar un autor
    public function deleteAuthor($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM author WHERE ID_AUTHOR = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
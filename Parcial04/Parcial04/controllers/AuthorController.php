<?php

// Archivo: controllers/AuthorController.php
require_once __DIR__ . '/../models/Author.php';

class AuthorController
{
    private $authorModel;

    // Constructor que recibe el modelo de Author
    public function __construct($pdo)
    {
        $this->authorModel = new Author($pdo);
    }

    // Método para mostrar todos los autores
    public function index()
    {
        $authors = $this->authorModel->getAllAuthors();
        require_once __DIR__ . '/../views/authors/index.php'; // Pasa los autores a la vista
    }

    // Método para mostrar un autor específico
    public function show($id)
    {
        $author = $this->authorModel->getAuthorById($id);
        require_once __DIR__ . '/../views/authors/show.php'; // Pasa el autor a la vista
    }

    // Método para agregar un nuevo autor
    public function store($fullName, $dateOfBirth, $dateOfDeath = null)
    {
        // Validación básica de los datos
        if (empty($fullName) || empty($dateOfBirth)) {
            echo "El nombre completo y la fecha de nacimiento son requeridos.";
            return;
        }

        // Llamada al modelo para agregar el autor
        $this->authorModel->addAuthor($fullName, $dateOfBirth, $dateOfDeath);
        header('Location: /authors'); // Redirigir a la lista de autores
        exit;
    }

    // Método para actualizar un autor
    public function update($id, $fullName, $dateOfBirth, $dateOfDeath)
    {
        // Validación básica de los datos
        if (empty($fullName) || empty($dateOfBirth)) {
            echo "El nombre completo y la fecha de nacimiento son requeridos.";
            return;
        }

        // Llamada al modelo para actualizar el autor
        $this->authorModel->updateAuthor($id, $fullName, $dateOfBirth, $dateOfDeath);
        header('Location: /authors'); // Redirigir a la lista de autores
        exit;
    }

    // Método para eliminar un autor
    public function destroy($id)
    {
        // Llamada al modelo para eliminar el autor
        $this->authorModel->deleteAuthor($id);
        header('Location: /authors'); // Redirigir a la lista de autores
        exit;
    }
}
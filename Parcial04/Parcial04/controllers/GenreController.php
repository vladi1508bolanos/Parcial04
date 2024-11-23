<?php

// Archivo: controllers/GenreController.php
require_once __DIR__ . '/../models/Genre.php';

class GenreController
{
    private $genreModel;

    // Constructor que recibe el modelo de Genre
    public function __construct($pdo)
    {
        $this->genreModel = new Genre($pdo);
    }

    // Método para mostrar todos los géneros
    public function index()
    {
        $genres = $this->genreModel->getAllGenres();
        require_once __DIR__ . '/../views/genres/index.php'; // Pasa los géneros a la vista
    }

    // Método para mostrar un género específico
    public function show($id)
    {
        $genre = $this->genreModel->getGenreById($id);
        require_once __DIR__ . '/../views/genres/show.php'; // Pasa el género a la vista
    }

    // Método para mostrar el formulario de agregar género
    public function create()
    {
        require_once __DIR__ . '/../views/genres/create.php'; // Vista para crear un nuevo género
    }

    // Método para agregar un nuevo género
    public function store($name)
    {
        $this->genreModel->addGenre($name);
        header('Location: /genres'); // Redirige a la lista de géneros
    }

    // Método para mostrar el formulario de edición de un género
    public function edit($id)
    {
        $genre = $this->genreModel->getGenreById($id);
        require_once __DIR__ . '/../views/genres/edit.php'; // Vista para editar un género
    }

    // Método para actualizar un género
    public function update($id, $name)
    {
        $this->genreModel->updateGenre($id, $name);
        header('Location: /genres'); // Redirige a la lista de géneros
    }

    // Método para eliminar un género
    public function destroy($id)
    {
        $this->genreModel->deleteGenre($id);
        header('Location: /genres'); // Redirige a la lista de géneros
    }
}
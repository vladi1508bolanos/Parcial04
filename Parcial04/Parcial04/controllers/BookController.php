<?php
// controllers/BookController.php

require_once __DIR__ . '/../models/Book.php';
require_once __DIR__ . '/../models/Author.php';
require_once __DIR__ . '/../models/Genre.php';
require_once __DIR__ . '/../models/Stock.php';

class BookController
{
    private $bookModel;
    private $authorModel;
    private $genreModel;
    private $stockModel;

    public function __construct($pdo)
    {
        $this->bookModel = new Book($pdo);
        $this->authorModel = new Author($pdo);
        $this->genreModel = new Genre($pdo);
        $this->stockModel = new Stock($pdo);
    }

    public function index()
    {
        $books = $this->bookModel->getBooks();
        require_once __DIR__ . '/../views/booksView.php';
    }

    public function show($id)
    {
        $book = $this->bookModel->getBook($id);
        require_once __DIR__ . '/../views/books/show.php';
    }

    public function create()
    {
        $authors = $this->authorModel->getAllAuthors();
        $genres = $this->genreModel->getAllGenres();
        require_once __DIR__ . '/../views/books/create.php';
    }

    public function store($title, $description, $yearPublication, $idAuthor, $idGenre)
    {
        if (empty($title) || empty($yearPublication) || empty($idAuthor) || empty($idGenre)) {
            echo "Todos los campos son obligatorios.";
            return;
        }
        $this->bookModel->addBook($title, $description, $yearPublication, $idAuthor, $idGenre);
        header('Location: /books');
        exit;
    }

    public function edit($id)
    {
        $book = $this->bookModel->getBook($id);
        $authors = $this->authorModel->getAllAuthors();
        $genres = $this->genreModel->getAllGenres();
        require_once __DIR__ . '/../views/books/edit.php';
    }

    public function update($id, $title, $description, $yearPublication, $idAuthor, $idGenre)
    {
        if (empty($title) || empty($yearPublication) || empty($idAuthor) || empty($idGenre)) {
            echo "Todos los campos son obligatorios.";
            return;
        }
        $this->bookModel->updateBook($id, $title, $description, $yearPublication, $idAuthor, $idGenre);
        header('Location: /books');
        exit;
    }

    public function destroy($id)
    {
        $this->bookModel->deleteBook($id);
        header('Location: /books');
        exit;
    }

    public function mostrarTodo()
    {
        $books = $this->bookModel->getBooks();
        $authors = $this->authorModel->getAllAuthors();
        $genres = $this->genreModel->getAllGenres();
        $stocks = $this->stockModel->getAllStock();

        $authorsById = [];
        foreach ($authors as $author) {
            $authorsById[$author['ID_AUTHOR']] = $author;
        }

        $genresById = [];
        foreach ($genres as $genre) {
            $genresById[$genre['ID_GENRE']] = $genre;
        }

        $stocksById = [];
        foreach ($stocks as $stock) {
            $stocksById[$stock['ID_BOOK']] = $stock;
        }

        require_once __DIR__ . '/../views/booksView.php';
    }
}
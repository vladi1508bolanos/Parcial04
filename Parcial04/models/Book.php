<?php

class Book 
{
    private $pdo;
    
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function getBooks()
    {
        $stmt = $this->pdo->query('SELECT * FROM book');
        return $stmt->fetchAll();
    }
    
    public function getBook($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM book WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    
    public function addBook($title, $author, $description)
    {
        $stmt = $this->pdo->prepare('INSERT INTO book (title, author, description) VALUES (:title, :author, :description)');
        $stmt->execute(['title' => $title, 'author' => $author, 'description' => $description]);
    }
    
    public function updateBook($id, $title, $author, $description)
    {
        $stmt = $this->pdo->prepare('UPDATE book SET title = :title, author = :author, description = :description WHERE id = :id');
        $stmt->execute(['id' => $id, 'title' => $title, 'author' => $author, 'description' => $description]);
    }
    
    public function deleteBook($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM book WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    public function getBooksWithDetails()
{
    $stmt = $this->pdo->query('
        SELECT 
            b.ID_BOOK, 
            b.TITLE, 
            b.DESCRIPTION, 
            b.YEAR_PUBLICATION, 
            a.NAME AS AUTHOR_NAME, 
            g.NAME AS GENRE_NAME
        FROM 
            book b
        LEFT JOIN 
            author a ON b.ID_AUTHOR = a.ID_AUTHOR
        LEFT JOIN 
            genre g ON b.ID_GENRE = g.ID_GENRE
    ');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
<?php

// Archivo: models/Stock.php

class Stock
{
    private $pdo;

    // Constructor que recibe la conexión PDO
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Método para obtener todos los registros de stock
    public function getAllStock()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM stock");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para obtener el stock de un libro específico
    public function getStockByBookId($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM stock WHERE ID_BOOK = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para agregar un nuevo registro de stock
    public function addStock($bookId, $totalStock, $notes, $lastInventory)
    {
        $stmt = $this->pdo->prepare("INSERT INTO stock (ID_BOOK, TOTAL_STOCK, NOTES, LAST_INVENTORY) 
                                     VALUES (:bookId, :totalStock, :notes, :lastInventory)");
        $stmt->bindParam(':bookId', $bookId, PDO::PARAM_INT);
        $stmt->bindParam(':totalStock', $totalStock, PDO::PARAM_INT);
        $stmt->bindParam(':notes', $notes);
        $stmt->bindParam(':lastInventory', $lastInventory);
        return $stmt->execute();
    }

    // Método para actualizar un registro de stock
    public function updateStock($id, $totalStock, $notes, $lastInventory)
    {
        $stmt = $this->pdo->prepare("UPDATE stock SET TOTAL_STOCK = :totalStock, NOTES = :notes, LAST_INVENTORY = :lastInventory 
                                     WHERE ID_STOCK = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':totalStock', $totalStock, PDO::PARAM_INT);
        $stmt->bindParam(':notes', $notes);
        $stmt->bindParam(':lastInventory', $lastInventory);
        return $stmt->execute();
    }

    // Método para eliminar un registro de stock
    public function deleteStock($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM stock WHERE ID_STOCK = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
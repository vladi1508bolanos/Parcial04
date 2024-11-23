<?php

// Archivo: controllers/StockController.php
require_once __DIR__ . '/../models/Stock.php';

class StockController
{
    private $stockModel;

    // Constructor que recibe el modelo de Stock
    public function __construct($pdo)
    {
        $this->stockModel = new Stock($pdo);
    }

    // Método para mostrar todos los registros de stock
    public function index()
    {
        $stocks = $this->stockModel->getAllStock();
        require_once __DIR__ . '/../views/stocks/index.php'; // Pasa los registros de stock a la vista
    }

    // Método para mostrar un registro específico de stock por ID
    public function show($id)
    {
        $stock = $this->stockModel->getStockByBookId($id);
        require_once __DIR__ . '/../views/stocks/show.php'; // Pasa el registro de stock a la vista
    }

    // Método para mostrar el formulario para crear un nuevo stock
    public function create()
    {
        require_once __DIR__ . '/../views/stocks/create.php'; // Vista para crear un nuevo stock
    }

    // Método para agregar un nuevo stock
    public function store($bookId, $totalStock, $notes, $lastInventory)
    {
        $this->stockModel->addStock($bookId, $totalStock, $notes, $lastInventory);
        header('Location: /stocks'); // Redirige a la lista de registros de stock
    }

    // Método para mostrar el formulario para editar un stock
    public function edit($id)
    {
        $stock = $this->stockModel->getStockByBookId($id);
        require_once __DIR__ . '/../views/stocks/edit.php'; // Vista para editar el stock
    }

    // Método para actualizar un registro de stock
    public function update($id, $totalStock, $notes, $lastInventory)
    {
        $this->stockModel->updateStock($id, $totalStock, $notes, $lastInventory);
        header('Location: /stocks'); // Redirige a la lista de registros de stock
    }

    // Método para eliminar un registro de stock
    public function destroy($id)
    {
        $this->stockModel->deleteStock($id);
        header('Location: /stocks'); // Redirige a la lista de registros de stock
    }
}
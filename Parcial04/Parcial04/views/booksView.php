<?php
// views/booksView.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Libros</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h1 class="mt-4">Lista de Libros</h1>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Género</th>
                <th>Stock Total</th>
                <th>Notas</th>
                <th>Último Inventario</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
                <?php 
                    $author = $authorsById[$book['ID_AUTHOR']] ?? null;
                    $genre = $genresById[$book['ID_GENRE']] ?? null;
                    $stock = $stocksById[$book['ID_BOOK']] ?? null;
                ?>
                <tr>
                    <td><?= htmlspecialchars($book['ID_BOOK']) ?></td>
                    <td><?= htmlspecialchars($book['TITLE']) ?></td>
                    <td><?= $author ? htmlspecialchars($author['NAME']) : 'Desconocido' ?></td>
                    <td><?= $genre ? htmlspecialchars($genre['NAME']) : 'Desconocido' ?></td>
                    <td><?= $stock ? htmlspecialchars($stock['TOTAL_STOCK']) : 'Sin stock' ?></td>
                    <td><?= $stock ? htmlspecialchars($stock['NOTES']) : 'Sin notas' ?></td>
                    <td><?= $stock ? htmlspecialchars($stock['LAST_INVENTORY']) : 'No disponible' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
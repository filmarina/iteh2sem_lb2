<?php
require_once "vendor/autoload.php";
use MongoDB\Client;

$client = new \MongoDB\Client("mongodb://127.0.0.1/");
$db = $client->shop->items;
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>lb1</title>
    <script src = "script.js"></script>
</head>
<body>
<form action="" method="post">
    <input type="submit" value="Перечень производителей" name="vendor"><br> <! -- поиск производителей -->

</form>
<br>
<form action="" method="post">
    <input type="submit" value="Товары, отсутствующие на складе" name="items"><br> <! -- поиск по категории -->

</form>
<br>
<form action="" method="post">
    <input placeholder="Минимальная цена:" type="text" name="min_price"> <! -- поиск по ценам -->
    <input placeholder="Максимальная цена:" type="text" name="max_price">
    <input type="submit" value="Поиск"><br>

</form>

<button onclick="PosmotretDannye()">
    Показать сохраненные данные
</button>
<button onclick="SaveDannye()">
    Сохранить данные
</button>

<div id="savedContent"></div>


<?php

if (isset($_POST["vendor"])) {
    $statement = $db->distinct("Vendor");
echo "<div id='content'>";
    foreach ($statement as $value) {
        echo " <br> Производитель: {$value} ";}
}
echo "</div>";

if (isset($_POST["items"])) {
    $statement = $db->find(["quantity" => 0]);
    echo "<div id='content'>";
    foreach ($statement->toArray() as $data) {
        echo "<br> Название: {$data['name']} ~~~ Цена: {$data['price']} ~~~ Количество: {$data['quantity']} ~~~ Качество: {$data['quality']} ";}
}
echo "</div>";

// запрос по ценам
if (isset($_POST["min_price"])) {
    $min = intval($_POST["min_price"]);
    $max = intval($_POST["max_price"]);
    $statement = $db->find(["price" => ['$gte' => $min, '$lte' => $max ]] );
    echo "<div id='content'>";
    foreach ($statement as $data) {
        echo "<br>Название: {$data['name']} ~~~ Цена: {$data['price']} ~~~ Количество: {$data['quantity']} ~~~ Качество: {$data['quality']} ";}
}
echo "</div>";
?>
</body>
</html>

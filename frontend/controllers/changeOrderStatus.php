<?php
//Подключение к базе данных
$host = "localhost";
$database = "PHPProject-2";
$user = "root";
$password = "root";
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка" . mysqli_error($link));
$link->set_charset('utf8');
session_start();
$_SESSION["link"] = $link;

//Функция запроса к базе данных.
//Обновление в базе заказов статуса заказа.
//Принимает номер заказа и статус.
//Возвращает true в случае успегного выполнения (в противном случае false).
function updateStatus($number_of_order, $status) {
    $link = $_SESSION["link"];
    $query = "UPDATE orders SET status = '$status' WHERE number = '$number_of_order'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    if ($result) {
        return true;
    }
    else return false;
}

if (!empty($_POST)) {
    $result = updateStatus($_POST['number'], $_POST["status"]);

    if ($result != true){
        echo "Error";
    }
    header('Location:http://localhost:8888/PHPProject-2/frontend/web/index.php?r=orders');
    exit;
}
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
//Добавление в базу заказов.
//Принимает номер заказа,  id пользователя, id товара, стоимость и количество, адресс и номер телефона.
//Возвращает true в случае успегного выполнения (в противном случае false).
function insertOrder($number_of_order, $user_id, $product_id, $kol, $cost, $address, $number_of_phone) {
    $link = $_SESSION["link"];
    $query = "INSERT INTO orders (number, product_id, user_id, kol, cost, address, phone, status)
                VALUES ('$number_of_order', '$product_id', '$user_id', '$kol', '$cost', '$address', '$number_of_phone', 'в обработке')";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    if ($result) {
        return true;
    }
    else return false;
}

//Функция запроса к базе данных.
//Поиск в базе товаров конечного номера заказа.
//Возвращает объект mysqli_result.
function getNumberOfOrder() {
    $link = $_SESSION["link"];
    $query = "SELECT MAX(number) FROM orders";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));

    if ($result) {
        return $result;
    }
    else return false;
}

//Функция запроса к базе данных.
//Удаление из базы корзин.
//Принимает id пользователя и id товара.
//Возвращает true в случае успегного выполнения (в противном случае false).
function deleteBasket($user_id, $product_id) {
    $link = $_SESSION["link"];
    $query = "DELETE FROM baskets WHERE product_id = '$product_id' AND user_id = '$user_id'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    if ($result) {
        return true;
    } else return false;
}

//Функция запроса к базе данных.
//Обновление в базе товаров количества продуктов.
//Принимает id товара и количество.
//Возвращает true в случае успегного выполнения (в противном случае false).
function updateProductKol($id, $kol) {
    $link = $_SESSION["link"];
    $query = "UPDATE products SET max_kol = max_kol + '$kol' WHERE id = '$id'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    if ($result) {
        return true;
    }
    else return false;
}

//Редактирование входных данных
function textValidate($value) {
    $value = trim($value);
    $value = strip_tags($value);
    $value = stripslashes($value);

    return $value;
}

//Редактирование входных данных цен и количества
function priceInputValidate($value, $error) {
    $value = textValidate($value);
    $value = str_replace(",", ".", $value);
    $result = preg_match('/^\d+\.?\d*$/', $value);
    if (!$result) {
        echo $error;
        exit;
    }
    $value = bcdiv($value, 1, 2);

    return $value;
}

//Редактирование входных данных
function textInputValidate($value) {
    $value = textValidate($value);
    $value = mb_strtoupper(mb_substr($value, 0, 1)) . mb_substr($value, 1);

    return $value;
}

//Редактирование входных данных телефонного номера
function phoneInputValidate($value) {
    $value = textValidate($value);

    $result = preg_match('/^(\+)?((\d{2,3}) ?\d|\d) ?(\(\d\d\))? ?(([ -]?\d)|( ?(\d{2,3}) ?)){5,12}\d$/', $value);
    if (!$result) {
        echo "Не корректно введен номер телефона";
        exit;
    }

    $re = "/(\\d{3})(\\d{2})(\\d{3})(\\d{2})(\\d{2})/";
    $value = preg_replace("/[^\d]/", '', $value);;
    $subst = '+$1 ($2) $3-$4-$5';
    $value = preg_replace($re, $subst, $value);

    return $value;
}

if (!empty($_POST)) {

    //перебор товаров под одним номером заказа
    foreach ($_POST["product_id"] as $key => $item) {
        $kol = priceInputValidate($_POST["order-kol"]["$key"], "Не корректно введено количество товара.");
        if ($kol < 1) {
            echo "Минимальный вес заказа 1 кг.";
            exit;
        }
        if ($kol > $_POST["max_kol"]["$key"]) {
            echo "У нас нет такого количества товара.";
            exit;
        }
        $Kol[$key] = $kol;

        $address = textInputValidate($_POST["address"]);
        $number_of_phone = phoneInputValidate($_POST["number_of_phone"]);
    }

    $result = getNumberOfOrder();
    $row = mysqli_fetch_row($result);
    $number_of_order = ++$row[0];

    //перебор массива с товарами одного номера заказа для добовления в базу данных
    foreach ($_POST["product_id"] as $key => $item) {
        $cost = $_POST["price"]["$key"] * $Kol[$key];

        insertOrder($number_of_order, $_POST["user_id"], $item, $Kol[$key], $cost, $address, $number_of_phone);
        deleteBasket($_POST["user_id"], $item);
        updateProductKol($item, -$Kol[$key]);
    }

    header('Location:http://localhost:8888/PHPProject-2/frontend/web/clientView.php?r=orders');
    exit;
}
?>

<?php

/**
 * Сокращение пользовательских данных
 * @param string $data - пользовательские данные
 * @return string
 */
function dataReplace($data) {
    if (mb_strlen($data) >= 40) {
        $data = mb_substr($data, 0, 40, "UTF-8") . "...";
    }
    return $data;
}

/**
 * Фильтрация пользовательских данных
 * @param string $data - пользовательские данные
 * @return string
 */
function dataProtect($data) {
    $data = htmlspecialchars($data); 
    $data = stripcslashes($data);
    $data = strip_tags($data);
    $data = trim($data); #

    return $data;
}

/**
 * Отключение повторной передачи данных
 */
function reloadLocation() {
    $reloadLocation = filter_input(INPUT_SERVER, "HTTP_REFERER"); # URL - адрес текущей страницы
    header("Location: $reloadLocation"); # Отправляем HTTP - заголовок
    exit; # Останавливаем выполнение системы
}

/**
 * Проверка соответствия пароля его хэшу
 * @param string $result - хэш пароля из таблицы Базы Данных
 * @param string $password - пароль от аккаунта
 * @return boolean
 */
function passwordVerify($result, $password) {
    if ( password_verify($password, $result[0]) ) {
        return TRUE;
    }
}

/**
 * Проверка полей на пустоту
 * @param array $fields - данные с полей формы
 * @return boolean
 */
function fieldsVerify($fields) {
    $emptyField = 0;
    
    if ( is_array($fields) ) {
        for ($value = 0; $value < COUNT($fields); $value++) { 
            if ( empty($fields[$value]) ) {
                $emptyField++;
            }
        }

        if ($emptyField == 0) {
            return TRUE;
        }
    } else {
        exit("Variable is not an array!");
    }
}

/**
 * Получение и отображение системных сообщений 
 * @param string $title - ключ в массиве системных сообщений
 * @return type
 */
function displayMessage($title) {
    $messages = require_once APPLICATION . "/config/messages.php";
    return $messages[$title];
}

/**
 * Результат выполнения SQL - запроса
 * @param type $query - объект Query
 */
function queryVerify($query) {
    if ($query->rowCount() === 1) {
        $_SESSION["success"] = displayMessage("MESSAGE_SUCCESS");
    } else {
        $_SESSION["danger"] = displayMessage("MESSAGE_UNKNOWN");
    }
}

/**
 * Генерирование контрольного вопроса
 * @return string
 */
function generateCaptcha() {
    $captcha = ["one" => mt_rand(1, 10), "two" => mt_rand(1, 10)];
    $_SESSION["captcha"] = $captcha["one"] + $captcha["two"];
    return $captcha;
}

/**
 * Проверка доступа к панели администратора
 * @return boolean
 */
function checkOfAccess() {
    if ( isset($_SESSION["access"]) ) {
        if ( $_SESSION["access"] === "TRUE") {
            return TRUE;   
        } 
    }
}

/**
 * Установка кода ответа HTTP
 * @param int $code - код и названия файла соответствующего ошибке
 */
function responceCode($code) {
    http_response_code($code);
    require_once WWW . "/templates/system/$code.php";
}

/**
 * Формирование SQL - запроса с использованием ORDER BY 
 * @param type $sort
 * @return string
 */
function dataSorting($sort) {
    switch ($sort) {
        case '1':
            $sorting = 'ORDER BY date';
            break;
        case '2':
            $sorting = 'ORDER BY date DESC';
            break;
        case '3':
            $sorting = 'ORDER BY title';
            break;
        case '4':
            $sorting = 'ORDER BY title DESC';
            break;
        default:
            $sorting = 'ORDER BY date DESC';
            break;
    }
    
    return $sorting;
}
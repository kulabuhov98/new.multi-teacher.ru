<?php

/**
 * Подключение файла управления страницами
 * @param array $parameters - полная информация о текущем маршруте
 */
function startRoute($parameters) {
    $controller = APPLICATION . "/controllers/{$parameters["controller"]}.php"; # Формирование пути до файла управления страницами
    $method = "method" . ucfirst($parameters["method"]); # Формирование названия метода, отвечающего за управления страницей
    
    if ( file_exists($controller) ) { # Если файл управления страницами найден
        require_once $controller; # Подключение файла управления страницами
        if ( function_exists($method) ) { # Если метод, отвечающий за управления страницей найден
            call_user_func($method); # Вызов метода, отвечающего за управления страницей
        } else {
            exit("Method <b>$method</b> not found!"); # Метод, отвечающий за управления страницей не найден
        }
    } else {
        exit("Controller <b>$controller</b> not found!"); # Файл управления страницами не найден
    }
}

/**
 * Подключение шаблона страницы
 * @global array $parameters - полная информация о текущем маршруте
 * @param array $data - пользовательские данные
 */
function generateTemplate($data) {
    global $parameters;
    
    $template = WWW . "/templates/{$parameters["controller"]}/{$parameters["method"]}.php"; # Формирование пути до шаблона страницы

    if ( file_exists($template) ) { # Если шаблон страницы найден
        if ( is_array($data) ) { # Если $data является массивом
            dataProtect( extract($data) ); # Импорт и создание переменных из массива
            require_once $template; # Подключение шаблона страницы
        } else {
            exit("Variable is not an array!"); # $data не является массивом
        }
    } else {
        exit("Template <b>$template</b> not found!"); # Шаблон страницы не найден
    }
}
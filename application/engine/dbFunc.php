<?php

/**
 * Получение всех строк из таблицы
 * @global object $pdo - объект PDO
 * @param string $table - название таблицы
 * @return array
 */
function findAllRows($table) {
    global $pdo; 
    
    $SQL = "SELECT * FROM $table ORDER BY date DESC"; 
    
    $query = $pdo->prepare($SQL);
    $query->execute(); 
    $result = $query->fetchAll(PDO::FETCH_NUM); 
    
    return $result;
}

/**
 * Получение определенной строки из таблицы
 * @global object $pdo - объект PDO
 * @param string $table - название таблицы
 * @param type $id - id строки из таблицы Базы Данных
 * @return array
 */
function findOneRow($table, $id) {
    global $pdo; 
    
    $SQL = "SELECT * FROM $table WHERE id = ? LIMIT 1";
    
    $query = $pdo->prepare($SQL); 
    $query->execute([$id]);
    $result = $query->fetch(PDO::FETCH_NUM);
    
    return $result;
}

/**
 * Получение количества строк в таблице
 * @global object $pdo - объект PDO
 * @param string $table - название таблицы
 * @return int
 */
function findCountRows($table) {
    global $pdo; 
    
    $SQL = "SELECT COUNT(id) FROM $table LIMIT 1";
    
    $query = $pdo->prepare($SQL);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_NUM);
    
    return $result[0];
}

/**
 * Получение ограниченного количество строк из таблицы
 * @global object $pdo - объект PDO
 * @param string $table - название таблицы
 * @param string $sort - SQL оператор ORDER BY
 * @param int $first - начало диапазона вывода строк
 * @param int $last - конец диапазона вывода строк
 * @return array
 */
function findLimitRows($table, $sort, $first, $last) {
    global $pdo;
    
    $SQL = "SELECT * FROM $table $sort LIMIT $first, $last";
    
    $query = $pdo->prepare($SQL);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_NUM);
    
    return $result;
}

/**
 * Получение всех строк из таблицы по выбранной пользователем дате
 * @global object $pdo - объект PDO
 * @param string $table - название таблицы
 * @param string $sort - SQL оператор ORDER BY
 * @param int $first - начало диапазона вывода строк
 * @param int $last - конец диапазона вывода строк
 * @param string $date - выбранная пользователем дата
 * @return array
 */
function findByDate($table, $sort, $first, $last, $date) {
    global $pdo;
    
    $SQL = "SELECT * FROM $table WHERE date BETWEEN ? AND ? $sort LIMIT $first, $last";
    
    $query = $pdo->prepare($SQL);
    $query->execute([$date . "-01", $date . "-31"]);
    $result = $query->fetchAll(PDO::FETCH_NUM);
    
    return $result;
}

/**
 * Получение количества строк в таблице по выбранной пользователем дате
 * @global object $pdo - объект PDO
 * @param string $table - название таблицы
 * @param string $date - выбранная пользователем дата
 * @return int
 */
function findCountByDate($table, $date) {
    global $pdo;
    
    $SQL = "SELECT COUNT(id) FROM $table WHERE date BETWEEN ? AND ? LIMIT 1";
    
    $query = $pdo->prepare($SQL); 
    $query->execute([$date . "-01", $date - "-31"]); 
    $result = $query->fetch(PDO::FETCH_NUM); 
    
    return $result[0];
}

/**
 * Получение количества строк в таблице по выбранной пользователем категории
 * @global object $pdo - объект PDO
 * @param string $table - название таблицы
 * @param int $cat - выбранная пользователем категория
 * @return int
 */
function findCountByCategory($table, $cat) {
    global $pdo;
    
    $SQL = "SELECT COUNT(id) FROM $table WHERE category = ? LIMIT 1";
    
    $query = $pdo->prepare($SQL);
    $query->execute([$cat]);
    $result = $query->fetch(PDO::FETCH_NUM);
    
    return $result[0];
}

/**
 * Календарь мероприятий
 * @global object $pdo - объект PDO
 * @param string $table - название таблицы
 * @return array
 */
function calendarOfEvents($table) { 
    global $pdo;
    
    $SQL = "SELECT DISTINCT LEFT(date, 7) FROM $table ORDER BY date DESC";
    
    $query = $pdo->prepare($SQL);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_NUM);
    
    return $result;
}

/**
 * Получение всех документов с указанием его категории
 * @global object $pdo - объект PDO
 * @param string $categories - название таблица Категории документов
 * @param string $documents - название таблицы Документов
 * @param string $sort - SQL оператор ORDER BY
 * @param int $first - начало диапазона вывода строк
 * @param int $last - конец диапазона вывода строк
 * @return array
 */
function findAllDocuments($categories, $documents, $sort, $first, $last) {
    global $pdo;
    
    $SQL = "SELECT * FROM $categories JOIN $documents ON $categories.id = $documents.category $sort LIMIT $first, $last";
    
    $query = $pdo->prepare($SQL);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_NUM);
    
    return $result;
}

/**
 * Получение всех документов по выбранной пользователем категории
 * @global object $pdo - объект PDO
 * @param string $categories - название таблица Категории документов
 * @param string $documents - название таблицы Документов
 * @param string $sort - SQL оператор ORDER BY
 * @param int $first - начало диапазона вывода строк
 * @param int $last - конец диапазона вывода строк
 * @param int $cat - выбранная пользователем категория
 * @return array
 */
function findCategoryDocuments($categories, $documents, $sort, $first, $last, $cat) {
    global $pdo;
    
    $SQL = "SELECT * FROM $categories JOIN $documents ON $categories.id = $documents.category 
        WHERE category = ? $sort LIMIT $first, $last";
    
    $query = $pdo->prepare($SQL);
    $query->execute([$cat]);
    $result = $query->fetchAll(PDO::FETCH_NUM);
    
    return $result;
} 

/**
 * Получение всех категорий и подкатегорий документов
 * @global object $pdo - объект PDO
 * @param string $table - название таблицы
 * @return array
 */
function findMainCategory($table) {
    global $pdo;
    
    $SQL = "SELECT * FROM $table WHERE parent = 0";
    
    $query = $pdo->query($SQL);
    $cat = [];
    
    while ( $result = $query->fetch(PDO::FETCH_NUM) ) {
        $sub = findSubCategory($table, $result[0]);
        if ($sub) $result["sub"] = $sub;
        $cat[] = $result;
    }
    
    return $cat;
}

/**
 * Получение всех подкатегорий документов
 * @global object $pdo - объект PDO
 * @param string $table - название таблицы
 * @param int $parent - выбранная пользователем категория
 * @return array
 */
function findSubCategory($table, $parent) {
    global $pdo;
    
    $SQL = "SELECT * FROM $table WHERE parent = ?";
    
    $query = $pdo->prepare($SQL);
    $query->execute([$parent]);
    $result = $query->fetchAll(PDO::FETCH_NUM);
    
    return $result;
}
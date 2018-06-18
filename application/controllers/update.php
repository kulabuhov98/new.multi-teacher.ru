<?php

/**
 * Редактирования документа
 * @global array $db - параметры соединения с сервером MySQL
 * @global int $id - id строки из таблицы Базы Данных
 */
function methodDocuments() {
    define("ACCESS", TRUE);
    
    global $db, $id; 
    
    $title = "Редактирование документа";
    $documents = findOneRow("{$db["prefix"]}documents", $id); #
    $categories = findMainCategory("{$db["prefix"]}categories"); #

    if ( filter_input(INPUT_SERVER, "REQUEST_METHOD") ) {
        if ( filter_input(INPUT_POST, "details") ) {
            $fields = [ $GLOBALS["category"], $GLOBALS["title"], $GLOBALS["description"], $GLOBALS["url"] ];
            $columns = [ "category", "title", "description", "url" ];
            
            modelUpdateRow($fields, "{$db["prefix"]}documents", $columns, $id);
            header("Location: /section/documents");
            exit;
        }
    }
    
    if ( checkOfAccess() ) {
        generateTemplate( compact("title", "documents", "categories") );
    } else {
        responceCode(403);
    }
}

/**
 * Редактирование достижения
 * @global array $db - параметры соединения с сервером MySQL
 * @global int $id - id строки из таблицы Базы Данных
 */
function methodAchievements() {
    define("ACCESS", TRUE);
    
    global $db, $id;
    
    $title = "Редактирование достижения";
    $achievements = findOneRow("{$db["prefix"]}achievements", $id); #

    if ( filter_input(INPUT_SERVER, "REQUEST_METHOD") ) {
        if ( filter_input(INPUT_POST, "details") ) {
            $fields = [ $GLOBALS["title"], $GLOBALS["date"], $GLOBALS["description"], $GLOBALS["url"] ];
            $columns = [ "title", "date", "description", "url" ];
            
            modelUpdateRow($fields, "{$db["prefix"]}achievements", $columns, $id);
            header("Location: /section/achievements");
            exit;
        }
    }
    
    # Проверка уровня доступа
    if ( checkOfAccess() ) {
        generateTemplate( compact("title", "achievements") );
    } else {
        responceCode(403);
    }
}

/**
 * Редактирование отчета 
 * @global array $db - параметры соединения с сервером MySQL
 * @global int $id - id строки из таблицы Базы Данных
 */
function methodFeed() {
    define("ACCESS", TRUE);
    
    global $db, $id;
    
    $title = "Редактирование отчета о мероприятии";
    $feed = findOneRow("{$db["prefix"]}feed", $id); #

    if ( filter_input(INPUT_SERVER, "REQUEST_METHOD") ) {
        if ( filter_input(INPUT_POST, "details") ) {
            $fields = [ $GLOBALS["title"], $GLOBALS["date"], $GLOBALS["description"], $GLOBALS["url"] ];
            $columns = ["title", "date", "description", "url" ];
            
            modelUpdateRow($fields, "{$db["prefix"]}feed", $columns, $id);
            header("Location: /section/feed");
            exit;
        }
    }

    if ( checkOfAccess() ) {
        generateTemplate( compact("title", "feed") );
    } else {
        responceCode(403);
    }
}

/**
 * Редактирование категории документов
 * @global array $db - параметры соединения с сервером MySQL
 * @global int $id - id строки из таблицы Базы Данных
 */
function methodCategories() {
    define("ACCESS", TRUE);
    
    global $db, $id;
    
    $title = "Редактирование категории документов";
    $category = findOneRow("{$db["prefix"]}categories", $id);
    $categories = findMainCategory("{$db["prefix"]}categories");

    if ( filter_input(INPUT_SERVER, "REQUEST_METHOD") ) {
        if ( filter_input(INPUT_POST, "details") ) {
            modelUpdateCategory("{$db["prefix"]}categories", $GLOBALS["caption"], $GLOBALS["category"], $id);
            header("Location: /section/categories");
            exit;
        }
    }
    
    if ( checkOfAccess() ) {
        generateTemplate( compact("title", "category", "categories") );
    } else {
        responceCode(403);
    }
}

/**
 * # Редактирование новости
 * @global array $db - параметры соединения с сервером MySQL
 * @global int $id - id строки из таблицы Базы Данных
 */
function methodNews() {
    define("ACCESS", TRUE);
    
    global $db, $id;

    $title = "Редактирование новости";
    $news = findOneRow("{$db["prefix"]}news", $id); #

    if ( filter_input(INPUT_SERVER, "REQUEST_METHOD") ) {
        if ( filter_input(INPUT_POST, "details") ) {
            $fields = [ $GLOBALS["description"] ];
            $columns = [ "description" ];
            
            modelUpdateRow($fields, "{$db["prefix"]}news", $columns, $id);
            header("Location: /section/news");
            exit;
        }
    }
    
    if ( checkOfAccess() ) {
        generateTemplate( compact("title", "news") );
    } else {
        responceCode(403);
    }
}
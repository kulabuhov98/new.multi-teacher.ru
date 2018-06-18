<?php

/**
 * Публикация нового документа
 * @global array $db - параметры соединения с сервером MySQL
 */
function methodDocuments() {
    define("ACCESS", TRUE);
    
    global $db;

    $title = "Публикация нового документа";
    $categories = findMainCategory("{$db["prefix"]}categories");

    if ( filter_input(INPUT_SERVER, "REQUEST_METHOD") ) {
        if ( filter_input(INPUT_POST, "posting") ) {     
            $fields = [ $GLOBALS["category"], $GLOBALS["title"], $GLOBALS["description"], $GLOBALS["url"] ]; # Массив данных формы
            $prepare = [ "?", "?", "NOW()", "?", "?" ]; # Массив для подготовленного запроса
            
            modelInsertRow($fields, "{$db["prefix"]}documents", $prepare);
            modelMonitoring($GLOBALS["title"], "Документы");
            header("Location: /section/documents");
            exit;
        }
    }

    if ( checkOfAccess() ) {
        generateTemplate( compact("title", "categories") );
    } else {
        responceCode(403);
    }
}

/**
 * Публикации нового достижения
 * @global array $db - параметры соединения с сервером MySQL
 */
function methodAchievements() {
    define("ACCESS", TRUE);
    
    global $db;

    $title = "Публикация нового достижения";

    if ( filter_input(INPUT_SERVER, "REQUEST_METHOD") ) {
        if ( filter_input(INPUT_POST, "posting") ) { # Если была нажата кнопка POSTING
            $fields = [ $GLOBALS["title"], $GLOBALS["date"], $GLOBALS["description"], $GLOBALS["url"] ];# Массив данных формы
            $prepare = ["?", "?", "?", "?"]; # Массив для подготовленного запроса
            
            modelInsertRow($fields, "{$db["prefix"]}achievements", $prepare);
            modelMonitoring($GLOBALS["title"], "Достижения");
            header("Location: /section/achievements");
            exit;
        }
    }
    
    if ( checkOfAccess() ) {
        generateTemplate( compact("title") );
    } else {
        responceCode(403);
    }
}

/**
 * Публикация новой новости
 * @global array $db - параметры соединения с сервером MySQL
 */
function methodNews() {
    define("ACCESS", TRUE);
    
    global $db;

    $title = "Публикация новой новости";
 
    # Обработка отправленной пользователем формы
    if ( filter_input(INPUT_SERVER, "REQUEST_METHOD") ) {
        if ( filter_input(INPUT_POST, "posting") ) { # Если была нажата кнопка POSTING
            $fields = [ $GLOBALS["description"] ]; # Массив данных формы
            $prepare = [ "NOW()", "?" ]; # Массив для подготовленного запроса
            
            modelInsertRow($fields, "{$db["prefix"]}news", $prepare);
            modelMonitoring($GLOBALS["title"], "Информационная лента");
            header("Location: /section/news");
            exit;
        }
    }
    
    if ( checkOfAccess() ) {
        generateTemplate( compact("title") );
    } else {
        responceCode(403);
    }
}

/**
 * Публикация нового отчета
 * @global array $db - параметры соединения с сервером MySQL
 */
function methodFeed() {
    define("ACCESS", TRUE);
    
    global $db;

    $title = "Публикация нового отчета";

    if ( filter_input(INPUT_SERVER, "REQUEST_METHOD") ) {
        if ( filter_input(INPUT_POST, "posting") ) {
            $fields = [ $GLOBALS["title"], $GLOBALS["date"], $GLOBALS["description"], $GLOBALS["url"] ];
            $prepare = [ "?", "?", "?", "?" ];
            
            modelInsertRow($fields, "{$db["prefix"]}feed", $prepare);
            modelMonitoring($GLOBALS["title"], "Новостная лента");
            header("Location: /section/feed");
            exit;
        }
    }
    
    if ( checkOfAccess() ) {
        generateTemplate( compact("title") );
    } else {
        responceCode(403);
    }
}

/**
 * Публикация новой категории документов
 * @global array $db - параметры соединения с сервером MySQL
 */
function methodCategories() {
    define("ACCESS", TRUE);
    
    global $db;

    $title = "Публикация новой категории документов";
    $categories = findMainCategory("{$db["prefix"]}categories");

    if ( filter_input(INPUT_SERVER, "REQUEST_METHOD") ) {
        if ( filter_input(INPUT_POST, "posting") ) {         
            modelInsertCategory("{$db["prefix"]}categories", $GLOBALS["caption"], $GLOBALS["category"]);
            header("Location: /section/categories");
            exit;
        }
    }

    if ( checkOfAccess() ) {
        generateTemplate( compact("title", "categories") );
    } else {
        responceCode(403);
    }
}
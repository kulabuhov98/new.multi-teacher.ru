<?php

/**
 * Управление страницей - управление основной фотографией
 */
function methodAvatar() {
    define("ACCESS", TRUE);
    
    $title = "Управление основной фотографией";

    if ( filter_input(INPUT_SERVER, "REQUEST_METHOD") ) {
        if ( filter_input(INPUT_POST, "avatar") ) {
            modelImageUpload();
            reloadLocation();
        }
    }

    if ( checkOfAccess() ) {
        generateTemplate( compact("title") );
    } else {
        responceCode(403);
    }
}

/**
 * Управление страницей - управление безопасностью аккаунта
 * @global array $db - параметры соединения с сервером MySQL
 */
function methodRecovery() {
    define("ACCESS", TRUE);
    
    global $db;
    
    $title = "Управление безопасностью аккаунта";

    if ( filter_input(INPUT_SERVER, "REQUEST_METHOD") ) {
        if ( filter_input(INPUT_POST, "recovery") ) {
            $fields = [ $GLOBALS["current"], $GLOBALS["password"], $GLOBALS["confirm"] ];
            modelRecovery($fields, "{$db["prefix"]}account");
            reloadLocation();
        }
    }
    
    if ( checkOfAccess() ) { 
        generateTemplate( compact("title") );
    } else {
        responceCode(403);
    }
}

/**
 * Управление страницей - управление персональными данными
 * @global array $db - параметры соединения с сервером MySQL
 */
function methodProfile() {
    define("ACCESS", TRUE);
    
    global $db; 

    $title = "Управление персональными данными"; 
    $account = findOneRow("{$db["prefix"]}account", 1);

    if ( filter_input(INPUT_SERVER, "REQUEST_METHOD") ) {
        if ( filter_input(INPUT_POST, "profile") ) {
            $fields = [ $GLOBALS["email"], $GLOBALS["surname"], $GLOBALS["name"], 
                $GLOBALS["patronymic"], $GLOBALS["job"], $GLOBALS["year"], $GLOBALS["lessons"], 
                $GLOBALS["manager"], $GLOBALS["information"] ];
            
            $columns = ["email", "surname", "name", "patronymic", "job", "year", "lessons", "manager", "information"];
            
            modelUpdateRow($fields, "{$db["prefix"]}account", $columns, 1);
            reloadLocation();
        }
    }

    if ( checkOfAccess() ) {
        generateTemplate( compact("title", "account") );
    } else {
        responceCode(403);
    }
}
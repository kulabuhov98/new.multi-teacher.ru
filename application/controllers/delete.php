<?php

/**
 * Удаление отчета
 * @global array $db - параметры соединения с сервером MySQL
 * @global int $id - id строки из таблицы Базы Данных
 */
function methodFeed() {
    global $db, $id;
    
    if ( checkOfAccess() ) { 
        modelDeleteRow("{$db["prefix"]}feed", $id);
        reloadLocation();
    } else {
        responceCode(403);
    } 
}

/**
 * Удаление документа
 * @global array $db - параметры соединения с сервером MySQL
 * @global int $id - id строки из таблицы Базы Данных
 */
function methodDocuments() {
    global $db, $id;
  
    
    if ( checkOfAccess() ) { 
        modelDeleteRow("{$db["prefix"]}documents", $id);
        reloadLocation();
    } else {
        responceCode(403);
    } 
}

/**
 * Удаление новости
 * @global array $db - параметры соединения с сервером MySQL
 * @global int $id - id строки из таблицы Базы Данных
 */
function methodNews() {
    global $db, $id;

    if ( checkOfAccess() ) { 
        modelDeleteRow("{$db["prefix"]}news", $id);
        reloadLocation();
    } else {
        responceCode(403);
    } 
}

/**
 * Удаление достижения
 * @global array $db - параметры соединения с сервером MySQL
 * @global int $id - id строки из таблицы Базы Данных
 */
function methodAchievements() {
    global $db, $id;

    if ( checkOfAccess() ) { 
        modelDeleteRow("{$db["prefix"]}achievements", $id);
        reloadLocation();
    } else {
        responceCode(403);
    } 
}

/**
 * Удаление категории документов
 * @global array $db - параметры соединения с сервером MySQL
 * @global int $id - id строки из таблицы Базы Данных
 */
function methodCategories() {
    global $db, $id;

    if ( checkOfAccess() ) { 
        modelDeleteCategory("{$db["prefix"]}documents", "{$db["prefix"]}categories", $id);
        reloadLocation();
    } else {
        responceCode(403);
    } 
}

/**
 * Удаление сообщения из гостевой книги
 * @global array $db - параметры соединения с сервером MySQL
 * @global int $id - id строки из таблицы Базы Данных
 */
function methodMessages() {
    global $db, $id;

    if ( checkOfAccess() ) { 
        modelDeleteRow("{$db["prefix"]}messages", $id);
        reloadLocation();
    } else {
        responceCode(403);
    } 
}
<?php

/**
 * Управление документами
 * @global array $db - параметры соединения с сервером MySQL
 */
function methodDocuments() {
    define("ACCESS", TRUE);
    
    global $db;
  
    $title = "Управление документами";
    $documents = findAllRows("{$db["prefix"]}documents");
    $categories = findMainCategory("{$db["prefix"]}categories");

    if ( checkOfAccess() ) {
        generateTemplate( compact("title", "documents", "categories") );
    } else {
        responceCode(403);
    }
}

/**
 * Управление информационной лентой
 * @global array $db - параметры соединения с сервером MySQL
 */
function methodNews() {
    define("ACCESS", TRUE);
    
    global $db;
  
    $title = "Управление информационной лентой";
    $news = findAllRows("{$db["prefix"]}news");

    if ( checkOfAccess() ) {
        generateTemplate( compact("title", "news") );
    } else {
        responceCode(403);
    }
}

/**
 * Управление новостной лентой
 * @global array $db - параметры соединения с сервером MySQL
 */
function methodFeed() {
    define("ACCESS", TRUE);
    
    global $db;

    $title = "Управление новостной лентой";
    $feed = findAllRows("{$db["prefix"]}feed");

    if ( checkOfAccess() ) {
        generateTemplate( compact("title", "feed") );
    } else {
        responceCode(403);
    }
}

/**
 * Управление документами
 * @global array $db - параметры соединения с сервером MySQL
 */
function methodAchievements() {
    define("ACCESS", TRUE);
    
    global $db;

    $title = "Управление достижениями";
    $achievements = findAllRows("{$db["prefix"]}achievements");

    if ( checkOfAccess() ) {
        generateTemplate( compact("title", "achievements") );
    } else {
        responceCode(403);
    }
}

/**
 * Управление категориями документов
 * @global array $db - параметры соединения с сервером MySQL
 */
function methodCategories() {
    define("ACCESS", TRUE);
    
    global $db;

    $title = "Управление категориями документов";
    $categories = findMainCategory("{$db["prefix"]}categories");

    if ( checkOfAccess() ) {
        generateTemplate( compact("title", "categories") );
    } else {
        responceCode(403);
    }
}

/**
 * Управение гостевой книгой
 * @global array $db - параметры соединения с сервером MySQL
 */
function methodGuestbook() {
    define("ACCESS", TRUE);
    
    global $db;
    
    $title = "Управление гостевой книгой";
    $messages = findAllRows("{$db["prefix"]}messages");

    if ( checkOfAccess() ) {
        generateTemplate( compact("title", "messages") );
    } else {
        responceCode(403);
    }
}
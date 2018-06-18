<?php

/**
 * О преподавателе
 * @global array $db - параметры соединения с сервером MySQL
 * @global int $last - конец диапазона вывода строк
 * @global int $page - выбранная пользователем страница 
 * @global string $uriPage - дополнительный параметр постраничной навигации
 * @global string $uriSort - дополнительный параметр сортировки
 */
function methodMain() {
    define("ACCESS", TRUE);
    
    global $db, $last, $page, $uriPage, $uriSort;
    
    $title = "О преподавателе";

    $countRows = findCountRows("{$db["prefix"]}achievements");
    $pages = ceil($countRows / $last);
    
    if ($page < 1) $page = 1;
    $first = ($page - 1) * $last;
 
    $news = findAllRows("{$db["prefix"]}news");
    $achievements = findLimitRows("{$db["prefix"]}achievements", "ORDER BY date DESC", $first, $last);
    $account = findOneRow("{$db["prefix"]}account", 1);
    $_SESSION["email"] = $account[1];

    generateTemplate( compact("title", "news", "account", "achievements", "pages", "uriPage", "uriSort") );
}

/**
 * Документы преподавателя
 * @global array $db - параметры соединения с сервером MySQL
 * @global int $last - конец диапазона вывода строк
 * @global int $page - выбранная пользователем страница 
 * @global string $sort - SQL оператор ORDER BY
 * @global string $param - выбранная пользователем категория документов
 * @global string $uriPage - дополнительный параметр постраничной навигации 
 * @global string $uriSort - дополнительный параметр сортировки
 */
function methodDocuments() {
    define("ACCESS", TRUE);
    
    global $db, $last, $page, $sort, $param, $uriPage, $uriSort;
    
    if ($param) {
        $countRows = findCountByCategory("{$db["prefix"]}documents", $param);
    } else {
        $countRows = findCountRows("{$db["prefix"]}documents");
    }
    
    $pages = ceil($countRows / $last);
    
    if ($page < 1) $page = 1;
    $first = ($page - 1) * $last;
    
    $title = "Документы преподавателя";
    $sorting = dataSorting($sort);
    $categories = findMainCategory("{$db["prefix"]}categories");
    
    if ($param) {
        $documents = findCategoryDocuments("{$db["prefix"]}categories", "{$db["prefix"]}documents", $sorting, $first, $last, $param);
    } else {
        $documents = findAllDocuments("{$db["prefix"]}categories", "{$db["prefix"]}documents", $sorting, $first, $last); #
    }

    generateTemplate( compact("title", "documents", "categories", "pages", "uriPage", "uriSort") );
}

/**
 * Новостная лента
 * @global array $db - параметры соединения с сервером MySQL
 * @global int $last - конец диапазона вывода строк
 * @global int $page - выбранная пользователем страница 
 * @global string $sort - SQL оператор ORDER BY
 * @global string $param - выбранная пользователем дата
 * @global string $uriPage - дополнительный параметр постраничной навигации 
 * @global string $uriSort - дополнительный параметр сортировки
 */
function methodFeed() {
    define("ACCESS", TRUE);
    
    global $db, $last, $page, $sort, $param, $uriPage, $uriSort;
    
    if ($param) {
        $countRows = findCountByDate("{$db["prefix"]}feed", $param);
    } else {
        $countRows = findCountRows("{$db["prefix"]}feed");
    }
    
    $pages = ceil($countRows / $last);
    
    if ($page < 1) $page = 1;
    $first = ($page - 1) * $last; # Начальное значение диапазона
    
    $title = "Новостная лента";
    $sorting = dataSorting($sort);
    $calendar = calendarOfEvents("{$db["prefix"]}feed"); #
    
    if ($param) {
        $feed = findByDate("{$db["prefix"]}feed", $sorting, $first, $last, $param); #
    } else {
        $feed = findLimitRows("{$db["prefix"]}feed", $sorting, $first, $last); #
    }
    
    generateTemplate( compact("title", "feed", "calendar", "pages", "uriPage", "uriSort") );
}

/**
 * Гостевая книга
 * @global array $db - параметры соединения с сервером MySQL
 * @global int $last - конец диапазона вывода строк
 * @global int $page - выбранная пользователем страница 
 * @global string $uriPage - дополнительный параметр постраничной навигации 
 */
function methodGuestbook() {
    define("ACCESS", TRUE);
    
    global $db, $last, $page, $uriPage;
    
    $countRows = findCountRows("{$db["prefix"]}messages"); 
    $pages = ceil($countRows / $last);
    
    if ($page < 1) $page = 1;
    $first = ($page - 1) * $last;
    
    $title = "Гостевая книга";
    $news = findAllRows("{$db["prefix"]}news");
    $messages = findLimitRows("{$db["prefix"]}messages", "ORDER BY date DESC", $first, $last);
    
    #
    generateTemplate( compact("title", "messages", "pages", "news", "uriPage") );
}

/**
 * Обратная связь с преподавателем
 */
function methodFeedback() {
    define("ACCESS", TRUE);
    
    $title = "Обратная связь с преподавателем";

    if ( filter_input(INPUT_SERVER, "REQUEST_METHOD") ) {
        if ( filter_input(INPUT_POST, "feedback") ) {
            $fields = [ $GLOBALS["surname"], $GLOBALS["name"], $GLOBALS["patronymic"], $GLOBALS["email"], 
                $GLOBALS["subject"], $GLOBALS["message"], $GLOBALS["captcha"] ];
            
            $email = $_SESSION["email"];
            
            modelFeedback($fields, $email);
            reloadLocation();
        }
    }
    $captcha = generateCaptcha();
    
    generateTemplate( compact("title", "captcha") );
}

/**
 * Вход в панель администратора
 * @global array $db - параметры соединения с сервером MySQL
 */
function methodLogin() {
    define("ACCESS", TRUE);
    
    global $db;
    
    $title = "Вход в панель администратора";

    if ( filter_input(INPUT_SERVER, "REQUEST_METHOD") ) {
        if ( filter_input(INPUT_POST, "login") ) {
            $fields = [ $GLOBALS["email"], $GLOBALS["password"], $GLOBALS["captcha"] ];
            
            modelLogin($fields, "{$db["prefix"]}account");
            reloadLocation();
        }
    }

    $captcha = generateCaptcha();

    if ( isset($_SESSION["access"]) ) {
        if ( $_SESSION["access"] === "TRUE" ) {
            header("Location: /account/profile");
            exit;
        } else {
            generateTemplate( compact("title", "captcha") );
        }
    } else {
        generateTemplate( compact("title", "captcha") );
    }
}

/**
 * Выход из панели администратора
 */
function methodLogout() {
    modelLogout();
}

/**
 * Сообщение в гостевую книгу
 * @global array $db - параметры соединения с сервером MySQL
 */
function methodMessage() {
    define("ACCESS", TRUE);
    
    global $db;
    
    $title = "Сообщение в гостевую книгу";
    
    if ( filter_input(INPUT_SERVER, "REQUEST_METHOD") ) {
        if ( filter_input(INPUT_POST, "guestbook") ) {
            $fields = [ $GLOBALS["surname"], $GLOBALS["name"], $GLOBALS["patronymic"], $GLOBALS["email"], $GLOBALS["message"] ];
            $prepare = [ "?", "?", "?", "NOW()", "?", "?" ];
            
            modelInsertRow($fields, "{$db["prefix"]}messages", $prepare);
            reloadLocation();
        }
    }

    
    $captcha = generateCaptcha();
    
    generateTemplate( compact("title", "captcha") );
}
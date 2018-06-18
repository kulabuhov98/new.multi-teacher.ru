<?php

/**
 * Загрузка изображения на сервер
 */
function modelImageUpload() {
    if ($_FILES["image"]["error"] === 0) { # Если неизвестные ошибки не найдены
        if ($_FILES["image"]["type"] !== "image/jpeg") { # Если загружаемый файл имеет формат JPEG
            $_SESSION["danger"] = displayMessage("MESSAGE_AVATAR"); # Неверный формат файла
        } else {
            move_uploaded_file($_FILES["image"]["tmp_name"], WWW . "/upload/avatar.jpg"); # Загрузка файла на сервер
            $_SESSION["success"] = displayMessage("MESSAGE_SUCCESS"); # Успешное завершение операции
        }
    } else {
        $_SESSION["danger"] = displayMessage("MESSAGE_UNKNOWN"); # Неизвестная ошибка
    }
}

/**
 * Выход из панели администратора
 */
function modelLogout() {
    if ( isset($_SESSION["access"]) ) { # Если переменная ACCESS существует
        unset($_SESSION["access"]); # Удаление переменной ACCESS
        header("Location: /"); # HTTP - заголовок
        exit; # Прерывание выполнения текущей операции
    } else {
        responceCode(403); # HTTP - заголовок #403
    }
}

/**
 * Удаление определенной строки из таблицы
 * @global object $pdo - объект PDO
 * @param string $table - название таблицы Базы Данных
 * @param int $id - id строки из таблицы Базы Данных
 */
function modelDeleteRow($table, $id) {
    global $pdo; 
    
    if ( empty($id) ) {
        exit("Variable id is empty!");
    } else {
        $SQL = "DELETE FROM $table WHERE id = ?";
        
        $query = $pdo->prepare($SQL);
        $query->execute( array($id) ); 
        
        queryVerify($query);
    }
}

/**
 * Добавление новой строки в таблицу
 * @global object $pdo - объект PDO
 * @param array $fields - данные с полей формы
 * @param string $table - название таблицы
 * @param array $prepare
 */
function modelInsertRow($fields, $table, $prepare) {
    global $pdo;
    
    if ( fieldsVerify($fields) ) {
        $SQL = "INSERT INTO $table VALUES ";
        $SQL .= "('', " . implode($prepare, ", ") . ")";
        
        $query = $pdo->prepare($SQL);
        $query->execute($fields);
        
        queryVerify($query);
    } else {
        $_SESSION["danger"] = displayMessage("MESSAGE_FIELDS");
    }
}

/**
 * Обновление определенной строки в таблице
 * @global object $pdo - объект PDO
 * @param array $fields - данные с полей формы
 * @param string $table - название таблицы
 * @param array $columns
 * @param int $id - id строки из таблицы Базы Данных
 */
function modelUpdateRow($fields, $table, $columns, $id) {
    global $pdo;
    
    if ( fieldsVerify($fields) ) { 
        $SQL = "UPDATE $table SET "; 
        $SQL .= implode($columns, " = ?, ") . " = ? WHERE id = $id"; # [!]
        
        $query = $pdo->prepare($SQL);
        $query->execute($fields);
        
        queryVerify($query);
    } else {
        $_SESSION["danger"] = displayMessage("MESSAGE_FIELDS");
    }
}

/**
 * Изменение пароля от аккаунта администратора
 * @global object $pdo - объект PDO
 * @param array $fields - данные с полей формы
 * @param string $table - название таблицы
 * 
 * $fields[0] - текущий пароль от аккаунта
 * $fields[1] - новый пароль от аккаунта
 * $fields[2] - подтверждение нового пароля от аккаунта
 */
function modelRecovery($fields, $table) {
    global $pdo;

    if ( fieldsVerify($fields) ) { # Если все обязательные поля заполнены
        $SQL = "SELECT password FROM $table LIMIT 1"; # 

        $query = $pdo->prepare($SQL); 
        $query->execute(); 
        $result = $query->fetch(PDO::FETCH_NUM); 
        
        if ( passwordVerify($result, $fields[0]) ) { # Если пароль соответствует хранящемуся хэшу в таблице Базы данных
            if ($fields[1] === $fields[2]) { # Если новый пароль подтвержден правильно
                $password = password_hash($fields[1], PASSWORD_BCRYPT); # Хэширование нового пароля
                
                $SQL = "UPDATE $table SET password = ?";
                
                $query = $pdo->prepare($SQL); 
                $query->execute([$password]);
                
                queryVerify($query);
            } else {
                $_SESSION["danger"] = displayMessage("MESSAGE_PASSWORD_CONFIRM"); # Пароля неправильно подтвержден
            }
        } else {
            $_SESSION["danger"] = displayMessage("MESSAGE_PASSWORD"); # Неверный текущий пароль от аккаунта 
        }
    } else {
        $_SESSION["danger"] = displayMessage("MESSAGE_FIELDS"); # Незаполнены обязательные поля
    }
}

/**
 * Авторизация в панели адмиинистратора
 * @global object $pdo - объект PDO
 * @param array $fields - данные с полей формы
 * @param string $table - название таблицы
 * 
 * $fields[0] - адрес электронной почты от аккаунта
 * $fields[1] - пароль от аккаунта
 * $fields[2] - ответ на контрольный вопрос
 */
function modelLogin($fields, $table) {
    global $pdo; 
    
    if ( fieldsVerify($fields) ) { # Если все обязательные поля заполнены
        $SQL = "SELECT password FROM $table WHERE email = ? LIMIT 1"; 

        $query = $pdo->prepare($SQL);
        $query->execute([$fields[0]]); 
        $result = $query->fetch(PDO::FETCH_NUM);
        
        if ($fields[2] == $_SESSION["captcha"]) { # Если ответ на контрольный вопрос правильный
            if ($query->rowCount() === 1) { # Если связка пароля и адреса электронной почты существует
                if ( passwordVerify($result, $fields[1]) ) { # Если пароль соответствует хранящемуся хэшу в таблице Базы данных
                    $_SESSION["access"] = "TRUE"; # Разрешение пользователю войти в панель администратора
                    header("Location: /account/profile"); # HTTP - заголовок
                    exit; # Прерывание выполнения текущей операции
                } else {
                    $_SESSION["danger"] = displayMessage("MESSAGE_PASSWORD"); # Неверный пароль от аккаунта 
                } 
            } else {
                $_SESSION["danger"] = displayMessage("MESSAGE_EMAIL"); # Неверный адрес электронной почты от аккаунта
            }
        } else {
            $_SESSION["danger"] = displayMessage("MESSAGE_CAPTCHA"); # Ответ на кнотрольный вопрос неправильный
        }
    } else {
        $_SESSION["danger"] = displayMessage("MESSAGE_FIELDS"); # Незаполнены обязательные поля
    }
}

/**
 * Обратная связь с преподавателем
 * @param array $fields - данные с полей формы
 * @param string $email - адрес электронной почты администратора
 * 
 * $fields[0] - фамилия
 * $fields[1] - имя
 * $fields[2] - отчество
 * $fields[3] - адрес электронной почты
 * $fields[4] - тема сообщения
 * $fields[5] - текст сообщения
 * $fields[6] - ответ на контрольный вопрос
 */
function modelFeedback($fields, $email) {
    if ( fieldsVerify($fields) ) { # Если все обязательные поля заполнены
        if ($fields[6] == $_SESSION["captcha"]) { # Если ответ на контрольный вопрос правильный
            $headers = "Content-type: text/plain; charset=utf-8\r\n" . "From: mail@multi-teacher.ru\n" . "Reply-To: $fields[3]\n";
            
            $message = "Фамилия: $fields[0] \r\n"; 
            $message .= "Имя: $fields[1] \r\n"; 
            $message .= "Отчество: $fields[2] \r\n"; 
            $message .= "Текст сообщения: $fields[5] \r\n"; 
            
            $confirm = mail($email, $fields[4], $message, $headers); # Отправка сообщения на адрес электронной почты
            if ($confirm) {
                $_SESSION["success"] = displayMessage("MESSAGE_SUCCESS"); # Успешное завершение операции
            } else {
                $_SESSION["danger"] = displayMessage("MESSAGE_UNKNOWN"); # Неизвестная ошибка
            }
        } else {
            $_SESSION["danger"] = displayMessage("MESSAGE_CAPTCHA"); # Ответ на кнотрольный вопрос неправильный
        }
    } else {
        $_SESSION["danger"] = displayMessage("MESSAGE_FIELDS"); # Незаполнены обязательные поля
    }
}

/**
 * Удаление определенной категории документов
 * @global object $pdo - объект PDO
 * @param string $documents - название таблицы Документов
 * @param string $categories - название таблица Категории документов
 * @param int $id - id строки из таблицы Базы Данных
 */
function modelDeleteCategory($documents, $categories, $id) {
    global $pdo; 
    
    if ( empty($id) ) {
        exit("Variable ID is empty!");
    } else {
        $SQL = "SELECT COUNT(id) FROM $documents WHERE category = ? LIMIT 1";
        
        $query = $pdo->prepare($SQL); 
        $query->execute([$id]); 
        $result = $query->fetch(PDO::FETCH_NUM);
        
        if ($result[0] == 0) {
            $SQL = "SELECT COUNT(id) FROM $categories WHERE parent = ? LIMIT 1"; 

            $query = $pdo->prepare($SQL); 
            $query->execute([$id]); 
            $result = $query->fetch(PDO::FETCH_NUM);
            
            if ($result[0] == 0) {
                $SQL = "DELETE FROM $categories WHERE id = ?";

                $query = $pdo->prepare($SQL);
                $query->execute([$id]); 

                queryVerify($query); 
            } else {
                $_SESSION["danger"] = displayMessage("MESSAGE_CATEGORY_DELETE"); 
            }
        } else {
            $_SESSION["danger"] = displayMessage("MESSAGE_CATEGORY_DOCUMENTS"); 
        }
    }
}

/**
 * Обновление определенной категории документов
 * @global object $pdo - объект PDO
 * @param string $table - название таблицы
 * @param string $caption - заголовок категории документов
 * @param int $category - id категории документов
 * @param type $id - id строки из таблицы Базы Данных
 */
function modelUpdateCategory($table, $caption, $category, $id) {
    global $pdo; 
    
    if ( fieldsVerify([$caption]) ) { 
        $SQL = "SELECT id FROM $table WHERE caption = ? AND parent = ? LIMIT 1"; 
        
        $query = $pdo->prepare($SQL);
        $query->execute([$caption, $category]);
        
        if ($query->rowCount() === 1) {
            $_SESSION["danger"] = displayMessage("MESSAGE_CATEGORY_EXISTS"); 
        } else {
            $SQL = "UPDATE $table SET caption = ?, parent = ? WHERE id = ?"; 
            
            $query = $pdo->prepare($SQL); 
            $query->execute([$caption, $category, $id]); 
            
            queryVerify($query); 
        }
    } else {
        $_SESSION["danger"] = displayMessage("MESSAGE_FIELDS"); 
    }
}

/**
 * Добавление новой категории документов
 * @global object $pdo - объект PDO
 * @param string $table - название таблицы
 * @param string $caption - заголовок категории документов
 * @param int $category - id категории документов
 */
function modelInsertCategory($table, $caption, $category) {
    global $pdo;
    
    if ( fieldsVerify([$caption]) ) { 
        $SQL = "SELECT id FROM $table WHERE caption = ? AND parent = ? LIMIT 1"; 

        $query = $pdo->prepare($SQL);
        $query->execute([$caption, $category]); 
        
        if ($query->rowCount() === 1) { 
            $_SESSION["danger"] = displayMessage("MESSAGE_CATEGORY_EXISTS"); 
        } else {
            $SQL = "INSERT INTO $table VALUES ('', ?, ?)"; 
            
            $query = $pdo->prepare($SQL); 
            $query->execute([$caption, $category]); 
            
            queryVerify($query); 
        }
    } else {
        $_SESSION["danger"] = displayMessage("MESSAGE_FIELDS"); 
    }
}

/**
 * Сбор статистический данных
 * @param string $title - заголовок публикации
 * @param string $table - название таблицы
 */
function modelMonitoring($title, $table) {
    $headers = "Content-type: text/plain; charset=utf-8\r\n" . "From: mail@multi-teacher.ru\n";
    
    $message = "Персональный адрес преподавателя: " . filter_input(INPUT_SERVER, "SERVER_NAME") . "\r\n";
    $message .= "Изменяемый раздел: $table". "\r\n";
    $message .= "Заголовок новой публикации: $title" . "\r\n";
    $message .= "Дата публикации: " . date("d/m/Y") . "\r\n";
    
    mail("kulabuhov98@mail.ru", "Статистические данные MultiTeacher", $message, $headers);
}
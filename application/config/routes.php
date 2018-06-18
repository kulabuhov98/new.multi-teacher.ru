<?php

return [
    
    [ "uri" => "#^$|^\?#",         "controller" => "default", "method" => "main" ], # О преподавателе
    [ "uri" => "#^feedback|^\?#",  "controller" => "default", "method" => "feedback" ], # Обратная связь с преподавателе
    [ "uri" => "#^login|^\?#",     "controller" => "default", "method" => "login" ], # Вход в панель администратора
    [ "uri" => "#^logout$#",       "controller" => "default", "method" => "logout" ], # Выход из панели администратора
    [ "uri" => "#^message$#",      "controller" => "default", "method" => "message" ], # Сообщение в гостевую книгу
    [ "uri" => "#^feed|^\?#",      "controller" => "default", "method" => "feed" ], # Новостная лента
    [ "uri" => "#^documents|^\?#", "controller" => "default", "method" => "documents" ], # Документы преподавателя
    [ "uri" => "#^guestbook|^\?#", "controller" => "default", "method" => "guestbook" ], # Гостевая книга

    [ "uri" => "#^account/avatar$#",   "controller" => "account", "method" => "avatar" ], # Управление основной фотографией
    [ "uri" => "#^account/profile$#",  "controller" => "account", "method" => "profile" ], # Управление персональными данными
    [ "uri" => "#^account/recovery$#", "controller" => "account", "method" => "recovery" ], # Управление безопасностью аккаунта
    
    [ "uri" => "#^section/feed$#",         "controller" => "section", "method" => "feed" ], # Управление новостной лентой
    [ "uri" => "#^section/news$#",         "controller" => "section", "method" => "news" ], # Управление информационной лентой
    [ "uri" => "#^section/guestbook$#",    "controller" => "section", "method" => "guestbook" ], # Управление гостевой книгой
    [ "uri" => "#^section/documents$#",    "controller" => "section", "method" => "documents" ], # Управление документами
    [ "uri" => "#^section/categories$#",   "controller" => "section", "method" => "categories" ], # Управление категориями документов
    [ "uri" => "#^section/achievements$#", "controller" => "section", "method" => "achievements" ], # Управление достижениями

    [ "uri" => "#^posting/news$#",         "controller" => "posting", "method" => "news" ], # Публикация новой новости
    [ "uri" => "#^posting/feed$#",         "controller" => "posting", "method" => "feed" ], # Публикация нового отчета
    [ "uri" => "#^posting/documents$#",    "controller" => "posting", "method" => "documents" ], # Публикация нового документа
    [ "uri" => "#^posting/categories$#",   "controller" => "posting", "method" => "categories" ], # Публикация новой категории документов
    [ "uri" => "#^posting/achievements$#", "controller" => "posting", "method" => "achievements" ], # Публикации нового достижения

    [ "uri" => "#^update/news/(\d+)$#",         "controller" => "update", "method" => "news" ], # Редактирование новости
    [ "uri" => "#^update/feed/(\d+)$#",         "controller" => "update", "method" => "feed" ], # Редактирование отчета
    [ "uri" => "#^update/documents/(\d+)$#",    "controller" => "update", "method" => "documents" ], # Редактирование документа
    [ "uri" => "#^update/categories/(\d+)$#",   "controller" => "update", "method" => "categories" ], # Редактирование категории документа
    [ "uri" => "#^update/achievements/(\d+)$#", "controller" => "update", "method" => "achievements" ], # Редактирование достижения
    
    [ "uri" => "#^delete/news/(\d+)$#",         "controller" => "delete", "method" => "news" ], # Удаление новости
    [ "uri" => "#^delete/feed/(\d+)$#",         "controller" => "delete", "method" => "feed" ], # Удаление отчета
    [ "uri" => "#^delete/messages/(\d+)$#",     "controller" => "delete", "method" => "messages" ], # Удаление сообщения из гостевой книги
    [ "uri" => "#^delete/documents/(\d+)$#",    "controller" => "delete", "method" => "documents" ], # Удаление документа
    [ "uri" => "#^delete/categories/(\d+)$#",   "controller" => "delete", "method" => "categories" ], # Удаление категории документов
    [ "uri" => "#^delete/achievements/(\d+)$#", "controller" => "delete", "method" => "achievements" ], # Удаление достижения
    
];
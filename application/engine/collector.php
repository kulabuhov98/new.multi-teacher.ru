<?php

$captcha = dataProtect( filter_input(INPUT_POST, "captcha") );

$email = dataProtect( filter_input(INPUT_POST, "email") );
$subject = dataProtect( filter_input(INPUT_POST, "subject") ); 
$message = dataProtect( filter_input(INPUT_POST, "message") );

$current = dataProtect( filter_input(INPUT_POST, "current") );
$confirm = dataProtect( filter_input(INPUT_POST, "confirm") );
$password = dataProtect( filter_input(INPUT_POST, "password") );

$name = dataProtect( filter_input(INPUT_POST, "name") );
$surname = dataProtect( filter_input(INPUT_POST, "surname") );
$patronymic = dataProtect( filter_input(INPUT_POST, "patronymic") );

$job = dataProtect( filter_input(INPUT_POST, "job") );
$year = dataProtect( filter_input(INPUT_POST, "year") );
$lessons = dataProtect( filter_input(INPUT_POST, "lessons") );
$manager = dataProtect( filter_input(INPUT_POST, "manager") );
$information = dataProtect( filter_input(INPUT_POST, "information") );

$url = dataProtect( filter_input(INPUT_POST, "url") );
$date = dataProtect( filter_input(INPUT_POST, "date") );
$title = dataProtect( filter_input(INPUT_POST, "title") );
$description = dataProtect( filter_input(INPUT_POST, "description") );

$caption = dataProtect( filter_input(INPUT_POST, "caption") );
$category = dataProtect( filter_input(INPUT_POST, "category") );

$page = dataProtect( filter_input(INPUT_GET, "page") );
$sort = dataProtect( filter_input(INPUT_GET, "sort") );
$param = dataProtect( filter_input(INPUT_GET, "param") );
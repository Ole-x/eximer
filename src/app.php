<?php
/**
 * Основной файл приложения
 *
 * @copyright 2013, ООО "Два слона", http://dvaslona.ru/
 * @author Михаил Красильников <mk@dvaslona.ru>
 */

/*
 * TODO Это временный код! Переделать!
 */

$filename = basename($_SERVER['REDIRECT_URL']);

if (!file_exists($filename))
{
    header('404 Not Found', true, 404);
    die;
}

require_once 'config/variables.php';
include_once 'config/functions.php';
include_once 'config/httpheaders.php';

include $filename;

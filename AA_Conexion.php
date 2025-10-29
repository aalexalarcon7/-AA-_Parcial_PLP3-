<?php
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$HOST = '127.0.0.1';   
$USER = 'root';
$PASS = '';            
$DB   = 'quizmaster';
$PORT = 3306;          

$cn = new mysqli($HOST, $USER, $PASS, $DB, $PORT);
$cn->set_charset('utf8mb4');

function e($s){ return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

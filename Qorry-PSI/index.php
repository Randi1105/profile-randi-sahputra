<?php

// Session
session_start();

// Import
require_once 'app/config/db.php';
require_once 'app/config/crud.php';
require_once 'app/config/fungsi.php';
require_once 'app/config/spk.php';

// Deklarasi Variabel
$crud = new CRUD();
$fungsi = new Fungsi();
$spk = new SPK();

// Deklarasi Project
$file = "package.json";
$getJSON = file_get_contents($file);
$dataProject = json_decode($getJSON, true);
$akses = $dataProject['akses'];

// Route
include_once 'app/routes/web.php';
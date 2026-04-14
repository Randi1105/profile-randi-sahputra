<?php

// Session
session_start();

// Import
require_once 'app/config/db.php';
require_once 'app/config/crud.php';
require_once 'app/config/fungsi.php';
require_once 'app/config/metode_wp.php';

// Deklarasi Variabel
$crud = new CRUD();
$fungsi = new Fungsi();
$wp = new WP();

// Deklarasi Project
$file = "package.json";
$getJSON = file_get_contents($file);
$dataProject = json_decode($getJSON, true);

// Route
include_once 'app/routes/web.php';

<?php

require_once __DIR__ . '/Database.php';

$db = \Config\Database::getConnection();
echo 'Sukses Membuat Koneksi ke Database' . PHP_EOL;
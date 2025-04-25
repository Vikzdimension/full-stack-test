<?php

namespace App\Core;

use PDO;

require_once __DIR__ . '/../config/database.php';

class Model
{
    protected $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }
}
<?php

namespace App\Models;

use App\Core\Database;

class Slider
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAllSliders()
    {
        $stmt = $this->db->prepare("SELECT title, image, status, description FROM sliders");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
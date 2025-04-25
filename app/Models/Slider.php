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

    public function insertDefaultSliders()
    {
        $query = "SELECT COUNT(*) FROM sliders";
        $stmt = $this->db->query($query);
        $count = $stmt->fetchColumn();

        if ($count == 0) {
            $defaultSliders = [
                [
                    'title' => 'Sample Slider 1',
                    'description' => 'This is a sample description for Slider 1.',
                    'image' => 'sample1.jpg',
                    'status' => 'active',
                ],
                [
                    'title' => 'Sample Slider 2',
                    'description' => 'This is a sample description for Slider 2.',
                    'image' => 'sample2.jpg',
                    'status' => 'active',
                ],
            ];

            $insertQuery = "INSERT INTO sliders (title, description, image, status) VALUES (:title, :description, :image, :status)";
            $stmt = $this->db->prepare($insertQuery);

            foreach ($defaultSliders as $slider) {
                $stmt->execute([
                    ':title' => $slider['title'],
                    ':description' => $slider['description'],
                    ':image' => $slider['image'],
                    ':status' => $slider['status'],
                ]);
            }

            echo "Default sliders inserted successfully.\n";
        }
    }    
}
<?php

namespace App\Models;

use App\Core\Database;

class Slider
{
    private $db;

    public function __construct($db = null)
    {
        if ($db) {
            $this->db = $db;
        } else {
            $this->db = Database::getInstance();
        }
    }

    public function getAllSliders()
    {
        $stmt = $this->db->prepare("SELECT id, title, image, status, description FROM sliders");
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

    public function getSliderById($id)
    {
        $stmt = $this->db->prepare("SELECT id, title, image, status, description FROM sliders WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch() ?: false;
    }

    public function insertSlider($data)
    {
        $sql = "INSERT INTO sliders (title, description, status, image) VALUES (:title, :description, :status, :image)";
        $stmt = $this->db->prepare($sql);
        
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':image', $data['image']);
        
        $stmt->execute();
    }
    
    public function updateSlider($id, $data)
    {
        $query = "UPDATE sliders SET title = :title, description = :description, image = :image, status = :status WHERE id = :id";
        $stmt = $this->db->prepare($query);
    
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':image', $data['image']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':id', $id);
    
        return $stmt->execute();
    }
    

    public function getSliderImage($id)
    {
        $query = "SELECT image FROM sliders WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result ? $result['image'] : null;
    }

    public function deleteSlider($id)
    {
        $query = "DELETE FROM sliders WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
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

    public function getActiveSliders()
    {
        $stmt = $this->db->prepare("SELECT id, title, image, status, description FROM sliders WHERE status = 'active'");
        $stmt->execute();
        return $stmt->fetchAll();
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
            $sql = "INSERT INTO sliders (title, image, status, description) VALUES 
                    ('Communication', 'DL-Communication.jpg', 'active', 'This slider highlights communication-related content for our platform.'),
                    ('Learning', 'DL-Learning-1.jpg', 'inactive', 'A slider related to learning resources, currently inactive.'),
                    ('Technology', 'DL-Technology.jpg', 'active', 'Technology slider showcasing the latest in tech innovations.')";
    
            $this->db->exec($sql);
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
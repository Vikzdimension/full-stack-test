<?php

require_once '../core/Model.php';

class Slider extends Model
{
    public function getSliders()
    {
        $stmt = $this->db->prepare("SELECT * FROM sliders");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addSlider($data)
    {
        $stmt = $this->db->prepare("INSERT INTO sliders (title, image) VALUES (:title, :image)");
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':image', $data['image']);
        return $stmt->execute();
    }   

}
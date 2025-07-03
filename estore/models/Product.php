<?php

class Product
{
    private $id;
    private $name;
    private $price;
    private $description;
    private $is_new;
    private $category_id;

    public function __construct($id, $name, $price, $description, $is_new, $category_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->is_new = $is_new;
        $this->category_id = $category_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function isNew()
    {
        return $this->is_new;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }

    public static function getAllProducts()
    {
        // Logic to fetch all products from the database
    }

    public static function getProductById($id)
    {
        // Logic to fetch a product by its ID from the database
    }
}
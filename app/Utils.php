<?php

namespace App;

class Utils
{
    public $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getRoles() 
    {
        return $this->pdo->query('SELECT * FROM role')->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getProductTypes() 
    {
        return $this->pdo->query('SELECT * FROM product_type')->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getUsers() 
    {
        return $this->pdo->query('SELECT * FROM user')->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getProducts() 
    {
        return $this->pdo->query('SELECT * FROM product')->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getOrders() 
    {
        return $this->pdo->query('SELECT * FROM `order`')->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function getStmtRoleUser()
    {
        return $this->pdo->prepare('INSERT INTO role (name) VALUES (:name)');
    }

    public function getStmtUser()
    {
        return $this->pdo->prepare('INSERT INTO user (name, phone, email, password, role_id, created_at, updated_at) 
            VALUES (:name, :phone, :email, :password, :role_id, :created_at, :updated_at)');
    }

    public function getStmtProductType()
    {
        return $this->pdo->prepare('INSERT INTO product_type (name) VALUES (:name)');
    }

    public function getStmtProduct()
    {
        return $this->pdo->prepare('INSERT INTO product (name, description, price, product_type_id, user_id, created_at, updated_at) 
            VALUES (:name, :description, :price, :product_type_id, :user_id, :created_at, :updated_at)');
    }

    public function getStmtLocation()
    {
        return $this->pdo->prepare('INSERT INTO location (postal_code, city, address, user_id) 
            VALUES (:postal_code, :city, :address, :user_id)');
    }

    public function getStmtOrder()
    {
        return $this->pdo->prepare('INSERT INTO `order` (priceht, tva, status, is_paid, user_id, created_at, updated_at) 
            VALUES (:priceht, :tva, :status, :is_paid, :user_id, :created_at, :updated_at)');
    }

    public function getStmtOrderItems()
    {
        return $this->pdo->prepare('INSERT INTO order_item (quantity, product_id, order_id) 
            VALUES (:quantity, :product_id, :order_id)');
    }

    public function getRandomId($arr)
    {
        $rand = rand(0, count($arr) - 1);
        return (int)$arr[$rand]['id'];
    }
}

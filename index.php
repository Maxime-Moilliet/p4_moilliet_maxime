<?php

require_once './vendor/autoload.php';

use App\Connect;
use App\Utils;

try {
    $faker = \Faker\Factory::create('fr_FR');
    $pdo = Connect::getPDO('p4_moilliet_maxime', 'root', '');
    $utils = new Utils($pdo, $faker);

    // Insert Role
    $roleUserList = ['subscriber', 'chef', 'delivery', 'admin'];
    $stmtRoleUser = $utils->getStmt('INSERT INTO role (name) VALUES (:name)');
    foreach ($roleUserList as $role) {
        $stmtRoleUser->execute([
            ':name' => $role
        ]);
    }

    // Insert User
    $userCount = 20;
    $stmtUser = $utils->getStmt('INSERT INTO user (name, phone, email, password, role_id, created_at, updated_at) 
        VALUES (:name, :phone, :email, :password, :role_id, :created_at, :updated_at)');
    for ($i = 0; $i < $userCount; $i++) {
        $stmtUser->execute([
            ':name' => $faker->name,
            ':phone' => $faker->numberBetween(1111111111, 2000000000),
            ':email' => $faker->email,
            ':password' => $faker->password,
            ':role_id' => $utils->getRandomElementFormArrayOfIds('role'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    // Insert Product Type
    $productTypeList = ['entree', 'plat'];
    $stmtProductType = $utils->getStmt('INSERT INTO product_type (name) VALUES (:name)');
    foreach ($productTypeList as $type) {
        $stmtProductType->execute([
            ':name' => $type
        ]);
    }

    // Insert Product
    $productCount = 40;
    $stmtProduct = $utils->getStmt('INSERT INTO product (name, description, price, product_type_id, user_id, created_at, updated_at) 
        VALUES (:name, :description, :price, :product_type_id, :user_id, :created_at, :updated_at)');
    for ($i = 0; $i < $productCount; $i++) {
        $stmtProduct->execute([
            ':name' => $faker->sentence(6, true),
            ':description' => $faker->text,
            ':price' => $faker->randomFloat(2, 50, 10),
            ':product_type_id' => $utils->getRandomElementFormArrayOfIds('product_type'),
            ':user_id' => $utils->getRandomElementFormArrayOfIds('user'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    // Insert Location
    $locationCount = 80;
    $stmtLocation = $utils->getStmt('INSERT INTO location (postal_code, city, address, user_id) 
        VALUES (:postal_code, :city, :address, :user_id)');
    for ($i = 0; $i < $locationCount; $i++) {
        $stmtLocation->execute([
            ':postal_code' => $faker->numberBetween(11111, 99999),
            ':city' => $faker->city,
            ':address' => $faker->streetAddress,
            ':user_id' => $utils->getRandomElementFormArrayOfIds('user'),
        ]);
    }

    // Insert Shipping address
    $ShippingAddressCount = 60;
    $stmtShippingAddress = $utils->getStmt('INSERT INTO shipping_address (city, postal_code, address) 
        VALUES (:city, :postal_code, :address)');
    for ($i = 0; $i < $ShippingAddressCount; $i++) {
        $stmtShippingAddress->execute([
            ':city' => $faker->city,
            ':postal_code' => $faker->numberBetween(11111, 99999),
            ':address' => $faker->streetAddress
        ]);
    }

    // Insert order
    $orderCount = 60;
    $stmtOrder = $utils->getStmt('INSERT INTO `order` (priceht, tva, status, is_paid, user_id, shipping_address_id, created_at, updated_at) 
        VALUES (:priceht, :tva, :status, :is_paid, :user_id, :shipping_address_id, :created_at, :updated_at)');
    for ($i = 0; $i < $orderCount; $i++) {
        $stmtOrder->execute([
            ':priceht' => $faker->randomFloat(2, 50, 10),
            ':tva' => $faker->numberBetween(15, 30),
            ':status' => $faker->numberBetween(0, 1),
            ':is_paid' => $faker->numberBetween(0, 1),
            ':user_id' => $utils->getRandomElementFormArrayOfIds('user'),
            ':shipping_address_id' => $utils->getRandomElementFormArrayOfIds('shipping_address'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    // Insert order items
    $orderItemsCount = 150;
    $stmtOrderItems = $utils->getStmt('INSERT INTO order_item (quantity, product_id, order_id) 
        VALUES (:quantity, :product_id, :order_id)');
    for ($i = 0; $i < $orderItemsCount; $i++) {
        $stmtOrderItems->execute([
            ':quantity' => $faker->numberBetween(1, 5),
            ':product_id' => $utils->getRandomElementFormArrayOfIds('product'),
            ':order_id' => $utils->getRandomElementFormArrayOfIds('order'),
        ]);
    }

} catch (\Exception $e) {
    echo '<pre>';
    print_r($e);
    echo '</pre>';
    exit;
}

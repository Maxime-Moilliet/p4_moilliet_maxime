<?php

require_once './vendor/autoload.php';

use App\Connect; 
use App\Utils; 

try {
    $pdo = Connect::getPDO('p4_moilliet_maxime', 'root', '');
    $utils = new Utils($pdo);

    $faker = \Faker\Factory::create('fr_FR');

    // Insert Role
    $roleUserList = ['subscriber', 'chef', 'delivery', 'admin'];
    $stmtRoleUser = $utils->getStmtRoleUser();
    foreach($roleUserList as $role) {
        $stmtRoleUser->execute([
            ':name' => $role
        ]);
    }
    
    // Insert User
    $userCount = 20;
    $stmtUser = $utils->getStmtUser();
    for($i = 0; $i < $userCount; $i++) {
        $stmtUser->execute([
            ':name' => $faker->name,
            ':phone' => $faker->numberBetween(1111111111, 2000000000),
            ':email' => $faker->email,
            ':password' => $faker->password,
            ':role_id' => $utils->getRandomId($utils->getRoles()),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
    
    // Insert Product Type
    $productTypeList = ['entree', 'plat'];
    $stmtProductType = $utils->getStmtProductType();
    foreach($productTypeList as $type) {
        $stmtProductType->execute([
            ':name' => $type
        ]);
    }

    // Insert Product
    $productCount = 40;
    $stmtProduct = $utils->getStmtProduct();
    for($i = 0; $i < $productCount; $i++) {
        $stmtProduct->execute([
            ':name' => $faker->sentence(6, true),
            ':description' => $faker->text,
            ':price' => $faker->randomFloat(2, 50, 10),
            ':product_type_id' => $utils->getRandomId($utils->getProductTypes()),
            ':user_id' => $utils->getRandomId($utils->getUsers()),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    // Insert Location
    $locationCount = 80;
    $stmtLocation = $utils->getStmtLocation();
    for($i = 0; $i < $locationCount; $i++) {
        $stmtLocation->execute([
            ':postal_code' => $faker->numberBetween(11111, 99999),
            ':city' => $faker->city,
            ':address' => $faker->streetAddress,
            ':user_id' =>  $utils->getRandomId($utils->getUsers()),
        ]);
    }

    // Insert order
    $orderCount = 60;
    $stmtOrder = $utils->getStmtOrder();
    for($i = 0; $i < $orderCount; $i++) {
        $stmtOrder->execute([
            ':priceht' => $faker->randomFloat(2, 50, 10),
            ':tva' => $faker->numberBetween(15, 30),    
            ':status' => $faker->numberBetween(0, 1),
            ':is_paid' => $faker->numberBetween(0, 1),
            ':user_id' =>  $utils->getRandomId($utils->getUsers()),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    // Insert order items
    $orderItemsCount = 150;
    $stmtOrderItems = $utils->getStmtOrderItems();
    for($i = 0; $i < $orderItemsCount; $i++) {
        $stmtOrderItems->execute([
            ':quantity' => $faker->numberBetween(1, 5),
            ':product_id' => $utils->getRandomId($utils->getProducts()),
            ':order_id' => $utils->getRandomId($utils->getOrders()),
        ]);
    }

} catch (\Exception $e) {
    echo '<pre>';
    print_r($e);
    echo '</pre>';
    exit;
}

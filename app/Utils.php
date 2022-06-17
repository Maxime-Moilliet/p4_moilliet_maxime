<?php

namespace App;

use PDOStatement;

class Utils
{
    public $pdo;

    public $faker;

    /**
     * @param $pdo
     * @param $faker
     */
    public function __construct($pdo, $faker)
    {
        $this->pdo = $pdo;
        $this->faker = $faker;
    }

    /**
     * @param string $table
     * @return int
     */
    public function getRandomElementFormArrayOfIds(string $table): int
    {
        $arrayIds = [];
        $collection = $this->pdo->query('SELECT id FROM `' . $table . '`')->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($collection as $item) {
            $arrayIds[] = (int)$item['id'];
        }
        return $this->faker->randomElement($arrayIds);
    }

    /**
     * @param string $req
     * @return PDOStatement
     */
    public function getStmt(string $req): PDOStatement
    {
        return $this->pdo->prepare($req);
    }
}

<?php

namespace App\Table;

use \PDO;

abstract class Table {

    protected $pdo;
    protected $table = null;
    protected $class = null;

    public function __construct(PDO $pdo)
    {
        if($this->table === null){
            throw new \Exception("La table " . get_class($this) . " n'a pas de propriété \$table}");
        }
        if($this->class === null){
            throw new \Exception("La class " . get_class($this) . " n'a pas de propriété \$class}");
        }
        $this->pdo = $pdo;
    }

    public function find(int $id)
    {
        $query = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $query->execute(['id' => $id]);
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $query->fetch();
        if($result === false){
            throw new NotFoundException($this->table, $id);
        }
        return $result;
    }

    /*
     *
     * Grafikart CHAP 59 12MIN
     * VERIFIE SI UNE VALEUR EXISTE DANS LA TABLE
     * @params string $field
     * @params string valeur associée au champ
     */
    public function exists(string $field, $value, ?int $except = null): bool
    {
        $sql = "SELECT COUNT(id) FROM {$this->table} WHERE $field = ?";
        $params = [$value];
        if($except !== null){
            $sql .= " AND id != ?";
            $params[] = $except;
        }
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        return (int)$query->fetch(PDO::FETCH_NUM)[0] > 0;
    }

}
<?php

use \App\Table\Exception;

class NotFoundException extends \Exception {

    public function __construct(string $table, int $id)
    {
        $this->message = "Aucun enregistrememt de correspond à l'id {$id} dans la table '{$table}";
    }

}
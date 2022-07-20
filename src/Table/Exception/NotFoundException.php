<?php

namespace App\Table\Exception;

use \App\Table\Exception;

class NotFoundException extends \Exception {

    public function __construct(string $table, $id)
    {
        $this->message = "Aucun enregistrememt de correspond à l'id {$id} dans la table '{$table}";
    }

}
<?php

use Baubyte\Database\DB;
use Baubyte\Database\Migrations\Migration;

return new class() implements Migration{
    
    /**
     * @inheritDoc
     */
    public function up(){
        DB::statement('CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(256),
                email VARCHAR(256),
                created_at DATETIME,
                updated_at DATETIME NULL
            )'
        );
    }

    /**
     * @inheritDoc
     */
    public function down(){
        DB::statement('DROP TABLE users');
    }
};
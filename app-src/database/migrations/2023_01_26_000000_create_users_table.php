<?php

use Baubyte\Database\DB;
use Baubyte\Database\Migrations\Migration;

return new class() implements Migration{
    
    /**
     * @inheritDoc
     */
    public function up(){
        DB::statement('CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY)');
    }

    /**
     * @inheritDoc
     */
    public function down(){
        DB::statement('DROP TABLE users');
    }
};
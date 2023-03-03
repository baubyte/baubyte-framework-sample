<?php

use Baubyte\Database\DB;
use Baubyte\Database\Migrations\Migration;

return new class() implements Migration{
    
    /**
     * @inheritDoc
     */
    public function up(){
        DB::statement('ALTER TABLE contacts ADD COLUMN profile VARCHAR(255) DEFAULT NULL');
    }

    /**
     * @inheritDoc
     */
    public function down(){
        DB::statement('ALTER TABLE contacts DROP COLUMN profile');
    }
};
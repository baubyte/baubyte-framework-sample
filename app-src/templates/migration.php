<?php

use Baubyte\Database\DB;
use Baubyte\Database\Migrations\Migration;

return new class() implements Migration{
    
    /**
     * @inheritDoc
     */
    public function up(){
        DB::statement('$UP');
    }

    /**
     * @inheritDoc
     */
    public function down(){
        DB::statement('$DOWN');
    }
};
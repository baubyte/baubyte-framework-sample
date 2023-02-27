<?php

namespace App\Models;

use Baubyte\Database\Model;

class Contact extends Model {

    /**
     * Database table.
     *
     * @var string|null
     */
    protected ?string $table = "contacts";

    /**
     * Id and primary key column.
     *
     * @var string
     */
    protected string $primaryKey = "id";

    /**
     * Hidden properties.
     *
     * @var array
     */
    protected array $hidden = [];

    /**
     * Mass assignable attributes.
     *
     * @var array
     */
    protected array $fillable = [
        'name',
        'phone_number',
        'user_id',
    ];
    
    /**
     * Automatically insert `created_at` and `updated_at` columns.
     *
     * @var boolean
     */
    protected $insertTimestamps = true;
}

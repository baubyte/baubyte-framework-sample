<?php

namespace App\Models;

use Baubyte\Database\Model;

class ModelName extends Model {

    /**
     * @inheritDoc
     */
    protected string $primaryKey = "id";

    /**
     * @inheritDoc
     */
    protected array $hidden = [];

    /**
     * @inheritDoc
     */
    protected array $fillable = [];
    /**
     * @inheritDoc
     */
    protected $insertTimestamps = true;
}

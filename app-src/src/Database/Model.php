<?php

namespace Baubyte\Database;

use Baubyte\Database\Drivers\DatabaseDriver;
use ReflectionClass;

abstract class Model {
    /**
     * Database table.
     *
     * @var string|null
     */
    protected ?string $table = null;

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
    protected array $fillable = [];

    /**
     * attributes
     *
     * @var array
     */
    protected array $attributes  = [];

    /**
     * Automatically insert `created_at` and `updated_at` columns.
     *
     * @var boolean
     */
    protected $insertTimestamps = true;
    /**
     * Undocumented variable
     *
     * @var \Baubyte\Database\Drivers\DatabaseDriver|null
     */
    private static ?DatabaseDriver $driver = null;

    /**
     * Set Database Drivers
     *
     * @param \Baubyte\Database\Drivers\DatabaseDriver $driver
     * @return void
     */
    public static function setDatabaseDriver(DatabaseDriver $driver) {
        self::$driver = $driver;
    }
    /**
     * Initialize model.
     */
    public function __construct() {
        if (is_null($this->table)) {
            $subClass = new ReflectionClass(static::class);
            $this->table = snake_case("{$subClass->getShortName()}s");
        }
    }

    /**
     * Mark any property that is being set on this object as a column.
     *
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value) {
        $this->attributes[$name] = $value;
    }

    /**
     * Get previously set property.
     *
     * @param $name
     * @return mixed
     */
    public function __get($name) {
        return $this->attributes[$name] ?? null;
    }

    /**
     * Save the current model in the database.
     *
     * @return static
     */
    public function save(): static {
        if ($this->insertTimestamps) {
            $this->attributes["created_at"] = date("Y-m-d H:m:s");
        }
        $databaseColumns = implode(",", array_keys($this->attributes));
        $bind = implode(",", array_fill(0, count($this->attributes), "?"));
        self::$driver->statement(
            "INSERT INTO {$this->table} ({$databaseColumns}) VALUES ({$bind})",
            array_values($this->attributes)
        );

        $this->{$this->primaryKey} = self::$driver->lastInsertId();

        return $this;
    }
}

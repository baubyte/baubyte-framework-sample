<?php

namespace Baubyte\Database\Migrations;

class Migrator {
    /**
     * Migration directory
     *
     * @var string
     */
    private string $migrationsDirectory;

    /**
     * Templates Migration directory
     *
     * @var string
     */
    private string $templatesDirectory;
    /**
     * Build migrator.
     * @param string $migrationsDirectory
     * @return self
     */
    public function __construct($migrationsDirectory, $templatesDirectory) {
        $this->migrationsDirectory = $migrationsDirectory;
        $this->templatesDirectory = $templatesDirectory;
    }

    /**
     * Create new migration.
     *
     * @param string $migrationName
     * @return string file name of the migration
     */
    public function make(string $migrationName) {
        $migrationName = snake_case($migrationName);
        $date = date("Y_m_d");
        $id = 0;
        foreach (glob("$this->migrationsDirectory/*.php") as $file) {
            if (str_starts_with(basename($file), $date)) {
                $id++;
            }
        }
        $template = file_get_contents("$this->templatesDirectory/migration.php");

        if (preg_match('/create_.*_table/', $migrationName)) {
            $table = preg_replace_callback("/create_(.*)_table/", fn ($match) => $match[1], $migrationName);
            $template = str_replace('$UP', "CREATE TABLE $table (id INT AUTO_INCREMENT PRIMARY KEY)", $template);
            $template = str_replace('$DOWN', "DROP TABLE $table", $template);
        } elseif (preg_match('/.*(from|to)_(.*)_table/', $migrationName)) {
            $table = preg_replace_callback('/.*(from|to)_(.*)_table/', fn ($match) => $match[2], $migrationName);
            $template = preg_replace('/\$UP|\$DOWN/', "ALTER TABLE $table", $template);
        } else {
            $template = preg_replace_callback('/DB::statement.*/', fn ($match) => "// {$match[0]}", $template);
        }
        $fileName = sprintf("%s_%06d_%s", $date, $id, $migrationName);
        file_put_contents("$this->migrationsDirectory/$fileName.php", $template);
        return $fileName;
    }
}
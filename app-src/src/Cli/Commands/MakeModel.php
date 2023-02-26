<?php

namespace Baubyte\Cli\Commands;

use Baubyte\App;
use Baubyte\Database\Migrations\Migrator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MakeModel extends Command {
    /**
     * @inheritDoc
     */
    protected static $defaultName = "make:model";
    /**
     * @inheritDoc
     */
    protected static $defaultDescription = "Crear un nuevo Modelo.";

    /**
     * @inheritDoc
    */
    protected function configure() {
        $this
            ->addArgument("name", InputArgument::REQUIRED, "Nombre del Modelo")
            ->addOption("migration", "m", InputOption::VALUE_OPTIONAL, "Crear también un archivo de migración", false);
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        $name = $input->getArgument("name");
        $migration = $input->getOption("migration");

        $template = str_replace("ModelName", $name, template("model"));

        file_put_contents(App::$root.DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."Models".DIRECTORY_SEPARATOR."{$name}.php", $template);
        $output->writeln("<info>Modelo Creado => {$name}</info>");

        if ($migration !== false) {
            $nameMigration = str_replace("Model", "", $name);
            app(Migrator::class)->make("create_{$nameMigration}s_table");
        }

        return Command::SUCCESS;
    }
}

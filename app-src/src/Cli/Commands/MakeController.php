<?php

namespace Baubyte\Cli\Commands;

use Baubyte\App;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeController extends Command {
    /**
     * @inheritDoc
     */
    protected static $defaultName = "make:controller";
    /**
     * @inheritDoc
     */
    protected static $defaultDescription = "Crear un nuevo Controlador.";

    /**
     * @inheritDoc
    */
    protected function configure() {
        $this->addArgument("name", InputArgument::REQUIRED, "Nombre del Controlador");
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        $name = $input->getArgument("name");

        $template = str_replace("ControllerName", $name, template("controller"));
        file_put_contents(App::$root.DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."Controllers".DIRECTORY_SEPARATOR."{$name}.php", $template);
        $output->writeln("<info>Controlador Creado => {$name}</info>");

        return Command::SUCCESS;
    }
}

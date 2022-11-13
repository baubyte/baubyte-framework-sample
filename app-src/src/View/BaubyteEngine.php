<?php

namespace Baubyte\View;

/**
 *  Baubyte template engine.
 */
class BaubyteEngine implements View {
    /**
     * Directory where the views are located.
     *
     * @var string
     */
    protected string $viewsDirectory;

    public function __construct(string $viewsDirectory) {
        $this->viewsDirectory = $viewsDirectory;
    }
    /**
     * @inheritDoc
     */
    public function render(string $view): string {
        $phpFile = "{$this->viewsDirectory}/{$view}.php";
        ob_start();
        include_once $phpFile;
        return ob_get_clean();
    }
}

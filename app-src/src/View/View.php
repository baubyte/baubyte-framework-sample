<?php

namespace Baubyte\View;

/**
 * View template render
 */
interface View {
    /**
     * Render given view passing `$params` and using `$layout`.
     *
     * @param string $view
     * @return string
     */
    public function render(string $view): string;
}

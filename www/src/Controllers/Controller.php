<?php

namespace Src\Controllers;

use Slim\Views\PhpRenderer;

class Controller
{
    public function __construct(
        protected PhpRenderer $renderer
    )
    {
        $this->setLayout();
    }

    protected function setLayout() : void
    {
        $this->renderer->setLayout('layout.php');
    }

}
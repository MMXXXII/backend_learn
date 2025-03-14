<?php
require_once "TwigBaseController.php"; // импортим TwigBaseController

class WindowsController extends TwigBaseController {

    public $template = "__object.twig";
    public $title = "Windows 11";

    public function getContext() : array {
        $context = parent::getContext();
        $context['base_url'] = '/windows';
        return $context;
    }
    
}
<?php
require_once "TwigBaseController.php"; // импортим TwigBaseController

class LinuxController extends TwigBaseController {
    public $title = "Linux Ubuntu";
    public $template = "__object.twig";


    public function getContext() : array {
        $context = parent::getContext();
        $context['base_url'] = '/linux';

        return $context;
    }
    
}
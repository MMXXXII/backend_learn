<?php
require_once "LinuxController.php"; // импортим TwigBaseController

class LinuxImageController extends LinuxController {
    public $template = "image.twig";


    public function getContext() : array {

        $context = parent::getContext();
        $context['image'] = "/images/Ubuntu_logo.svg";
        return $context;
    }
    
}
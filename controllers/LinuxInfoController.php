<?php
require_once "LinuxInfoController.php"; // импортим TwigBaseController

class LinuxInfoController extends LinuxController {
    public $template = "linux_info.twig";


    public function getContext() : array {

        $context = parent::getContext();
        $context['template'] = "linux_info.twig";
        $context['active_page'] = 'info';
        return $context;
    }
    
}
<?php
require_once "WindowsInfoController.php"; // импортим TwigBaseController

class WindowsInfoController extends WindowsController {
    public $template = "windows_info.twig";


    public function getContext() : array {

        $context = parent::getContext();
        $context['template'] = "windows_info.twig";
        $context['active_page'] = 'info';
        return $context;
    }
    
}
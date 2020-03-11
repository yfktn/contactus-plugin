<?php namespace yfktn\ContactUs\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class ContactUs extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController'    ];
    
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = [
        'yfktn.contact_us.manage' 
    ];
    
    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('yfktn.ContactUs', 'main-menu-contactus');
    }
}

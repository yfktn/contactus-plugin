<?php namespace yfktn\ContactUs;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{

    public function registerComponents()
    {
        return [
            '\Yfktn\ContactUs\Components\ContactUs' => 'contactUs'
        ];
    }

    public function registerSettings()
    {
    }
}

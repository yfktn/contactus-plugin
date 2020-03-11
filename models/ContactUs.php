<?php namespace yfktn\ContactUs\Models;

use Model;

/**
 * Model
 */
class ContactUs extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'yfktn_contactus_';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}

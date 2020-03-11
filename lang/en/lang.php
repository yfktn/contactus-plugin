<?php return [
    'plugin' => [
        'name' => 'Contact Us',
        'description' => 'To gave you simple contact us form, for our users.',
    ],
    'column' => [
        'perm_manage_label' => 'Contact Us Manage',
        'list_author' => 'Author',
        'list_comment' => 'Comment',
        'list_created_at' => 'Created',
        'list_flagged' => 'Flagged',
        'list_ip' => 'IP'
    ],
    'menu' => [
        'main_menu' => 'Contact Us',
    ],
    'components' => [
        'contact_us_title' => 'Contact Us Form',
        'contact_us_description' => 'Show contact us form'
    ],
    'ui' => [
        'error_token_security' => 'Security Token FAILED! Please refresh the page!',
        'error_throttle' => 'Maximum post from the same network exceeded.',
        'error_save' => 'Ups something bad happen in our side, please try it later!'
    ]
];
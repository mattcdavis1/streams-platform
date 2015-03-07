<?php

return [
    [
        'section' => 'tabbed',
        'tabs'    => [
            'general' => [
                'title'  => 'streams::tab.general',
                'fields' => [
                    'name',
                    'description',
                    'date_format',
                    'default_locale',
                    'site_enabled',
                    '503_message',
                    'ip_whitelist',
                    'force_https'
                ]
            ],
            'email'   => [
                'title'  => 'streams::tab.email',
                'fields' => [
                    'contact_email',
                    'server_email',
                    'mail_driver',
                    'smtp_host',
                    'smtp_port',
                    'smtp_username',
                    'smtp_password',
                    'mail_debug'
                ]
            ]
        ]
    ]
];
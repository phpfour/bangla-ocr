<?php

return [

    /**
     * Google App Name
     */
    'app_name' => 'Bangla OCR',

    /**
     * API credential file
     */
    'client_secret_path' => config_path('client_secret.json'),

    /**
     * Authentication scopes
     */
    'scopes' => implode(' ', [
        Google_Service_Drive::DRIVE,
        Google_Service_Oauth2::USERINFO_EMAIL,
        Google_Service_Oauth2::USERINFO_PROFILE
    ])

];
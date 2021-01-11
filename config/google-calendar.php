<?php

return [

    'default_auth_profile' => env('app/storage/json/moonlit-casing-301406-1ecf18fc1f64.json'),

    'auth_profiles' => [

        /*
         * Authenticate using a service account.
         */
        'service_account' => [
            /*
             * Path to the json file containing the credentials.
             */
            'credentials_json' => storage_path('app/storage/json/moonlit-casing-301406-1ecf18fc1f64.json'),
        ],

        /*
         * Authenticate with actual google user account.
         */
        'oauth' => [
            /*
             * Path to the json file containing the oauth2 credentials.
             */
            'credentials_json' => storage_path('app/storage/json/moonlit-casing-301406-1ecf18fc1f64.json'),

            /*
             * Path to the json file containing the oauth2 token.
             */
            'token_json' => storage_path('app/storage/json/moonlit-casing-301406-1ecf18fc1f64.json'),
        ],
    ],

    /*
     *  The id of the Google Calendar that will be used by default.
     */
    'calendar_id' => env('GOOGLE_CALENDAR_ID'),
];

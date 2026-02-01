<?php

declare(strict_types=1);

return [
    "postmark" => [
        "key" => env("POSTMARK_API_KEY"),
    ],

    "resend" => [
        "key" => env("RESEND_API_KEY"),
    ],

    "ses" => [
        "key" => env("AWS_ACCESS_KEY_ID"),
        "secret" => env("AWS_SECRET_ACCESS_KEY"),
        "region" => env("AWS_DEFAULT_REGION", "us-east-1"),
    ],

    "slack" => [
        "notifications" => [
            "bot_user_oauth_token" => env("SLACK_BOT_USER_OAUTH_TOKEN"),
            "channel" => env("SLACK_BOT_USER_DEFAULT_CHANNEL"),
        ],
    ],

    "tmdb" => [
        "key" => env("TMDB_API_KEY"),
        "read_access_token" => env("TMDB_READ_ACCESS_TOKEN"),
        "endpoint" => env("TMDB_API_ENDPOINT"),
        "movie_limit" => 50,
        "serie_limit" => 10,
    ],
];

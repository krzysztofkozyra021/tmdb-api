<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class FetchException extends Exception
{
    public function __construct(
        string $message = "TMDB API request failed",
        int $statusCode = 502,
    ) {
        parent::__construct($message, $statusCode);
    }
}

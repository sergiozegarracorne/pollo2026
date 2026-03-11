<?php

namespace Config;

use App\Filters\AuthRoleFilter;
use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseFilters
{
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'authRole'      => AuthRoleFilter::class,
    ];

    public array $globals = [
        'before' => [],
        'after'  => [
            'toolbar',
        ],
    ];

    public array $methods = [];
    public array $filters = [];
}

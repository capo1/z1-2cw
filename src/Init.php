<?php


namespace App;

use App\Bundle\Framework\ClearWordpress;
use App\Bundle\Framework\EnqueueScripts;
use App\Bundle\Framework\EnqueueStyles;
use App\Bundle\Framework\WordpressActions;

use App\Bundle\Framework\WpJson;

final class Init
{
    private static function init(): array
    {
        return [         
            ClearWordpress::class,
            EnqueueScripts::class,
            EnqueueStyles::class,
            WordpressActions::class,
            WpJson::class
        ];
    }

    public static function register(): void
    {
        foreach (self::init() as $class) {
            $service = new $class();
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }
}

<?php

use wcf\event\leaflet\UrlTemplateCollecting;
use wcf\system\event\EventHandler;

return static function (): void {
    EventHandler::getInstance()->register(
        UrlTemplateCollecting::class,
        static function (UrlTemplateCollecting $event) {
            $event->register('key', 'somerandomurl');
        }
    );
};

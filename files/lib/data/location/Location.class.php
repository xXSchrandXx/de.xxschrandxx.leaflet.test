<?php

namespace wcf\data\location;

use wcf\data\DatabaseObject;
use wcf\data\ITitledObject;
use wcf\system\html\output\HtmlOutputProcessor;

/**
 * @property-read int $locationID
 * @property-read string $title
 * @property-read string $latitude
 * @property-read string $longitude
 * @property-read string $dialog
 * @property-read string $infoWindow
 */
class Location extends DatabaseObject implements ITitledObject
{
    /**
     * @inheritDoc
     */
    protected static $databaseTableName = 'locations';

    /**
     * @inheritDoc
     */
    protected static $databaseTableIndexName = 'locationID';

    /**
     * @inheritDoc
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    public function getLat(): float
    {
        return $this->latitude;
    }

    public function getLng(): float
    {
        return $this->longitude;
    }

    public function getDialog(): string
    {
        $htmlProcessor = new HtmlOutputProcessor();
        $htmlProcessor->process(
            $this->dialog,
            'de.xxschrandxx.leaflet.test',
            $this->getObjectID()
        );
        return $htmlProcessor->getHtml();
    }
}

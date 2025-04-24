<?php

namespace wcf\page;

use wcf\data\location\Location;
use wcf\data\location\LocationList;

class LeafletListPage extends MultipleLinkPage
{
    /**
     * @inheritDoc
     */
    public $objectListClassName = LocationList::class;

    /**
     * @inheritDoc
     */
    public $sortOrder = 'ASC';

    /**
     * @inheritDoc
     */
    public function __run()
    {
        $this->sortField = Location::getDatabaseTableIndexName();
        parent::__run();
    }
}

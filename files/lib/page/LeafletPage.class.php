<?php

namespace wcf\page;

use wcf\data\location\Location;
use wcf\system\exception\IllegalLinkException;
use wcf\system\WCF;

class LeafletPage extends AbstractPage
{
    /**
     * @var Location
     */
    public $object;

    /**
     * @inheritDoc
     */
    public function readParameters()
    {
        parent::readParameters();

        if (isset($_REQUEST['id']) && \is_numeric($_REQUEST['id'])) {
            $this->object = new Location((int)$_REQUEST['id']);
        }

        if (!isset($this->object) || !$this->object->getObjectID()) {
            throw new IllegalLinkException();
        }
    }

    /**
     * @inheritDoc
     */
    public function assignVariables()
    {
        parent::assignVariables();
        WCF::getTPL()->assign([
            'object' => $this->object
        ]);
    }
}

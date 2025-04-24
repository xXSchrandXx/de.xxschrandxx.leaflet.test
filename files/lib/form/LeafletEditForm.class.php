<?php

namespace wcf\form;

use wcf\data\location\Location;
use wcf\system\exception\IllegalLinkException;

class LeafletEditForm extends LeafletAddForm
{
    /**
     * @inheritDoc
     */
    public $formAction = 'edit';

    /**
     * @inheritDoc
     */
    public function readParameters()
    {
        parent::readParameters();

        $locationID = 0;
        if (isset($_REQUEST['id'])) {
            $locationID = (int)$_REQUEST['id'];
        }
        $this->formObject = new Location($locationID);
        if (!$this->formObject->locationID) {
            throw new IllegalLinkException();
        }
    }
}

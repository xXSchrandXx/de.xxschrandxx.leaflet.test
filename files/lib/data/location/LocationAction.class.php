<?php

namespace wcf\data\location;

use wcf\data\AbstractDatabaseObjectAction;

class LocationAction extends AbstractDatabaseObjectAction
{
    /**
     * @inheritDoc
     */
    protected $className = LocationEditor::class;

    /**
     * @inheritDoc
     */
    protected $allowGuestAccess = ['getMapMarkers'];

    public function validateGetMapMarkers()
    {
    }

    /**
     * @return array
     * Array of MarkerData
     * format MarkerData = [
     *   'dialog'?    => string;
     *   'infoWindow' => string;
     *   'items'      => number;
     *   'latitude'   => number;
     *   'location'   => string;
     *   'longitude'  => number;
     *   'objectIDs'? => number[];
     *   'objectID'?  => number;
     *   'title'      => string;
     * ];
     */
    public function getMapMarkers()
    {
        $markers = [];
        $locationList = new LocationList();
        if (isset($this->parameters['excludedObjectIDs']) && !empty($this->parameters['excludedObjectIDs'])) {
            $locationList->getConditionBuilder()->add('locationID NOT IN (?)', [$this->parameters['excludedObjectIDs']]);
        }
        if (isset($this->parameters['eastLongitude']) &&
            isset($this->parameters['westLongitude']) &&
            isset($this->parameters['northLatitude']) &&
            isset($this->parameters['southLatitude'])
        ) {
            $locationList->getConditionBuilder()->add('longitude <= ? AND longitude >= ? AND latitude <= ? AND latitude >= ?', [
                $this->parameters['eastLongitude'],
                $this->parameters['westLongitude'],
                $this->parameters['northLatitude'],
                $this->parameters['southLatitude']
            ]);
        }
        $locationList->readObjects();
        foreach ($locationList as $locationID => $location) {
            $markerdata = [
                'objectID' => $location->getObjectID(),
                'title' => $location->getTitle(),
                'latitude' => $location->getLat(),
                'longitude' => $location->getLng(),
            ];
            if (isset($location->infoWindow)) {
                $markerdata['infoWindow'] = $location->infoWindow;
            }
            if (isset($location->dialog)) {
                $markerdata['dialog'] = $location->getDialog();
            }
            $markers[] = $markerdata;
        }
        return ['markers' => $markers];
    }
}

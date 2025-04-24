<?php

use wcf\system\database\table\column\FloatDatabaseTableColumn;
use wcf\system\database\table\column\ObjectIdDatabaseTableColumn;
use wcf\system\database\table\column\TextDatabaseTableColumn;
use wcf\system\database\table\column\VarcharDatabaseTableColumn;
use wcf\system\database\table\DatabaseTable;
use wcf\system\database\table\index\DatabaseTablePrimaryIndex;

return [
    DatabaseTable::create('wcf1_locations')
        ->columns([
            ObjectIdDatabaseTableColumn::create('locationID'),
            VarcharDatabaseTableColumn::create('title')
                ->length(20),
            FloatDatabaseTableColumn::create('latitude'),
            FloatDatabaseTableColumn::create('longitude'),
            TextDatabaseTableColumn::create('infoWindow'),
            TextDatabaseTableColumn::create('dialog')
        ])
        ->indices([
            DatabaseTablePrimaryIndex::create()
                ->columns(['locationID']),
        ])
];

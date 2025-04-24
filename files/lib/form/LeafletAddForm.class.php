<?php

namespace wcf\form;

use wcf\data\IStorableObject;
use wcf\data\location\LocationAction;
use wcf\system\exception\SystemException;
use wcf\system\form\builder\container\FormContainer;
use wcf\system\form\builder\data\processor\CustomFormDataProcessor;
use wcf\system\form\builder\field\LeafletFormField;
use wcf\system\form\builder\field\TextFormField;
use wcf\system\form\builder\field\TitleFormField;
use wcf\system\form\builder\field\wysiwyg\WysiwygFormField;
use wcf\system\form\builder\IFormDocument;
use wcf\util\JSON;

class LeafletAddForm extends AbstractFormBuilderForm
{
    /**
     * @inheritDoc
     */
    public $objectActionClass = LocationAction::class;

    /**
     * @inheritDoc
     */
    public $objectEditLinkController = LeafletEditForm::class;

    /**
     * @inheritDoc
     */
    protected function createForm()
    {
        parent::createForm();

        $this->form->appendChild(
            FormContainer::create('data')
                ->appendChildren([
                    TitleFormField::create()
                        ->required(),
                    LeafletFormField::create('value')
                        ->required(),
                    TextFormField::create('infoWindow'),
                    WysiwygFormField::create('dialog')
                        ->objectType('de.xxschrandxx.leaflet.test')
                ])
        );
        $this->form->getDataHandler()->addProcessor(new CustomFormDataProcessor('value',
            function (IFormDocument $form, array $parameters) {
                try {
                    $latlng = JSON::decode($parameters['data']['value']);
                    unset($parameters['data']['value']);
                    $parameters['data']['latitude'] = $latlng['lat'];
                    $parameters['data']['longitude'] = $latlng['lng'];
                } catch (SystemException $e) {
                    // should not happen, validated in LeafletFormField::validate()
                }
                return $parameters;
            },
            function (IFormDocument $form, array $data, IStorableObject $object) {
                $data['value'] = JSON::encode([
                    'lat' => $object->latitude,
                    'lng' => $object->longitude
                ]);
                unset($data['data']['latitude']);
                unset($data['data']['longitude']);
                return $data;
            }
        ));
    }
}

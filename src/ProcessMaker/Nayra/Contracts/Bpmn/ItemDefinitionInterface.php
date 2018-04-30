<?php

namespace ProcessMaker\Nayra\Contracts\Bpmn;

/**
 * An ItemDefinition is used to define the payload of the Message.
 *
 * @package ProcessMaker\Nayra\Bpmn
 */
interface ItemDefinitionInterface
{
    const BPMN_PROPERTY_ID = 'id';
    const BPMN_PROPERTY_ITEM_KIND = 'itemKind';
    const BPMN_PROPERTY_STRUCTURE = 'structure';
    const BPMN_PROPERTY_IS_COLLECTION = 'isCollection';

    const ITEM_KIND_PHYSICAL = 'physical';
    const ITEM_KIND_INFORMATION = 'information';

    /**
     * Get the nature of the Item. Possible values are physical
     * or information.
     *
     * @return string
     */
    public function getItemKind();

    /**
     * Get the concrete data structure to be used.
     *
     * @return mixed
     */
    public function getStructure();

    /**
     * Get true if the data structure represents a collection.
     *
     * @return boolean
     */
    public function isCollection();
}

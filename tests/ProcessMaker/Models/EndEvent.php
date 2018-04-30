<?php

namespace ProcessMaker\Models;

use ProcessMaker\Nayra\Bpmn\EndEventTrait;
use ProcessMaker\Nayra\Contracts\Bpmn\EndEventInterface;

/**
 * End event implementation.
 *
 * @package ProcessMaker\Models
 */
class EndEvent implements EndEventInterface
{

    use EndEventTrait,
        LocalFlowNodeTrait,
        LocalProcessTrait,
        LocalPropertiesTrait;

    /**
     * Array map of custom event classes for the bpmn element.
     *
     * @return array
     */
    protected function getBpmnEventClasses()
    {
        return [];
    }
}

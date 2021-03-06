<?php

namespace ProcessMaker\Nayra\Bpmn;

use ProcessMaker\Nayra\Contracts\Bpmn\CatchEventInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\EventDefinitionInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\TokenInterface;
use ProcessMaker\Nayra\Contracts\Engine\EngineInterface;
use ProcessMaker\Nayra\Contracts\Engine\ExecutionInstanceInterface;

/**
 * Base implementation for a exclusive gateway.
 *
 * @package ProcessMaker\Nayra\Bpmn
 */
trait EventDefinitionTrait
{
    use BaseTrait;

    /**
     * Register event with a catch event
     *
     * @param EngineInterface $engine
     * @param CatchEventInterface $element
     */
    public function registerWithCatchEvent(EngineInterface $engine, CatchEventInterface $element)
    {
        $engine->getEventDefinitionBus()->registerCatchEvent($element, $this, function (EventDefinitionInterface $eventDefinition, ExecutionInstanceInterface $instance = null, TokenInterface $token = null) use ($element) {
            $element->execute($eventDefinition, $instance, $token);
        });
    }
}

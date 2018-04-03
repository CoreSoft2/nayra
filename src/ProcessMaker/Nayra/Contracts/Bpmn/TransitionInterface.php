<?php

namespace ProcessMaker\Nayra\Contracts\Bpmn;

use ProcessMaker\Nayra\Contracts\Engine\ExecutionInstanceInterface;

/**
 * Rule that defines if a flow node can be transit.
 *
 * @package ProcessMaker\Nayra\Contracts\Bpmn
 */
interface TransitionInterface extends ConnectionNodeInterface
{
    const EVENT_BEFORE_TRANSIT = 'BeforeTransit';
    const EVENT_AFTER_TRANSIT = 'AfterTransit';

    /**
     * Execute a transition.
     *
     * @return bool
     */
    public function execute(ExecutionInstanceInterface $executionInstance);

}
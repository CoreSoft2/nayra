<?php

namespace ProcessMaker\Nayra\Bpmn;


use ProcessMaker\Nayra\Contracts\Bpmn\ConnectionNodeInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\TransitionInterface;

/**
 * Transition rule for a inclusive gateway.
 *
 * @package ProcessMaker\Nayra\Bpmn
 */
class InclusiveGatewayTransition implements TransitionInterface
{

    use TransitionTrait;

    /**
     * Always true because the conditions are not defined in the gateway, but for each
     * outgoing flow transition.
     *
     * @return bool
     */
    protected function assertCondition()
    {
        return true;
    }

    /**
     * The Inclusive Gateway has all the required tokens if
     *   • At least one incoming Sequence Flow has at least one token and
     *   • For every directed path formed by sequence flow that
     *     - starts with a Sequence Flow f of the diagram that has a token,
     *     - ends with an incoming Sequence Flow of the inclusive gateway that has no token, and
     *     - does not visit the Inclusive Gateway.
     *   • There is also a directed path formed by Sequence Flow that - starts with f,
     *     - ends with an incoming Sequence Flow of the inclusive gateway that has a token, and
     *     - does not visit the Inclusive Gateway.
     *
     * @return bool
     */
    protected function hasAllRequiredTokens()
    {
        $withToken = $this->incoming()->find(function(Connection $flow){
            return $flow->originState()->getTokens()->count()>0;
        });
        $withoutToken = $this->incoming()->find(function(Connection $flow){
            return $flow->originState()->getTokens()->count()===0;
        });
        $rule1 = $withToken->count()>0;
        $rule2 = $withoutToken->find(function($inFlow) {
                $paths = $inFlow->origin()->paths(function(Connection $flow) use ($inFlow) {
                    return $flow!==$inFlow
                        && $flow->originState()->getTokens()->count()>0;
                }, function (Connection $flow) {
                    return $flow->origin()!==$this; //does not visit
                });
                return $paths->count()!==0;
            })->count()===0;
        $rule3 = $withToken->find(function($inFlow) {
                return $inFlow->origin()->paths(function(Connection $flow) use ($inFlow) {
                        return $flow!==$inFlow
                            && $flow->originState()->getTokens()->count()>0;
                    }, function (Connection $flow) {
                        return $flow->origin()!==$this; //does not visit
                    })->count()!==0;
            })->count()===0;
        return $rule1 && $rule2 && $rule3;
    }
}
<?php

namespace ADR\Bundle\Symfony2ErlangBundle\Service\Encoder;

Class PebFormatter
{
    /**
     * Format array structure to acomplish
     * peb method specifications
     *
     * @param string $functionName Ets Method
     * @param  array  $params
     * @return array (format Structure, parameters)
     */
    public function getArgumentsStructure($functionName, array $params)
    {
        $validFunctionNames = array('insert', 'lookup', 'delete', 'info');
        if (!in_array($functionName, $validFunctionNames)) {
            throw new \Exception('Invalid method!');
        }
        return $this->$functionName($params);
    }

    protected function insert(array $params)
    {
         return array("[~a, {~a, ~s}]", $params);
    }

    protected function lookup(array $params)
    {
        return array("[~a, ~a]", $params);
    }

    protected function delete(array $params)
    {
        return array("[~a, ~a]", $params);
    }

    protected function info(array $params)
    {
        return array("[~a]", $params);
    }

}
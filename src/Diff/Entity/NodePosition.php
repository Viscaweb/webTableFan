<?php

namespace Visca\WebTableFan\Diff\Entity;

/**
 * Class NodePosition.
 */
class NodePosition
{
    const AFTER = 'after';
    const APPEND = 'append';
    const PREPEND = 'prepend';

    /** @var string */
    private $locationId;

    /** @var string */
    private $injectionMethod;

    /**
     * NodePosition constructor.
     *
     * @param string $locationId
     * @param string $injectionMethod
     */
    public function __construct($locationId, $injectionMethod)
    {
        $this->locationId = $locationId;
        $this->injectionMethod = $injectionMethod;
    }

    /**
     * @return string
     */
    public function getLocationId()
    {
        return $this->locationId;
    }

    /**
     * @return string
     */
    public function getInjectionMethod()
    {
        return $this->injectionMethod;
    }
}

<?php

namespace Visca\WebTableFan\Entity;

use Visca\Bundle\LicomBundle\Events\Event;
use Visca\WebTableFan\Entity\Code\HtmlAttributes;

/**
 * Class TableNode.
 */
class TableNode extends Node
{
    /** @var string[] */
    private $colGroup;

    /** @var Event[] */
    private $events;

    /**
     * TableNode constructor.
     *
     * @param string  $id
     * @param array   $attributes
     * @param array   $children
     * @param Event[] $events
     */
    public function __construct($id, array $attributes = [], array $children = [], $events = [])
    {
        $this->setType('table');
        $attributes[HtmlAttributes::MARKUPID] = $id;
        $this->events = $events;

        parent::__construct($id, $attributes, $children);
    }

    /**
     * @return
     */
    public function getListeningEvents()
    {
        return $this->events;
    }

    /**
     * @return string[]
     */
    public function getColGroup()
    {
        return $this->colGroup;
    }

    /**
     * @param string[] $colGroup
     *
     * @return $this
     */
    public function setColGroup($colGroup)
    {
        $this->colGroup = $colGroup;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->getTreeHash();
    }
}

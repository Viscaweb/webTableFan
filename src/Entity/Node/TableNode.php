<?php

declare(strict_types=1);

namespace Visca\WebTableFan\Entity\Node;

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
    public function __construct(string $id, array $attributes = [], array $children = [], $events = [])
    {
        parent::__construct($id, $attributes, $children);
        $this->setType('table');
        $attributes[HtmlAttributes::MARKUPID] = $id;
        $this->events = $events;
        $this->colGroup = [];
    }

    /**
     * @return array|Event[]
     */
    public function getListeningEvents(): array
    {
        return $this->events;
    }

    /**
     * @return string[]
     */
    public function getColGroup(): array
    {
        return $this->colGroup;
    }

    /**
     * @param string[] $colGroup
     *
     * @return self
     */
    public function setColGroup($colGroup): self
    {
        $this->colGroup = $colGroup;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->getTreeHash();
    }
}

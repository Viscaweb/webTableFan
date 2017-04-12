<?php

namespace Visca\WebTableFan\Events;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class TableRenderedEvent.
 */
class TableRenderedEvent extends Event
{
    /** @var string */
    private $tableId;

    /** @var string */
    private $tableRendered;

    /** @var string */
    private $tableVersion;

    /**
     * TableRenderedEvent constructor.
     *
     * @param string $tableId
     * @param string $tableVersion
     * @param string $tableRendered
     */
    public function __construct($tableId, $tableVersion, $tableRendered)
    {
        $this->tableId = $tableId;
        $this->tableVersion = $tableVersion;
        $this->tableRendered = $tableRendered;
    }

    /**
     * @return string
     */
    public function getTableId()
    {
        return $this->tableId;
    }

    /**
     * @return string
     */
    public function getTableRendered()
    {
        return $this->tableRendered;
    }

    /**
     * @return string
     */
    public function getTableVersion()
    {
        return $this->tableVersion;
    }
}

<?php

declare(strict_types=1);

namespace Visca\WebTableFan\Diff\Entity;

class NodeDifferences
{
    /** @var string */
    protected $beforeTableId;

    /** @var string */
    protected $afterTableId;

    /** @var NodeUpdated[] */
    protected $updated;

    /** @var NodeAdded[] */
    protected $added;

    /** @var NodeDeleted[] */
    protected $deleted;

    /**
     * NodeDifferences constructor.
     *
     * @param string        $tableAId
     * @param string        $tableBId
     * @param NodeAdded[]   $updated
     * @param NodeUpdated[] $added
     * @param NodeDeleted[] $deleted
     */
    public function __construct(string $tableAId, string $tableBId, array $updated = [], array $added = [], array $deleted = [])
    {
        $this->beforeTableId = $tableAId;
        $this->afterTableId = $tableBId;
        $this->updated = $updated;
        $this->added = $added;
        $this->deleted = $deleted;
    }

    /**
     * @return NodeUpdated[]
     */
    public function getUpdated(): array
    {
        return $this->updated;
    }

    /**
     * @return NodeAdded[]
     */
    public function getAdded(): array
    {
        return $this->added;
    }

    /**
     * @return NodeDeleted[]
     */
    public function getDeleted(): array
    {
        return $this->deleted;
    }

    /**
     * @return string
     */
    public function getAfterTableId(): string
    {
        return $this->afterTableId;
    }
}

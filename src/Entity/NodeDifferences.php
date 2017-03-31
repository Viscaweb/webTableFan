<?php

namespace Visca\WebTableFan\Entity;

class NodeDifferences
{
    /** @var Node[] */
    protected $updated;

    /** @var Node[] */
    protected $added;

    /** @var Node[] */
    protected $deleted;

    /**
     * NodeDifferences constructor.
     *
     * @param Node[] $updated
     * @param Node[] $added
     * @param Node[] $deleted
     */
    public function __construct(array $updated = [], array $added = [], array $deleted = [])
    {
        $this->updated = $updated;
        $this->added = $added;
        $this->deleted = $deleted;
    }

    /**
     * @return Node[]
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @return Node[]
     */
    public function getAdded()
    {
        return $this->added;
    }

    /**
     * @return Node[]
     */
    public function getDeleted()
    {
        return $this->deleted;
    }
}

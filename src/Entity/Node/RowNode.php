<?php

namespace Visca\WebTableFan\Entity\Node;

/**
 * Class RowNode.
 */
class RowNode extends Node
{
    /**
     * RowNode constructor.
     *
     * @param string          $id
     * @param array|\string[] $attributes
     * @param array|Node[]    $children
     */
    public function __construct(
        $id,
        array $attributes = [],
        array $children = []
    ) {
        $this->type = 'tr';

        parent::__construct($id, $attributes, $children);
    }
}

<?php

declare(strict_types=1);

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
        string $id,
        array $attributes = [],
        array $children = []
    ) {
        parent::__construct($id, $attributes, $children);
        $this->type = 'tr';
    }
}

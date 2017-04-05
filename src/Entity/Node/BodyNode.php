<?php

namespace Visca\WebTableFan\Entity\Node;

use Visca\WebTableFan\Entity\Code\HtmlAttributes;

/**
 * Class BodyNode.
 */
class BodyNode extends Node
{
    /**
     * {@inheritdoc}
     */
    public function __construct(
        $id,
        array $attributes = [],
        array $children = []
    ) {
        $this->setType('tbody');
        $attributes[HtmlAttributes::MARKUPID] = $id;

        parent::__construct($id, $attributes, $children);
    }
}
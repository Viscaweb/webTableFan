<?php

declare(strict_types=1);

namespace Visca\WebTableFan\Entity\Node;

use Visca\WebTableFan\Entity\Code\BodyTypes;
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
        string $id,
        array $attributes = [],
        array $children = []
    ) {
        parent::__construct($id, $attributes, $children);
        $this->setType(BodyTypes::TBODY);
        $attributes[HtmlAttributes::MARKUPID] = $id;
    }
}

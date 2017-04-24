<?php

declare(strict_types=1);

namespace Visca\WebTableFan\Entity\Node;

use Visca\WebTableFan\Entity\Code\HtmlAttributes;

/**
 * Class CellNode.
 */
class CellNode extends Node
{
    /** @var string */
    protected $content;

    /**
     * CellNode constructor.
     *
     * @param string $id
     * @param array  $attributes
     * @param array  $children     @todo Consider remove $children. Never had to inject children in a CellNode
     */
    public function __construct(string $id, array $attributes = [], array $children = [])
    {
        $this->setType('td');
        $attributes[HtmlAttributes::MARKUPID] = $id;

        parent::__construct($id, $attributes, $children);
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return CellNode
     */
    public function setContent(string $content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return md5($this->getContent());
    }
}

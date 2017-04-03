<?php

namespace Visca\WebTableFan\Entity;

use Visca\Bundle\SportBundle\Model\TableSystem\Nodes\Traits\MobileCheckerTrait;
use Visca\WebTableFan\Entity\Code\HtmlAttributes;

/**
 * Class CellNode.
 */
class CellNode extends Node
{
    use MobileCheckerTrait;

    /**
     * @var string
     */
    protected $content;

    /**
     * CellNode constructor.
     *
     * @param string $id
     * @param array  $attributes
     * @param array  $children
     */
    public function __construct($id, array $attributes = [], array $children = [])
    {
        $this->setType('td');
        $attributes[HtmlAttributes::MARKUPID] = $id;

        parent::__construct($id, $attributes, $children);
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return CellNode
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return md5($this->getContent());
    }
}

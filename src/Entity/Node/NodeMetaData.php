<?php

namespace Visca\WebTableFan\Entity\Node;

class NodeMetaData
{
    /** @var  string */
    private $type;
    /** @var  array */
    private $content;

    /**
     * @param string $type
     * @param array  $content
     */
    public function __construct($type, array $content)
    {
        $this->type = $type;
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getContent()
    {
        return $this->content;
    }
}

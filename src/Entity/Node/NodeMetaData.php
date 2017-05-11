<?php

declare(strict_types=1);

namespace Visca\WebTableFan\Entity\Node;

class NodeMetaData
{
    /** @var string */
    private $type;

    /** @var array */
    private $content;

    /**
     * @param string $type
     * @param array  $content
     */
    public function __construct(string $type, array $content)
    {
        $this->type = $type;
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getContent(): array
    {
        return $this->content;
    }
}

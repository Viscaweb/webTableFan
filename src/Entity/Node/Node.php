<?php

declare(strict_types=1);

namespace Visca\WebTableFan\Entity\Node;

use Visca\WebTableFan\Entity\Code\HtmlAttributes;

/** Class Node. */
class Node implements Comparable, Listening, Searchable
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $type;

    /** @var string[] */
    protected $attributes;

    /** @var bool */
    protected $mobile;

    // ------------------------
    // Node Relations related
    // ------------------------

    /** @var Node[] */
    protected $children = [];

    /** @var Node|null */
    protected $leftSibling;

    /** @var Node|null */
    protected $rightSibling;

    /** @var string[] */
    protected $parentsIds;

    /** @var NodeMetaData|null */
    protected $meta;

    /** @var Node|null Parent node */
    private $parent;

    /**
     * @param string            $id         Node identifier.
     * @param string[]          $attributes Attributes list.
     * @param Node[]            $children   Children.
     * @param NodeMetaData|null $meta
     */
    public function __construct(
        string $id,
        array $attributes = [],
        array $children = [],
        NodeMetaData $meta = null
    ) {
        $this->id = $id;
        $this->attributes = $attributes;
        $this->meta = $meta;
        $this->mobile = false;
        $this->type = 'DIV';

        foreach ($children as $child) {
            $this->addChild($child);
        }

        $this->setDefaultAttributes();
    }

    /**
     * @return NodeMetaData|null
     */
    public function getMeta(): ?NodeMetaData
    {
        return $this->meta;
    }

    /**
     * @param NodeMetaData $meta
     */
    public function setMeta(NodeMetadata $meta)
    {
        $this->meta = $meta;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return \string[]
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param string $name  Attribute name
     * @param mixed  $value Attribute value
     *
     * @return $this
     */
    public function setAttribute(string $name, string $value)
    {
        $this->attributes[$name] = $value;

        return $this;
    }

    /**
     * @return Node[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @param Node $child Child node to insert.
     *
     * @return $this
     */
    public function addChild(self $child)
    {
        $child->setParent($this);

        $numChildren = count($this->children);

        if ($numChildren > 0) {
            $lastChild = $this->children[$numChildren - 1];
            $lastChild->setRightSibling($child);
            $child->setLeftSibling($lastChild);
        }

        $this->children[] = $child;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getHash(): string
    {
        $attributesCopy = $this->attributes;

        unset($attributesCopy['data-version']);

        return sprintf('%s-%s', $this->id, md5(serialize($this->attributes)));
    }

    /**
     * Calculates the hash of the children nodes, and rehashes it.
     *
     * @return string (32 bytes length)
     */
    public function getTreeHash(): string
    {
        $hash = $this->getHash();

        $children = $this->getChildren();
        foreach ($children as $child) {
            if ($child instanceof self) {
                $hash .= $child->getTreeHash();
            }
        }

        return md5($hash);
    }

    /**
     * @return bool
     */
    public function isRoot(): bool
    {
        return $this->parent === null;
    }

    /**
     * @return bool
     */
    public function isLeaf(): bool
    {
        return empty($this->children);
    }

    /**
     * @return bool
     */
    public function hasChildren(): bool
    {
        return !empty($this->children);
    }

    /**
     * @return null|Node
     */
    public function getParent(): ?self
    {
        return $this->parent;
    }

    /**
     * @return array
     */
    public function getParentIds(): array
    {
        if ($this->parentsIds === null) {
            $this->parentsIds = [];
            if (!$this->isRoot()) {
                $parent = $this->getParent();
                $this->parentsIds = array_merge(
                    $this->parentsIds,
                    $parent->getParentIds()
                );
                $this->parentsIds[$parent->getId()] = $parent->getId();
            }
        }

        return $this->parentsIds;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return bool
     */
    public function isMobile(): bool
    {
        return $this->mobile;
    }

    /**
     * @param bool $mobile
     *
     * @return Node
     */
    public function setMobile(bool $mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return count($this->getParentIds());
    }

    /**
     * @return Event[]
     */
    public function getListeningEvents(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function findById($id): self
    {
        if ($this->id === $id) {
            return $this;
        }

        foreach ($this->getChildren() as $child) {
            if (($node = $child->findById($id)) !== null) {
                return $node;
            }
        }
    }

    /**
     * @param Node $parent Parent Node
     *
     * @return $this
     */
    protected function setParent(self $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Sets default values for attributes.
     */
    private function setDefaultAttributes()
    {
        $this->attributes[HtmlAttributes::MARKUPID] = $this->id;
    }

    /**
     * @return null|Node
     */
    public function getLeftSibling(): ?self
    {
        return $this->leftSibling;
    }

    /**
     * @return bool
     */
    public function hasLeftSibling(): bool
    {
        return $this->leftSibling !== null;
    }

    /**
     * @param null|Node $leftSibling
     *
     * @return Node
     */
    public function setLeftSibling(self $leftSibling = null)
    {
        $this->leftSibling = $leftSibling;

        return $this;
    }

    /**
     * @return null|Node
     */
    public function getRightSibling(): ?self
    {
        return $this->rightSibling;
    }

    /**
     * @param null|Node $rightSibling
     *
     * @return Node
     */
    public function setRightSibling(self $rightSibling = null)
    {
        $this->rightSibling = $rightSibling;

        return $this;
    }
}

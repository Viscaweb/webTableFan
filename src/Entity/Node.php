<?php

namespace Visca\WebTableFan\Entity;

/** Class Node. */
class Node implements Comparable, Listening, Searchable
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $type;

    /** @var string[] */
    protected $attributes;

    /** @var Node[] */
    protected $children = [];

    /** @var Node|null */
    protected $leftSibling;

    /** @var Node|null */
    protected $rightSibling;

    /** @var int */
    protected $position;

    /** @var  string[] */
    protected $parentsIds;

    /** @var  NodeMetaData|null */
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
        $id,
        array $attributes = [],
        array $children = [],
        NodeMetaData $meta = null
    ) {
        $this->id = $id;
        $this->attributes = $attributes;
        $this->meta = $meta;

        foreach ($children as $child) {
            $this->addChild($child);
        }

        $this->setDefaultAttributes();
    }

    /**
     * @return NodeMetaData|null
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @param NodeMetaData $meta
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \string[]
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param string $name  Attribute name
     * @param mixed  $value Attribute value
     *
     * @return $this
     */
    public function setAttribute($name, $value)
    {
        $this->attributes[$name] = $value;

        return $this;
    }

    /**
     * @return Node[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param Node $child Child node to insert.
     *
     * @return $this
     */
    public function addChild(Node $child)
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
    public function getHash()
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
    public function getTreeHash()
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
    public function isRoot()
    {
        return $this->parent === null;
    }

    /**
     * @return bool
     */
    public function isLeaf()
    {
        return empty($this->children);
    }

    /**
     * @return bool
     */
    public function hasChildren()
    {
        return !empty($this->children);
    }

    /**
     * @return null|Node
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return array
     */
    public function getParentIds()
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     */
    public function getContent()
    {
        return;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return count($this->getParentIds());
    }

    /**
     * @return Event[]
     */
    public function getListeningEvents()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function findById($id)
    {
        if ($this->id == $id) {
            return $this;
        }

        foreach ($this->getChildren() as $child) {
            if (($node = $child->findById($id)) !== null) {
                return $node;
            }
        }

        return;
    }

    /**
     * @param Node $parent Parent Node
     *
     * @return $this
     */
    protected function setParent(Node $parent)
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
    public function getLeftSibling()
    {
        return $this->leftSibling;
    }

    /**
     * @param null|Node $leftSibling
     *
     * @return Node
     */
    public function setLeftSibling($leftSibling)
    {
        $this->leftSibling = $leftSibling;

        return $this;
    }

    /**
     * @return null|Node
     */
    public function getRightSibling()
    {
        return $this->rightSibling;
    }

    /**
     * @param null|Node $rightSibling
     *
     * @return Node
     */
    public function setRightSibling($rightSibling)
    {
        $this->rightSibling = $rightSibling;

        return $this;
    }
}

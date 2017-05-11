<?php

namespace Visca\WebTableFan\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Visca\WebTableFan\Entity\Node\Node;

/**
 * Class NodeTest.
 */
class NodeTest extends TestCase
{
    /**
     * @test
     */
    public function when_adding_child_to_empty_tree_relations_should_be_properly_defined()
    {
        $parent = new Node(3);

        $childA = new Node('foo.child');
        $parent->addChild($childA);

        $this->assertEquals($parent, $childA->getParent());
        $this->assertEquals([], $childA->getChildren());
        $this->assertEquals(null, $childA->getLeftSibling());
        $this->assertEquals(null, $childA->getRightSibling());

        $this->assertEquals([$childA], $parent->getChildren());
    }

    /**
     * @test
     */
    public function when_adding_child_to_tree_relations_should_be_properly_defined()
    {
        $parent = new Node('foo');

        $childA = new Node('foo.child.a');
        $childB = new Node('foo.child.b');

        $parent->addChild($childA)->addChild($childB);

        $this->assertEquals($parent, $childA->getParent());
        $this->assertEquals([], $childA->getChildren());
        $this->assertEquals(null, $childA->getLeftSibling());
        $this->assertEquals($childB, $childA->getRightSibling());

        $this->assertEquals($parent, $childB->getParent());
        $this->assertEquals([], $childB->getChildren());
        $this->assertEquals($childA, $childB->getLeftSibling());
        $this->assertEquals(null, $childB->getRightSibling());

        $this->assertEquals([$childA, $childB], $parent->getChildren());
    }

    /**
     * @test
     */
    public function when_having_two_identicall_nodes_hash_should_be_the_same()
    {
        $node = new Node('foo.id', ['attribute' => 1, 'attribute2' => 2]);
        $nodeB = clone $node;

        $hash = $node->getHash();
        $hashB = $nodeB->getHash();
        $this->assertEquals(true, $hash === $hashB);
    }
}

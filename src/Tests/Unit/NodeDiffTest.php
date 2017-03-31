<?php

namespace Visca\WebTableFan\Tests\Unit;

use PHPUnit_Framework_TestCase;
use Visca\WebTableFan\Diff\NodeDiff;
use Visca\WebTableFan\Entity\Node;

/**
 * Class NodeDiffTest.
 */
class NodeDiffTest extends PHPUnit_Framework_TestCase
{
    /** @var NodeDiff */
    protected $nodeDiff;

    /**
     * @test
     */
    public function when_two_equal_nodes_are_compared_no_differences_are_found()
    {
        $child = new Node('child');

        $node = new Node('rootA');
        $node->addChild($child);

        $diff = $this->nodeDiff->diff($node, clone $node);

        $this->assertEquals([], $diff->getAdded());
        $this->assertEquals([], $diff->getUpdated());
        $this->assertEquals([], $diff->getDeleted());
    }

    /**
     * @test
     */
    public function when_a_node_has_an_extra_child_an_added_node_should_be_detected()
    {
        $node = new Node('rootA');

        $child = new Node('child');
        $nodeB = new Node('rootA');
        $nodeB->addChild($child);
        $nodeB->addChild($child);

        $diff = $this->nodeDiff->diff($node, $nodeB);

        $this->assertEquals(['child' => $child], $diff->getAdded());
        $this->assertEquals([], $diff->getUpdated());
        $this->assertEquals([], $diff->getDeleted());
    }

    /**
     * @test
     */
    public function when_a_node_has_two_new_depths_of_children_only_parent_node_should_be_added_to_added_list()
    {
        $node = new Node('rootA');


        $childLevel1 = new Node('child1');
        $childLevel0 = new Node('child0');
        $childLevel0->addChild($childLevel1);
        $nodeB = new Node('rootA');
        $nodeB->addChild($childLevel0);

        $diff = $this->nodeDiff->diff($node, $nodeB);

        $this->assertEquals(['child0' => $childLevel0], $diff->getAdded());
    }

    /**
     * @test
     */
    public function when_a_node_has_been_removed_a_deleted_node_should_be_detected()
    {
        $child = new Node('child');

        $node = new Node('rootA');
        $node->addChild($child);

        $nodeB = new Node('rootA');

        $diff = $this->nodeDiff->diff($node, $nodeB);

        $this->assertEquals([], $diff->getAdded());
        $this->assertEquals([], $diff->getUpdated());
        $this->assertEquals(['child' => $child], $diff->getDeleted());
    }

    /**
     * @test
     */
    public function when_a_child_has_been_changed_and_updated_node_should_be_detected()
    {
        $child = new Node('child');

        $node = new Node('rootA');
        $node->addChild($child);

        $childChanged = clone $child;
        $childChanged->setAttribute('class', 'hidden');
        $nodeB = new Node('rootA');
        $nodeB->addChild($childChanged);

        $diff = $this->nodeDiff->diff($node, $nodeB);

        $this->assertEquals([], $diff->getAdded());
        $this->assertEquals(['child' => $childChanged], $diff->getUpdated());
        $this->assertEquals([], $diff->getDeleted());
    }

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->nodeDiff = new NodeDiff();
    }
}

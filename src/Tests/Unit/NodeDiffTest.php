<?php

namespace Visca\WebTableFan\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Visca\WebTableFan\Diff\Entity\NodeAdded;
use Visca\WebTableFan\Diff\Entity\NodeDeleted;
use Visca\WebTableFan\Diff\Entity\NodeDifferences;
use Visca\WebTableFan\Diff\Entity\NodePosition;
use Visca\WebTableFan\Diff\Entity\NodeUpdated;
use Visca\WebTableFan\Diff\NodeDiff;
use Visca\WebTableFan\Entity\Node\Node;

/**
 * Class NodeDiffTest.
 */
class NodeDiffTest extends TestCase
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

        $this->assertDifferences([], [], [], $diff);
    }

    /**
     * @test
     */
    public function append_node_to_empty_tree_a_nodeaddition_should_be_detected_prepended()
    {
        $treeA = new Node('rootA');

        $child = new Node('child');
        $treeB = new Node('rootA');
        $treeB->addChild($child);

        $diff = $this->nodeDiff->diff($treeA, $treeB);

        $this->assertDifferences(
            [new NodeAdded($child, new NodePosition('rootA', NodePosition::PREPEND))],
            [],
            [],
            $diff
        );
    }

    /**
     * @test
     */
    public function add_node_to_not_empty_tree_a_nodeaddition_should_be_detected_appended()
    {
        $child = new Node('child');
        $treeA = new Node('rootA');
        $treeA->addChild($child);

        $treeB = clone $treeA;
        $endChild = new Node('end_child');
        $treeB->addChild($endChild);

        $diff = $this->nodeDiff->diff($treeA, $treeB);

        $this->assertDifferences(
            [new NodeAdded($endChild, new NodePosition('child', NodePosition::AFTER))],
            [],
            [],
            $diff
        );
    }

    /**
     * @test
     */
    public function when_a_node_has_two_new_depths_of_children_only_parent_node_should_be_added_to_added_list()
    {
        $treeA = new Node('rootA');
        // --------------------------
        $treeB = new Node('rootA');
        $childLevel0 = new Node('child0');
        $treeB->addChild($childLevel0);
        $childLevel1 = new Node('child1');
        $childLevel0->addChild($childLevel1);

        $diff = $this->nodeDiff->diff($treeA, $treeB);

        $this->assertDifferences(
            [new NodeAdded($childLevel0, new NodePosition('rootA', NodePosition::PREPEND))],
            [],
            [],
            $diff
        );
    }

    /**
     * @test
     */
    public function remove_node_from_tree_node_deleted_should_be_detected()
    {
        $child = new Node('child');

        $node = new Node('rootA');
        $node->addChild($child);

        $nodeB = new Node('rootA');

        $diff = $this->nodeDiff->diff($node, $nodeB);

        $this->assertDifferences(
            [],
            [],
            [new NodeDeleted($child)],
            $diff
        );
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

        $this->assertDifferences([], [new NodeUpdated($childChanged)], [], $diff);
    }

    /**
     * @param NodeAdded[]     $nodesAdded
     * @param NodeUpdated[]   $nodesUpdated
     * @param NodeDeleted[]   $nodesDeleted
     * @param NodeDifferences $diff
     */
    protected function assertDifferences($nodesAdded, $nodesUpdated, $nodesDeleted, NodeDifferences $diff)
    {
        $this->assertEquals($nodesAdded, $diff->getAdded());
        $this->assertEquals($nodesUpdated, $diff->getUpdated());
        $this->assertEquals($nodesDeleted, $diff->getDeleted());
    }

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->nodeDiff = new NodeDiff();
    }
}

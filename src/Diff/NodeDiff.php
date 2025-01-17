<?php

namespace Visca\WebTableFan\Diff;

use Visca\WebTableFan\Diff\Entity\NodeAdded;
use Visca\WebTableFan\Diff\Entity\NodeDeleted;
use Visca\WebTableFan\Diff\Entity\NodeDifferences;
use Visca\WebTableFan\Diff\Entity\NodePosition;
use Visca\WebTableFan\Diff\Entity\NodeUpdated;
use Visca\WebTableFan\Entity\Node\Node;

/**
 * Class NodeDiff.
 */
class NodeDiff
{
    /** @var Node[] */
    protected $nodesCache = [];

    /**
     * Compares two Nodes and returns the differences
     * required to apply to $nodeA so it converts into $nodeB.
     *
     * @param Node $nodeA
     * @param Node $nodeB
     *
     * @return NodeDifferences
     */
    public function diff(Node $nodeA, Node $nodeB)
    {
        $flattenNodeA = $this->flatten($nodeA);
        $flattenNodeB = $this->flatten($nodeB);

        return $this->doDiff($nodeA, $nodeB, $flattenNodeA, $flattenNodeB);
    }

    /**
     * @param Node $node
     *
     * @return array
     */
    private function flatten(Node $node)
    {
        $id = $node->getId();
        $values = [$id => $node->getHash()];
        $this->nodesCache[$id] = $node;

        foreach ($node->getChildren() as $childNode) {
            $values = array_merge($values, $this->flatten($childNode));
        }

        return $values;
    }

    /**
     * @param Node  $nodeA
     * @param Node  $nodeB
     * @param array $set1
     * @param array $set2
     *
     * @return NodeDifferences
     */
    private function doDiff(Node $nodeA, Node $nodeB, array $set1, array $set2)
    {
        //array_diff work at value level - not at key level - then the keys will be ignored for comparison
        $valuesInSet1ThatAreNotPresentInSet2 = array_diff_assoc($set1, $set2);
        $valuesInSet2ThatAreNotPresentInSet1 = array_diff_assoc($set2, $set1);

        $updatedFlattenNodes = array_intersect_key(
            $valuesInSet2ThatAreNotPresentInSet1,
            $valuesInSet1ThatAreNotPresentInSet2
        );
        $addedFlattenNodes = array_diff_key($set2, $set1);
        $deletedFlattenNodes = array_diff_key($set1, $set2);

        //---------------

        $updatedNodes = $this->getUpdatedNodes($updatedFlattenNodes);
        $addedNodes = $this->getAddedNodes($addedFlattenNodes);
        $deletedNodes = $this->getDeletedNodes($deletedFlattenNodes);

        return new NodeDifferences($nodeA->getId(), $nodeB->getId(), $updatedNodes, $addedNodes, $deletedNodes);
    }

    /**
     * @param array $flattenNodes
     *
     * @return NodeAdded[]
     */
    private function getAddedNodes($flattenNodes)
    {
        $addedNodes = [];

        foreach ($flattenNodes as $key => $value) {
            $node = $this->nodesCache[$key];
            if ($this->parentWasAlreadyInserted($node, array_keys($flattenNodes))) {
                continue;
            }

            $nodePosition = $this->calculatePosition($node);
            $addedNodes[] = new NodeAdded($node, $nodePosition);
        }

        return $addedNodes;
    }

    /**
     * @param array $flattenNodes
     *
     * @return NodeUpdated[]
     */
    private function getUpdatedNodes($flattenNodes)
    {
        $updatedNodes = [];

        foreach ($flattenNodes as $key => $value) {
            $node = $this->nodesCache[$key];
            $updatedNodes[] = new NodeUpdated($node);
        }

        return $updatedNodes;
    }

    /**
     * @param array $flattenNodes
     *
     * @return NodeDeleted[]
     */
    public function getDeletedNodes($flattenNodes)
    {
        $deletedNodes = [];
        foreach ($flattenNodes as $key => $value) {
            $node = $this->nodesCache[$key];
            if ($this->parentWasAlreadyInserted($node, array_keys($flattenNodes))) {
                continue;
            }

            $deletedNodes[] = new NodeDeleted($node);
        }

        return $deletedNodes;
    }

    /**
     * @param Node  $node
     * @param array $nodeIds
     *
     * @return bool
     */
    private function parentWasAlreadyInserted(Node $node, $nodeIds)
    {
        $parentIds = $node->getParentIds();

        return !empty(array_intersect($nodeIds, $parentIds));
    }

    /**
     * @param Node $node
     *
     * @return NodePosition
     */
    private function calculatePosition(Node $node)
    {
        if ($node->isRoot()) {
            return new NodePosition('top', NodePosition::APPEND); //['append', 'top'];
        }

        if (!$node->hasLeftSibling()) {
            //            return ['prepend', $node->getParent()->getId()];
            return new NodePosition($node->getParent()->getId(), NodePosition::PREPEND);
        }

//        return ['after', $node->getLeftSibling()->getId()];
        return new NodePosition($node->getLeftSibling()->getId(), NodePosition::AFTER);
    }
}

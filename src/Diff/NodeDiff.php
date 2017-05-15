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
    public function diff(Node $nodeA, Node $nodeB): NodeDifferences
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
    private function flatten(Node $node): array
    {
        $id = $node->getUniqueId();
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
    private function doDiff(Node $nodeA, Node $nodeB, array $set1, array $set2): NodeDifferences
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
    private function getAddedNodes(array $flattenNodes): array
    {
        $addedNodes = [];

        foreach ($flattenNodes as $id => $value) {
            $node = $this->nodesCache[$id] ?? null;
            if ($node === null || $this->parentWasAlreadyInserted($node, array_keys($flattenNodes))) {
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
    private function getUpdatedNodes(array $flattenNodes): array
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
    public function getDeletedNodes(array $flattenNodes): array
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
     * @param array $nodeUniqueIds
     *
     * @return bool
     */
    private function parentWasAlreadyInserted(Node $node, array $nodeUniqueIds)
    {
        // nodeIds is a list of Node::getUniqueId() which contains also parent-ids for each node.
        // we need to clean them to leave only the node-id itselves
        $cleanedNodeIds = [];
        foreach ($nodeUniqueIds as $nodeUniqueId) {
            $tokens = explode(Node::UNIQUEID_GLUE, $nodeUniqueId);
            $cleanedNodeIds[] = $tokens[0];
        }

        $parentIds = $node->getParentIds();


        return !empty(array_intersect($cleanedNodeIds, $parentIds));
    }

    /**
     * @param Node $node
     *
     * @return NodePosition
     */
    private function calculatePosition(Node $node): NodePosition
    {
        if ($node->isRoot()) {
            return new NodePosition('top', NodePosition::APPEND);
        }

        if (!$node->hasLeftSibling()) {
            return new NodePosition($node->getParent()->getId(), NodePosition::PREPEND);
        }

        return new NodePosition($node->getLeftSibling()->getId(), NodePosition::AFTER);
    }
}

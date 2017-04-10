<?php

namespace Visca\WebTableFan\Tests\Unit;

use Monolog\Logger;
use PHPUnit_Framework_TestCase;
use Visca\WebTableFan\Entity\Node\BodyNode;
use Visca\WebTableFan\Entity\Node\CellNode;
use Visca\WebTableFan\Entity\Node\RowNode;
use Visca\WebTableFan\Entity\Node\TableNode;
use Visca\WebTableFan\NodeBuilder;
use Visca\WebTableFan\TableBrowser;
use Visca\WebTableFan\Tests\Fixtures\ChainProvider;
use Visca\WebTableFan\Tests\Fixtures\Entity\View\TableFooModel;

/**
 * Class NodeBuilderTest.
 */
class NodeBuilderTest extends PHPUnit_Framework_TestCase
{
    /** @var NodeBuilder */
    private $nodeBuilder;

    /**
     * @test
     */
    public function testNodeStructureIsBuilt()
    {
        $tableModel = new TableFooModel();

        $node = $this->nodeBuilder->createNodesFromTable($tableModel);

        $this->assertInstanceOf(TableNode::class, $node);

        $bodyNodes = $node->getChildren();
        $this->assertCount(1, $bodyNodes);
        foreach ($bodyNodes as $bodyNode) {
            $this->assertInstanceOf(BodyNode::class, $bodyNode);
            $rowNodes = $bodyNode->getChildren();
            $this->assertCount(1, $rowNodes);
            foreach ($rowNodes as $rowNode) {
                $this->assertInstanceOf(RowNode::class, $rowNode);
                $cellNodes = $rowNode->getChildren();
                $this->assertCount(2, $cellNodes);
                foreach ($cellNodes as $cellNode) {
                    $this->assertInstanceOf(CellNode::class, $cellNode);
                }
            }
        }
    }

    // -------------------

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $chainProvider = new ChainProvider();
        $logger = $this->getMockBuilder(Logger::class)->getMock();
        $tableBrowser = new TableBrowser(
            $chainProvider->getTableChain(),
            $chainProvider->getBodyRendererChain(),
            $chainProvider->getRowRendererChain(),
            $chainProvider->getCellRendererChain(),
            $logger
        );

        $this->nodeBuilder = new NodeBuilder($tableBrowser);
    }
}

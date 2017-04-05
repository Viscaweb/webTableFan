<?php

namespace Visca\WebTableFan\Tests\Unit;

use Monolog\Logger;
use PHPUnit_Framework_TestCase;
use Visca\WebTableFan\Entity\Node\BodyNode;
use Visca\WebTableFan\Entity\Node\CellNode;
use Visca\WebTableFan\Entity\Node\RowNode;
use Visca\WebTableFan\Entity\Node\TableNode;
use Visca\WebTableFan\NodeBuilder;
use Visca\WebTableFan\Renderer\Chain\TableComponentRendererChain;
use Visca\WebTableFan\TableBrowser;
use Visca\WebTableFan\Tests\Fixtures\Entity\View\BodyFooModel;
use Visca\WebTableFan\Tests\Fixtures\Entity\View\CellFooModel;
use Visca\WebTableFan\Tests\Fixtures\Entity\View\RowFooModel;
use Visca\WebTableFan\Tests\Fixtures\Entity\View\TableFooModel;
use Visca\WebTableFan\Tests\Fixtures\Renderers\BodyFooRenderer;
use Visca\WebTableFan\Tests\Fixtures\Renderers\CellFooRenderer;
use Visca\WebTableFan\Tests\Fixtures\Renderers\RowFooRenderer;
use Visca\WebTableFan\Tests\Fixtures\Renderers\TableFooRenderer;

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
        $tablesRendererChain = new TableComponentRendererChain();
        $tablesRendererChain->attach(TableFooModel::class, new TableFooRenderer());

        $bodyRendererChain = new TableComponentRendererChain();
        $bodyRendererChain->attach(BodyFooModel::class, new BodyFooRenderer());

        $rowRendererChain = new TableComponentRendererChain();
        $rowRendererChain->attach(RowFooModel::class, new RowFooRenderer());

        $cellRendererChain = new TableComponentRendererChain();
        $cellRendererChain->attach(CellFooModel::class, new CellFooRenderer());

        $logger = $this->createMock(Logger::class);
        $tableBrowser = new TableBrowser(
            $tablesRendererChain,
            $bodyRendererChain,
            $rowRendererChain,
            $cellRendererChain,
            $logger
        );

        $this->nodeBuilder = new NodeBuilder($tableBrowser);
    }
}

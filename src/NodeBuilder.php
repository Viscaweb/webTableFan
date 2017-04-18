<?php

namespace Visca\WebTableFan;

use Visca\WebTableFan\Entity\Node\Node;
use Visca\WebTableFan\Entity\Node\TableNode;
use Visca\WebTableFan\Entity\View\BodyModelInterface;
use Visca\WebTableFan\Entity\View\CellModelInterface;
use Visca\WebTableFan\Entity\View\RowModelInterface;
use Visca\WebTableFan\Entity\View\TableModelInterface;
use Visca\WebTableFan\Renderer\Component\BodyRendererInterface;
use Visca\WebTableFan\Renderer\Component\CellRendererInterface;
use Visca\WebTableFan\Renderer\Component\RowRendererInterface;
use Visca\WebTableFan\Renderer\Component\TableRendererInterface;

/**
 * Class NodeBuilder.
 *
 * Converts a collection of
 *  - TableModelInterface
 *  - BodyModelInterface
 *  - RowModelInterface
 *  - CellModelInterface.
 */
class NodeBuilder
{
    /** @var TableBrowser */
    private $tableBrowser;

    /** @var Node */
    private $lastTableNode;

    /** @var Node */
    private $lastBodyNode;

    /** @var Node */
    private $lastRowNode;

    /**
     * NodeBuilder constructor.
     *
     * @param TableBrowser $tableBrowser
     */
    public function __construct(TableBrowser $tableBrowser)
    {
        $this->tableBrowser = $tableBrowser;
    }

    /**
     * Generates a hierarchical structure of Node's
     * It hydrates the Nodes with all required data except the `content`
     * property which will contain the renderer output. THIS IS NOT DONE YET.
     *
     * @param TableModelInterface $tableModel Table Model
     *
     * @return TableNode
     * @throws \InvalidArgumentException
     */
    public function createNodesFromTable($tableModel)
    {
        $this
            ->tableBrowser
            ->browseAndApplyCallbacks(
                $tableModel,
                [$this, 'callbackTable'],
                [$this, 'callbackBody'],
                [$this, 'callbackRow'],
                [$this, 'callbackCell']
            );

        return $this->lastTableNode;
    }

    /**
     * @param TableModelInterface    $tableModel
     * @param TableRendererInterface $tableRenderer
     */
    public function callbackTable(
        TableModelInterface $tableModel,
        TableRendererInterface $tableRenderer
    ) {
        $tableNode = $tableRenderer->getNode($tableModel);

        $this->lastTableNode = $tableNode;
    }

    /**
     * @param BodyModelInterface    $bodyModel
     * @param BodyRendererInterface $bodyRenderer
     */
    public function callbackBody(
        BodyModelInterface $bodyModel,
        BodyRendererInterface $bodyRenderer
    ) {
        $bodyNode = $bodyRenderer->getNode($bodyModel);

        $this->lastBodyNode = $bodyNode;
        $this->lastTableNode->addChild($bodyNode);
    }

    /**
     * @param RowModelInterface    $rowModel
     * @param RowRendererInterface $rowRenderer
     */
    public function callbackRow(
        RowModelInterface $rowModel,
        RowRendererInterface $rowRenderer
    ) {
        $rowNode = $rowRenderer->getNode($rowModel);

        $this->lastRowNode = $rowNode;
        $this->lastBodyNode->addChild($rowNode);
    }

    /**
     * @param CellModelInterface    $cellModel
     * @param CellRendererInterface $cellRenderer
     */
    public function callbackCell(
        CellModelInterface $cellModel,
        CellRendererInterface $cellRenderer
    ) {
        $cellNode = $cellRenderer->getNode($cellModel);

        $this->lastRowNode->addChild($cellNode);
    }
}

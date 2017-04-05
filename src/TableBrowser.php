<?php

namespace Visca\WebTableFan;

use Psr\Log\LoggerInterface;
use Visca\WebTableFan\Entity\View\BodyModelInterface;
use Visca\WebTableFan\Entity\View\RowModelInterface;
use Visca\WebTableFan\Entity\View\TableModelInterface;
use Visca\WebTableFan\Renderer\Chain\TableComponentRendererChain;
use Visca\WebTableFan\Renderer\Component\BodyRendererInterface;
use Visca\WebTableFan\Renderer\Component\RowRendererInterface;
use Visca\WebTableFan\Renderer\Component\TableRendererInterface;

/**
 * Class TableBrowser.
 */
final class TableBrowser
{
    const PAD = '_._._._._._._.';

    /** @var TableComponentRendererChain */
    private $tablesRendererChain;

    /** @var TableComponentRendererChain */
    private $bodiesRendererChain;

    /** @var TableComponentRendererChain */
    private $rowsRendererChain;

    /** @var callable|null */
    private $callbackTable;

    /** @var callable|null */
    private $callbackBody;

    /** @var callable|null */
    private $callbackRow;

    /** @var callable|null */
    private $callbackCell;

    /** @var array[] */
    private $cacheTableBodies = [];

    /** @var array[] */
    private $cacheBodyRows = [];

    /** @var array[] */
    private $cacheRowCells = [];

    /** @var LoggerInterface */
    private $logger;

    /**
     * NodeBuilder constructor.
     *
     * @param TableComponentRendererChain $tablesRendererChain
     * @param TableComponentRendererChain $bodiesRendererChain
     * @param TableComponentRendererChain $rowsRendererChain
     * @param TableComponentRendererChain $cellsRendererChain
     * @param LoggerInterface             $logger
     */
    public function __construct(
        TableComponentRendererChain $tablesRendererChain,
        TableComponentRendererChain $bodiesRendererChain,
        TableComponentRendererChain $rowsRendererChain,
        TableComponentRendererChain $cellsRendererChain,
        LoggerInterface $logger
    ) {
        $this->tablesRendererChain = $tablesRendererChain;
        $this->bodiesRendererChain = $bodiesRendererChain;
        $this->rowsRendererChain = $rowsRendererChain;
        $this->cellsRendererChain = $cellsRendererChain;
        $this->logger = $logger;
    }

    /**
     * @param TableModelInterface $tableModel Table
     * @param Callable            $tableCallback
     * @param Callable            $bodyCallback
     * @param Callable            $rowCallback
     * @param Callable            $cellCallback
     */
    public function browseAndApplyCallbacks(
        TableModelInterface $tableModel,
        $tableCallback = null,
        $bodyCallback = null,
        $rowCallback = null,
        $cellCallback = null
    ) {
        $tableRenderer = $this->tablesRendererChain->get($tableModel);
        $this->runCallback($tableCallback, $tableModel, $tableRenderer);

        $bodiesRichModels = $this->getTableBodies($tableModel, $tableRenderer);
        foreach ($bodiesRichModels as $bodyRichModel) {
            $bodyRenderer = $this->bodiesRendererChain->get($bodyRichModel);
            $this->runCallback($bodyCallback, $bodyRichModel, $bodyRenderer);

            $rowsRichModels = $this->getBodyRows($bodyRichModel, $bodyRenderer);
            foreach ($rowsRichModels as $rowRichModel) {
                $rowRenderer = $this->rowsRendererChain->get($rowRichModel);
                $this->runCallback($rowCallback, $rowRichModel, $rowRenderer);

                $cellsRichModels = $this->getRowCells($rowRichModel, $rowRenderer);
                foreach ($cellsRichModels as $cellRichModel) {
                    $cellRenderer = $this->cellsRendererChain->get(
                        $cellRichModel
                    );
                    $this->runCallback(
                        $cellCallback,
                        $cellRichModel,
                        $cellRenderer
                    );
                }
            }
        }

//        $this->resetCallbacks();
    }

    public function clearNodesCache()
    {
        $this->cacheTableBodies = [];
        $this->cacheBodyRows = [];
        $this->cacheRowCells = [];
    }

    /**
     * @param callable|null $callbackCell
     *
     * @return TableBrowser
     */
    public function setCallbackCell($callbackCell)
    {
        $this->callbackCell = $callbackCell;

        return $this;
    }

    /**
     * @param callable|null $callbackRow
     *
     * @return TableBrowser
     */
    public function setCallbackRow($callbackRow)
    {
        $this->callbackRow = $callbackRow;

        return $this;
    }

    /**
     * @param callable|null $callbackBody
     *
     * @return TableBrowser
     */
    public function setCallbackBody($callbackBody)
    {
        $this->callbackBody = $callbackBody;

        return $this;
    }

    /**
     * @param callable|null $callbackTable
     *
     * @return TableBrowser
     */
    public function setCallbackTable($callbackTable)
    {
        $this->callbackTable = $callbackTable;

        return $this;
    }

    /**
     * @param callable|null $callback
     * @param mixed         $richModel
     * @param mixed         $richModelRenderer
     */
    private function runCallback($callback, $richModel, $richModelRenderer)
    {
        if ($callback !== null && is_callable($callback)) {
            $callback($richModel, $richModelRenderer);
        }
    }

    private function resetCallbacks()
    {
        $this->callbackTable = null;
        $this->callbackBody = null;
        $this->callbackRow = null;
        $this->callbackCell = null;
    }

    /**
     * @param TableModelInterface    $tableModel
     * @param TableRendererInterface $tableRenderer
     *
     * @return array
     */
    private function getTableBodies(
        TableModelInterface $tableModel,
        TableRendererInterface $tableRenderer
    ) {
        $tableHash = $tableRenderer->getIdentifier($tableModel);

        if (!isset($this->cacheTableBodies[$tableHash])) {
            $this->cacheTableBodies[$tableHash] = $tableRenderer->getBodies(
                $tableModel
            );
        } else {
            //            $this->logger->info(self::PAD.'Reusing cache node for '.$tableHash);
        }

        return $this->cacheTableBodies[$tableHash];
    }

    /**
     * @param BodyModelInterface    $bodyModel
     * @param BodyRendererInterface $bodyRenderer
     *
     * @return array
     */
    private function getBodyRows(
        BodyModelInterface $bodyModel,
        BodyRendererInterface $bodyRenderer
    ) {
        $bodyHash = $bodyRenderer->getIdentifier($bodyModel);

        if (!isset($this->cacheBodyRows[$bodyHash])) {
            $this->cacheBodyRows[$bodyHash] = $bodyRenderer->getRows($bodyModel);
        } else {
            //$this->logger->info(self::PAD.'Reusing cache node for '.$bodyHash);
        }

        return $this->cacheBodyRows[$bodyHash];
    }

    /**
     * @param RowModelInterface    $rowModel
     * @param RowRendererInterface $rowRenderer
     *
     * @return array
     */
    private function getRowCells(
        RowModelInterface $rowModel,
        RowRendererInterface $rowRenderer
    ) {
        $rowHash = $rowRenderer->getIdentifier($rowModel);

        if (!isset($this->cacheRowCells[$rowHash])) {
            $this->cacheRowCells[$rowHash] = $rowRenderer->getCells($rowModel);
        } else {
            //            $this->logger->info(self::PAD.'Reusing cache node for '.$rowHash);
        }

        return $this->cacheRowCells[$rowHash];
    }
}

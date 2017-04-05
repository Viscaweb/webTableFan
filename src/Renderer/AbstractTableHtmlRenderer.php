<?php

namespace Visca\WebTableFan\Renderer;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Visca\WebTableFan\Entity\Node\CellNode;
use Visca\WebTableFan\Entity\Node\Node;
use Visca\WebTableFan\Entity\Node\TableNode;
use Visca\WebTableFan\Entity\View\TableModelInterface;
use Visca\WebTableFan\NodeBuilder;
use Visca\WebTableFan\Renderer\Chain\TableComponentRendererChain;

/**
 * Class AbstractTableHtmlRenderer.
 */
abstract class AbstractTableHtmlRenderer
{
    /** @var NodeBuilder */
    protected $nodeBuilder;

    /** @var EventDispatcherInterface */
    protected $eventDispatcher;

    /** @var TableComponentRendererChain */
    protected $tablesRendererChain;

    /** @var TableComponentRendererChain */
    protected $bodiesRendererChain;

    /*** @var TableComponentRendererChain */
    protected $rowsRendererChain;

    /** @var TableComponentRendererChain */
    protected $cellsRendererChain;

    /** @var OptimizerInterface[] */
    protected $tableOptimizers;

    /** @var bool */
    protected $debugMode;

    /**
     * @param Node $node Node
     *
     * @return string
     */
    abstract public function doRender(Node $node);

    /**
     * @param string $view Response
     *
     * @return string
     */
    abstract public function doRenderEmpty($view);

    /**
     * @param EventDispatcherInterface    $eventDispatcher      Event Dispatcher
     * @param NodeBuilder                 $nodeBuilder          Node Builder
     * @param TableComponentRendererChain $tablesRenderersChain Tables Chain
     * @param TableComponentRendererChain $bodiesRendererChain  Bodies Chain
     * @param TableComponentRendererChain $rowsRendererChain    Rows Chain
     * @param TableComponentRendererChain $cellsRendererChain   Cells Chain
     * @param bool                        $debugMode            Debug mode enabled/disabled
     * @param OptimizerInterface[]        $tableOptimizers      Table optimizers
     */
    public function __construct(
        EventDispatcherInterface $eventDispatcher,
        NodeBuilder $nodeBuilder,
        TableComponentRendererChain $tablesRenderersChain,
        TableComponentRendererChain $bodiesRendererChain,
        TableComponentRendererChain $rowsRendererChain,
        TableComponentRendererChain $cellsRendererChain,
        $debugMode,
        $tableOptimizers
    ) {
        $this->nodeBuilder = $nodeBuilder;
        $this->eventDispatcher = $eventDispatcher;
        $this->tablesRendererChain = $tablesRenderersChain;
        $this->bodiesRendererChain = $bodiesRendererChain;
        $this->rowsRendererChain = $rowsRendererChain;
        $this->cellsRendererChain = $cellsRendererChain;
        $this->debugMode = $debugMode;
        $this->tableOptimizers = $tableOptimizers;
    }

    /**
     * Renders a table model.
     *
     * @param WidgetInterface              $widget              Widget
     * @param WidgetConfigurationInterface $widgetConfiguration Widget config.
     * @param TableModelInterface          $tableModel          The table object
     *
     * @return string The final table content
     */
    public function renderTable(
//        WidgetInterface $widget,
//        WidgetConfigurationInterface $widgetConfiguration,
        TableModelInterface $tableModel
    ) {
        /* Do some optimisations in here if required */
        $this->optimiseTable($tableModel);

        /*
         * Before rending the full table, let's create the full structure of the table.
         * This method WILL NOT generate the content of each cell.
         */
        $tableNode = $this->nodeBuilder->createNodesFromTable($tableModel);
/*
        $this->eventDispatcher->dispatch(
            TableEvents::TABLE_NODES_CREATED,
            new TableNodesCreatedEvent(
                $widget->getName(),
                $widgetConfiguration,
                $tableModel->getName(),
                $tableNode->getId(),
                $tableNode->getVersion(),
                $tableNode
            )
        );
*/
        /* Prepare the table for rendering */
        $this->renderCellsContent($tableNode);

        /* Render the final table */

        $response = $this->generateTableResponse($tableNode);
/*
        $this->eventDispatcher->dispatch(
            TableEvents::TABLE_RENDERED,
            new TableRenderedEvent(
                $widget->getName(),
                $widgetConfiguration,
                $tableModel->getName(),
                $tableNode->getVersion(),
                $response
            )
        );
*/
        return $response;
    }

    /**
     * Same as `renderTable` but if NoDataFound exception is thrown it renders
     * and empty block.
     *
     * @param WidgetInterface              $widget              Widget
     * @param WidgetConfigurationInterface $widgetConfiguration Widget config.
     * @param TableModelInterface          $tableModel          Table model
     * @param string                       $view                Template to render in case of failure.
     *
     * @return string
     */
    public function renderTableOrEmpty(
//        WidgetInterface $widget,
//        WidgetConfigurationInterface $widgetConfiguration,
        TableModelInterface $tableModel,
        $view
    ) {
        try {
            $html = $this->renderTable(/*$widget, $widgetConfiguration, */$tableModel);
        } catch (\Exception $e) {
            $html = $this->doRenderEmpty($view);
        }

        return $html;
    }

    /**
     * @param Node $node
     *
     * @return string
     */
    public function generateTableResponse(Node $node)
    {
        /* Inject the version as attribute */
        if (is_callable([$node, 'getVersion']) && $node instanceof TableNode) {
            $node->setAttribute('data-version', $node->getVersion());
        }

        /* Set the hash as title in debug mode */

//        $this->addDebugInformationInTitle($node);

        return $this->doRender($node);
    }

    /**
     * @param Node $nodes
     */
    private function renderCellsContent(Node $nodes)
    {
        foreach ($nodes->getChildren() as $node) {
            if ($node instanceof CellNode) {
                $cellRenderer = $this->cellsRendererChain->get($node);
                $nodeContent = $cellRenderer->getContent($node);
                $node->setContent($nodeContent);
            } else {
                $this->renderCellsContent($node);
            }
            if ($node->getMeta() !== null && !empty($node->getMeta()->getContent())) {
                $node->setAttribute('data-meta', json_encode($node->getMeta()->getContent()));
            }
        }
    }

    /**
     * @param TableModelInterface $tableModel
     */
    private function optimiseTable(TableModelInterface $tableModel)
    {
        foreach ($this->tableOptimizers as $optimizer) {
            $optimizer->optimiseTable($tableModel);
        }
    }

    /**
     * @param Node $node Node
     */
    private function addDebugInformationInTitle(Node $node)
    {
        $node->setAttribute(
            'title',
            $this->generateNodeDebugInformation($node)
        );

        foreach ($node->getChildren() as $child) {
            $this->addDebugInformationInTitle($child);
        }
    }

    /**
     * @param Node $node
     *
     * @return string
     */
    private function generateNodeDebugInformation(Node $node)
    {
        return sprintf(
            '%s (hash: %s)',
            $node->getId(),
            $node->getHash()
        );
    }

    /**
     * @return bool
     */
    protected function debugMode()
    {
        return $this->debugMode;
    }
}

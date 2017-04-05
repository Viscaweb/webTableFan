<?php

namespace Visca\WebTableFan\Renderer;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Visca\WebTableFan\Entity\Node\Node;
use Visca\WebTableFan\NodeBuilder;
use Visca\WebTableFan\Renderer\Chain\TableComponentRendererChain;
use Visca\WebTableFan\Renderer\Optimizers\OptimizerInterface;

/**
 * Class TableHtmlTwigRenderer.
 */
class TableHtmlTwigRenderer extends AbstractTableHtmlRenderer
{
    /** @var \Twig_Environment */
    protected $twig;

    /**
     * TableHtmlTwigRenderer constructor.
     *
     * @param EventDispatcherInterface    $eventDispatcher
     * @param NodeBuilder                 $nodeBuilder
     * @param TableComponentRendererChain $tableRenderersChain
     * @param TableComponentRendererChain $bodyRenderersChain
     * @param TableComponentRendererChain $rowRenderersChain
     * @param TableComponentRendererChain $cellRenderersChain
     * @param bool                        $debugMode
     * @param OptimizerInterface[]        $optimizers
     * @param \Twig_Environment           $twig
     *
     * @internal param TableComponentRendererChain $tablesRendererChain
     * @internal param TableBodiesRendererChain $bodiesRenderersChain
     */
    public function __construct(
        EventDispatcherInterface $eventDispatcher,
        NodeBuilder $nodeBuilder,
        TableComponentRendererChain $tableRenderersChain,
        TableComponentRendererChain $bodyRenderersChain,
        TableComponentRendererChain $rowRenderersChain,
        TableComponentRendererChain $cellRenderersChain,
        $optimizers,
        $debugMode,
        \Twig_Environment $twig
    ) {
        parent::__construct(
            $eventDispatcher,
            $nodeBuilder,
            $tableRenderersChain,
            $bodyRenderersChain,
            $rowRenderersChain,
            $cellRenderersChain,
            $debugMode,
            $optimizers
        );
        $this->twig = $twig;
    }

    /**
     * {@inheritdoc}
     */
    public function doRender(Node $node)
    {
        return $this->twig->render(
            'renderTable.html.twig',
            ['table' => $node]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function doRenderEmpty($view)
    {
        return $this->twig->render($view);
    }
}

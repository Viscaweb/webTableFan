<?php

declare(strict_types=1);

namespace Visca\WebTableFan\Renderer;

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

    /** @var string */
    private $templateFile;

    /**
     * TableHtmlTwigRenderer constructor.
     *
     * @param NodeBuilder                 $nodeBuilder
     * @param TableComponentRendererChain $tableRenderersChain
     * @param TableComponentRendererChain $bodyRenderersChain
     * @param TableComponentRendererChain $rowRenderersChain
     * @param TableComponentRendererChain $cellRenderersChain
     * @param OptimizerInterface[]        $optimizers
     * @param bool                        $debugMode
     * @param \Twig_Environment           $twig
     * @param                             $templateFile
     *
     * @internal param TableComponentRendererChain $tablesRendererChain
     * @internal param TableBodiesRendererChain $bodiesRenderersChain
     */
    public function __construct(
        NodeBuilder $nodeBuilder,
        TableComponentRendererChain $tableRenderersChain,
        TableComponentRendererChain $bodyRenderersChain,
        TableComponentRendererChain $rowRenderersChain,
        TableComponentRendererChain $cellRenderersChain,
        $optimizers,
        $debugMode,
        \Twig_Environment $twig,
        $templateFile
    ) {
        parent::__construct(
            $nodeBuilder,
            $tableRenderersChain,
            $bodyRenderersChain,
            $rowRenderersChain,
            $cellRenderersChain,
            $debugMode,
            $optimizers
        );
        $this->templateFile = $templateFile;
        $this->twig = $twig;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Syntax
     */
    public function doRender(Node $node)
    {
        return $this->twig->render(
            $this->templateFile,
            ['table' => $node]
        );
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function doRenderEmpty($view)
    {
        return $this->twig->render($view);
    }
}

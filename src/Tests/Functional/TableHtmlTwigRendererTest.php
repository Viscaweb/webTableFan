<?php

namespace Visca\WebTableFan\Tests\Unit;

use Monolog\Logger;
use PHPUnit_Framework_TestCase;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Visca\WebTableFan\NodeBuilder;
use Visca\WebTableFan\Renderer\TableHtmlTwigRenderer;
use Visca\WebTableFan\TableBrowser;
use Visca\WebTableFan\Tests\Fixtures\ChainProvider;
use Visca\WebTableFan\Tests\Fixtures\Entity\View\TableFooModel;
use Visca\WebTableFan\Twig\Extensions\TableExtension;

/**
 * Class TableHtmlTwigRendererTest.
 */
class TableHtmlTwigRendererTest extends PHPUnit_Framework_TestCase
{
    /** @var TableHtmlTwigRenderer */
    private $renderer;

    /**
     * @test
     */
    public function when_rendering_table_model_string_should_be_retrieved()
    {
        $tableModel = new TableFooModel();

        $html = $this->renderer->renderTable($tableModel);

        $this->assertEquals('<table  id="table-foo"
 data-version="4fa506ff2369b6970137845363dae90f"
><tbody id="body-tag"
><tr id="row-tag"
><td id="cell-tag"
>CELL CONTENT</td><td id="cell-tag"
>CELL CONTENT</td></tr></tbody></table>', $html);
    }

    // ---------------

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $chainProvider = new ChainProvider();
        $eventDispatcher = new EventDispatcher();
        $logger = $this->createMock(Logger::class);

        $nodeBuilder = new NodeBuilder(
            new TableBrowser(
                $chainProvider->getTableChain(),
                $chainProvider->getBodyRendererChain(),
                $chainProvider->getRowRendererChain(),
                $chainProvider->getCellRendererChain(),
                $logger
            )
        );

        $twig = new \Twig_Environment(new \Twig_Loader_Filesystem(realpath(__DIR__.'/../../Resources/views')));
        $twig->addExtension(new TableExtension());

        $this->renderer = new TableHtmlTwigRenderer(
            $eventDispatcher,
            $nodeBuilder,
            $chainProvider->getTableChain(),
            $chainProvider->getBodyRendererChain(),
            $chainProvider->getRowRendererChain(),
            $chainProvider->getCellRendererChain(),
            [],
            false,
            $twig
        );
    }
}

<?php

namespace Visca\WebTableFan\Tests\Unit;

use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_TestCase;
use RuntimeException;
use Visca\WebTableFan\Renderer\Chain\TableComponentRendererChain;
use Visca\WebTableFan\Renderer\Component\TableRendererInterface;

/**
 * Class TableRendererChainTest.
 */
class TableRendererChainTest extends TestCase
{
    /** @var mixed */
    private $tableChain;

    /** @var TableComponentRendererChain */
    private $existingService;

    /**
     * @test
     */
    public function when_no_renderers_defined_should_throw_exception()
    {
        $this->expectException(RuntimeException::class);
//        $this->setExpectedException(RuntimeException::class);
        $this->tableChain->get('foo');
    }

    /**
     * @test
     */
    public function when_asking_existing_renderer_should_return_it()
    {
        $service = $this->tableChain->get('existing');
        $this->assertEquals($this->existingService, $service);
    }

    // ------------------------

    public function setUp()
    {
        $this->existingService = $this->getMockBuilder(TableRendererInterface::class)->getMock();

        $this->tableChain = new TableComponentRendererChain();
        $this->tableChain->attach('existing', $this->existingService);
    }
}

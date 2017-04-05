<?php

namespace Visca\WebTableFan\Tests\Unit;

use PHPUnit_Framework_TestCase;
use RuntimeException;
use Visca\WebTableFan\Renderer\Chain\TableComponentRendererChain;
use Visca\WebTableFan\Renderer\Component\TableInterface;

/**
 * Class TableRendererChainTest.
 */
class TableRendererChainTest extends PHPUnit_Framework_TestCase
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
        $this->existingService = $this->createMock(TableInterface::class);

        $this->tableChain = new TableComponentRendererChain();
        $this->tableChain->attach('existing', $this->existingService);
    }
}

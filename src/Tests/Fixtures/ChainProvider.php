<?php

namespace Visca\WebTableFan\Tests\Fixtures;

use Visca\WebTableFan\Renderer\Chain\TableComponentRendererChain;
use Visca\WebTableFan\Tests\Fixtures\Entity\Node\CellFooNode;
use Visca\WebTableFan\Tests\Fixtures\Entity\View\BodyFooModel;
use Visca\WebTableFan\Tests\Fixtures\Entity\View\CellFooModel;
use Visca\WebTableFan\Tests\Fixtures\Entity\View\RowFooModel;
use Visca\WebTableFan\Tests\Fixtures\Entity\View\TableFooModel;
use Visca\WebTableFan\Tests\Fixtures\Renderers\BodyFooRenderer;
use Visca\WebTableFan\Tests\Fixtures\Renderers\CellFooRenderer;
use Visca\WebTableFan\Tests\Fixtures\Renderers\RowFooRenderer;
use Visca\WebTableFan\Tests\Fixtures\Renderers\TableFooRenderer;

/**
 * Class ChainProvider
 */
class ChainProvider
{
    /** @var TableComponentRendererChain */
    private $tablesRendererChain;

    /** @var TableComponentRendererChain */
    private $bodyRendererChain;

    /** @var TableComponentRendererChain */
    private $rowRendererChain;

    /** @var TableComponentRendererChain */
    private $cellRendererChain;

    public function __construct()
    {
        $this->tablesRendererChain = new TableComponentRendererChain();
        $this->tablesRendererChain->attach(TableFooModel::class, new TableFooRenderer());

        $this->bodyRendererChain = new TableComponentRendererChain();
        $this->bodyRendererChain->attach(BodyFooModel::class, new BodyFooRenderer());

        $this->rowRendererChain = new TableComponentRendererChain();
        $this->rowRendererChain->attach(RowFooModel::class, new RowFooRenderer());

        $this->cellRendererChain = new TableComponentRendererChain();
        $this->cellRendererChain->attach(CellFooModel::class, new CellFooRenderer());
        $this->cellRendererChain->attach(CellFooNode::class, new CellFooRenderer());
    }

    /**
     * @return TableComponentRendererChain
     */
    public function getTableChain()
    {
        return $this->tablesRendererChain;
    }

    /**
     * @return TableComponentRendererChain
     */
    public function getBodyRendererChain()
    {
        return $this->bodyRendererChain;
    }

    /**
     * @return TableComponentRendererChain
     */
    public function getRowRendererChain()
    {
        return $this->rowRendererChain;
    }

    /**
     * @return TableComponentRendererChain
     */
    public function getCellRendererChain()
    {
        return $this->cellRendererChain;
    }
}

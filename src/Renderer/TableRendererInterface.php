<?php

namespace Visca\WebTableFan\Renderer;

use Visca\WebTableFan\Entity\View\TableModelInterface;

/**
 * Class TableRendererInterface.
 */
interface TableRendererInterface
{
    /**
     * Renders a table model.
     *
     * @param TableModelInterface $tableModel
     *
     * @return string
     */
    public function renderTable(TableModelInterface $tableModel);

    /**
     * Same as `renderTable` but if NoDataFound exception is thrown it renders
     * and empty block.
     *
     * @param TableModelInterface $tableModel  Table model
     * @param string              $emptyRender Template to render in case of failure.
     *
     * @return string
     */
    public function renderTableOrEmpty(TableModelInterface $tableModel, $emptyRender);
}

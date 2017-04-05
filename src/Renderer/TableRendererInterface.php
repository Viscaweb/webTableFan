<?php

namespace Visca\WebTableFan\Renderer;

use Visca\WebTableFan\Entity\View\TableModelInterface;

/**
 * Class TableRendererInterface
 */
interface TableRendererInterface
{
    /**
     * @param TableModelInterface $tableModel
     *
     * @return string
     */
    public function renderTable(TableModelInterface $tableModel);

    /**
     * @param TableModelInterface $tableModel
     *
     * @return string
     */
    public function renderTableOrEmpty(TableModelInterface $tableModel);
}

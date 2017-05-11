<?php

namespace Visca\WebTableFan\Renderer\Optimizers;

use Visca\WebTableFan\Entity\View\TableModelInterface;

/**
 * Interface OptimizerInterface.
 */
interface OptimizerInterface
{
    /**
     * @param TableModelInterface $tableModel Table Model
     *
     * @return
     */
    public function optimiseTable(TableModelInterface $tableModel);
}

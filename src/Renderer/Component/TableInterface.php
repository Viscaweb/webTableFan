<?php

namespace Visca\WebTableFan\Renderer\Component;

use Visca\WebTableFan\Entity\View\TableModelInterface;

/**
 * TableInterface.
 */
interface TableInterface extends NodeableInterface
{
    /**
     * @param TableModelInterface $tableModel Model
     *
     * @return string
     */
    public function getIdentifier($tableModel);

    /**
     * @param TableModelInterface $tableModel Model
     *
     * @throws \Exception
     *
     * @return array
     */
    public function getBodies($tableModel);

    /**
     * @param TableModelInterface $tableModel Model
     *
     * @return string[]
     */
    public function getAttributes($tableModel);

    /**
     * @param TableModelInterface $tableModel Model
     *
     * @return string[]
     */
    public function getColGroups($tableModel);
}

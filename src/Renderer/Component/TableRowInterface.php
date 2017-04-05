<?php

namespace Visca\WebTableFan\Renderer\Component;

use Visca\WebTableFan\Entity\View\RowModelInterface;

/**
 * TableRowInterface.
 */
interface TableRowInterface extends NodeableInterface
{
    /**
     * @param RowModelInterface $rowModel
     *
     * @return string
     */
    public function getIdentifier($rowModel);

    /**
     * @param RowModelInterface $rowModel Model
     *
     * @throws \Exception
     *
     * @return array
     */
    public function getCells($rowModel);

    /**
     * Returns an array of html attributes.
     *
     * @param RowModelInterface $rowModel RowModel
     *
     * @return array
     */
    public function getAttributes($rowModel);
}

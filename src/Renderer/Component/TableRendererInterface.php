<?php

declare(strict_types=1);

namespace Visca\WebTableFan\Renderer\Component;

use Visca\WebTableFan\Entity\View\TableModelInterface;

/**
 * TableRendererInterface.
 */
interface TableRendererInterface extends NodeableInterface
{
    /**
     * @param TableModelInterface $tableModel Model
     *
     * @return string
     */
    public function getIdentifier($tableModel): string;

    /**
     * @param TableModelInterface $tableModel Model
     *
     * @throws \Exception
     *
     * @return array
     */
    public function getBodies($tableModel): array;

    /**
     * @param TableModelInterface $tableModel Model
     *
     * @return string[]
     */
    public function getAttributes($tableModel): array;

    /**
     * @param TableModelInterface $tableModel Model
     *
     * @return string[]
     */
    public function getColGroups($tableModel): array;
}

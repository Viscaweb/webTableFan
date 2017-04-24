<?php

declare(strict_types=1);

namespace Visca\WebTableFan\Renderer\Component;

use Visca\WebTableFan\Entity\View\CellModelInterface;

/**
 * CellRendererInterface.
 */
interface CellRendererInterface extends NodeableInterface
{
    /**
     * @param CellModelInterface $cellModel Model
     *
     * @return string
     */
    public function getIdentifier($cellModel): string;

    /**
     * @param CellModelInterface $cellModel Model
     *
     * @return string
     */
    public function getCellType($cellModel): string;

    /**
     * @param mixed $cellNode Node
     *
     * @throws \Exception
     *
     * @return string
     */
    public function getContent($cellNode): string;

    /**
     * @param CellModelInterface $cellModel Model
     *
     * @return mixed
     */
    public function getAttributes($cellModel): array;
}

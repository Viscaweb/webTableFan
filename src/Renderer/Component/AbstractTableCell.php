<?php

declare(strict_types=1);

namespace Visca\WebTableFan\Renderer\Component;

use Visca\WebTableFan\Entity\Code\HtmlAttributes;
use Visca\WebTableFan\Entity\Node\Node;

/**
 * Class AbstractTableCell.
 */
abstract class AbstractTableCell implements CellRendererInterface
{
    /**
     * {@inheritdoc}
     */
    public function getIdentifier($cell): string
    {
        return 'cell_'.uniqid(str_replace('\\', '-', get_class($cell)), true);
    }

    /**
     * {@inheritdoc}
     *
     * @throws \RuntimeException
     */
    public function getNode($cellModel): Node
    {
        throw new \RuntimeException(
            sprintf(
                '%s does not implements getNode() method.',
                get_class($this)
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getCellType($cell): string
    {
        return $cell->getCellType();
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes($cellModel): array
    {
        $attributes = [
            HtmlAttributes::MARKUPID => $this->getIdentifier($cellModel),
        ];

        if ($cellModel->getCellColspan() > 1) {
            $attributes[HtmlAttributes::COLSPAN] = $cellModel->getCellColspan();
        }

        if ($cellModel->getCellRowspan() > 1) {
            $attributes[HtmlAttributes::ROWSPAN] = $cellModel->getCellRowspan();
        }

        if (!empty($cellModel->getHtmlClass())) {
            $htmlClass = $cellModel->getHtmlClass();
            if (is_array($htmlClass)) {
                $htmlClass = implode(' ', $cellModel->getHtmlClass());
            }

            $attributes[HtmlAttributes::CSSCLASS] = $htmlClass;
        }

        return $attributes;
    }

    /**
     * @param mixed $model A model
     *
     * @return string[]
     */
    public function getListeners($model): array
    {
        return [];
    }
}

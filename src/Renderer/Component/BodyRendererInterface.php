<?php

declare(strict_types=1);

namespace Visca\WebTableFan\Renderer\Component;

use Visca\WebTableFan\Entity\View\BodyModelInterface;

/**
 * BodyRendererInterface.
 */
interface BodyRendererInterface extends NodeableInterface
{
    /**
     * @param BodyModelInterface $model Model
     *
     * @return string
     */
    public function getIdentifier($model): string;

    /**
     * @param BodyModelInterface $body Model
     *
     * @throws \Exception
     *
     * @return array
     */
    public function getRows($body): array;

    /**
     * @param BodyModelInterface $model Model
     *
     * @return array
     */
    public function getAttributes($model): array;

    /**
     * Returns the type of table body. It can be either BodyTypes::TBODY or BodyTypes::THEAD.
     *
     * @param BodyModelInterface $model
     *
     * @return string
     */
    public function getBodyType(BodyModelInterface $model): string;
}

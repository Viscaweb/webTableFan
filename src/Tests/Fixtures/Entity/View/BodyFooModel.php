<?php

namespace Visca\WebTableFan\Tests\Fixtures\Entity\View;

use Visca\WebTableFan\Entity\Code\BodyTypes;
use Visca\WebTableFan\Entity\View\AbstractBodyModel;

/**
 * Class BodyFooModel.
 */
class BodyFooModel extends AbstractBodyModel
{
    /** @var string */
    protected $bodyType;

    /**
     * {@inheritdoc}
     */
    public function getId(): string
    {
        return 'body-tag';
    }

    /**
     * {@inheritdoc}
     */
    public function getBodyType(): string
    {
        return BodyTypes::TBODY;
    }

    /**
     * {@inheritdoc}
     */
    public function setBodyType(string $bodyType)
    {
        $this->bodyType = $bodyType;
    }

    /**
     * {@inheritdoc}
     */
    public function getCssClasses(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function setCssClasses($cssClasses)
    {
    }
}

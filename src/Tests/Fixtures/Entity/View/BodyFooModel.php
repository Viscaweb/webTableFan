<?php

namespace Visca\WebTableFan\Tests\Fixtures\Entity\View;

use Visca\WebTableFan\Entity\Code\BodyTypes;
use Visca\WebTableFan\Entity\View\BodyModelInterface;

/**
 * Class BodyFooModel.
 */
class BodyFooModel implements BodyModelInterface
{
    /** @var string */
    protected $bodyType;

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return 'body-tag';
    }

    /**
     * {@inheritdoc}
     */
    public function getBodyType()
    {
        return BodyTypes::TBODY;
    }

    /**
     * {@inheritdoc}
     */
    public function setBodyType($bodyType)
    {
        $this->bodyType = $bodyType;
    }

    /**
     * {@inheritdoc}
     */
    public function getCssClasses()
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

<?php

namespace Visca\WebTableFan\Entity\View;

use Visca\Bundle\SportBundle\Model\TableSystem\Nodes\Traits\MobileCheckerTrait;
use Visca\Bundle\TableBundle\Model\Body\BodyModelInterface;
use Visca\Bundle\TableBundle\Model\Enum\BodyTypes;

/**
 * Class AbstractBodyModel.
 */
abstract class AbstractBodyModel implements BodyModelInterface
{
    use MobileCheckerTrait;

    /** @var string */
    protected $id;

    /** @var string */
    protected $bodyType;

    /** @var string[] */
    protected $cssClasses;

    /**
     * AbstractBodyModel constructor.
     *
     * @param string $bodyType
     */
    public function __construct($bodyType = BodyTypes::TBODY)
    {
        $this->bodyType = $bodyType;
    }

    /** @return string */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBodyType()
    {
        return $this->bodyType;
    }

    /**
     * {@inheritdoc}
     */
    public function setBodyType($bodyType)
    {
        $this->bodyType = $bodyType;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCssClasses()
    {
        return $this->cssClasses;
    }

    /**
     * {@inheritdoc}
     */
    public function setCssClasses($cssClasses)
    {
        $this->cssClasses = $cssClasses;

        return $this;
    }
}

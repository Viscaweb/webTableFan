<?php

declare(strict_types=1);

namespace Visca\WebTableFan\Entity\View;

use Visca\WebTableFan\Entity\Code\BodyTypes;

/**
 * Class AbstractBodyModel.
 */
abstract class AbstractBodyModel implements BodyModelInterface
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $bodyType;

    /** @var string[] */
    protected $cssClasses;

    /** @var bool */
    protected $mobile;

    /**
     * AbstractBodyModel constructor.
     *
     * @param string $id
     * @param string $bodyType
     */
    public function __construct(string $bodyType = BodyTypes::TBODY)
    {
        $this->bodyType = $bodyType;
        $this->cssClasses = [];
    }

    /**
     * {@inheritdoc}
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBodyType(): string
    {
        return $this->bodyType;
    }

    /**
     * {@inheritdoc}
     */
    public function setBodyType(string $bodyType)
    {
        $this->bodyType = $bodyType;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCssClasses(): array
    {
        return $this->cssClasses;
    }

    /**
     * {@inheritdoc}
     */
    public function setCssClasses($cssClasses): self
    {
        $this->cssClasses = $cssClasses;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isMobile(): bool
    {
        return $this->mobile;
    }

    /**
     * {@inheritdoc}
     */
    public function setMobile(bool $isMobile)
    {
        $this->mobile = $isMobile;

        return $this;
    }
}

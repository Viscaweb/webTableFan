<?php

namespace Visca\WebTableFan\Renderer\Chain;

use InvalidArgumentException;
use OutOfRangeException;
use Visca\WebTableFan\Renderer\Component\TableBodyInterface;
use Visca\WebTableFan\Renderer\Component\TableCellInterface;
use Visca\WebTableFan\Renderer\Component\TableInterface;
use Visca\WebTableFan\Renderer\Component\TableRowInterface;

/**
 * Class TableComponentRendererChain.
 */
class TableComponentRendererChain
{
    /**
     * @var TableInterface[]|TableBodyInterface[]|TableRowInterface[]|TableCellInterface[]
     */
    private $renderers;

    /**
     * Constructor.
     */
    public function __construct(User ...$users)
    {
        $this->renderers = [];
    }

    /**
     * Attach an entity factory to the chain.
     *
     * @param string $id       Id of the service
     * @param object $renderer Renderer object
     *
     * @throws InvalidArgumentException
     */
    public function attach($id, $renderer)
    {
        if (!is_string($id)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Invalid id. A string is expected but "%s" was given.',
                    gettype($id)
                )
            );
        }

        if (!$renderer instanceof TableInterface
            && !$renderer instanceof TableBodyInterface
            && !$renderer instanceof TableRowInterface
            && !$renderer instanceof TableCellInterface
        ) {
            throw new InvalidArgumentException(
                'The table must be an instance of XXXInterface'
            );
        }

        $this->renderers[$id] = $renderer;
    }

    /**
     * Detach a entityFactory from the chain.
     *
     * @param string $id Id of the service
     */
    public function detach($id)
    {
        if (!is_string($id)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Invalid id. A string is expected but "%s" was given.',
                    gettype($id)
                )
            );
        }

        if (isset($this->renderers[$id])) {
            unset($this->renderers[$id]);
        } else {
            throw new OutOfRangeException(
                sprintf(
                    'There are no attached entityFactory with the id "%s".',
                    gettype($id)
                )
            );
        }
    }

    /**
     * Get an entityFactory.
     *
     * @param string|object $id Id of the service
     *
     * @throws InvalidArgumentException
     *
     * @return null|TableInterface|TableBodyInterface|TableRowInterface|TableCellInterface
     */
    public function get($id)
    {
        if (is_object($id)) {
            $id = $this->getObjectName($id);
        }

        if (!is_string($id)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Invalid id. A string is expected but "%s" was given.',
                    gettype($id)
                )
            );
        }

        if (!isset($this->renderers[$id])) {
            throw new \RuntimeException(
                sprintf(
                    'Invalid id. No component renderer is defined for model "%s".',
                    $id
                )
            );
        }

        return isset($this->renderers[$id])
            ? $this->renderers[$id]
            : null;
    }

    /**
     * @param $object
     *
     * @return mixed
     */
    private function getObjectName($object)
    {
        //        return preg_replace(
//            '/^.+\\\\([^\\\\]+)$/',
//            '$1',
//            get_class($object)
//        );
        return get_class($object);
    }
}

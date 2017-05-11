<?php

namespace Visca\WebTableFan\Entity\Node;

interface Searchable
{
    /**
     * @param string $id
     *
     * @return Node|null
     */
    public function findById($id);
}

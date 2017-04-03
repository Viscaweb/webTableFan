<?php

namespace Visca\WebTableFan\Entity;

interface Searchable
{
    /**
     * @param string $id
     *
     * @return Node|null
     */
    public function findById($id);
}

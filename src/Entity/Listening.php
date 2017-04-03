<?php

namespace Visca\WebTableFan\Entity;

//use Visca\Bundle\LicomBundle\Events\Event;

interface Listening
{
    /**
     * @return Event[]
     */
    public function getListeningEvents();
}

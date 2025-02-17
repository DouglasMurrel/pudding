<?php

namespace App\Event;

use App\Entity\CharacterOrder;
use Symfony\Contracts\EventDispatcher\Event;

class NewOrderEvent extends Event
{
    protected $order;
    
    public function __construct(CharacterOrder $order)
    {
        $this->order = $order;
    }
    
    public function getOrder() {
        return $this->order;
    }

    public function setOrder($order): self 
    {
        $this->order = $order;
        return $this;
    }
}

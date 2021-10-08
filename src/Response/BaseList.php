<?php

namespace Drift\Response;

abstract class BaseList extends \ArrayObject
{
    protected $next;
    protected $more;
    protected $total;

    protected function setPagination($response)
    {
        if (property_exists($response, 'pagination')) {
            $this->more = $response->pagination->more;
            if ($response->more) {
                $this->next = $response->pagination->next;
            }
        }
        if (property_exists($response, 'next')) {
            $this->next = $response->next;
        }
    }

    public function getNext()
    {
        if ($this->next) {
            return $this->next;
        }
        return false;
    }
}

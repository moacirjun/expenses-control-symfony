<?php

namespace App\Service;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;

class Paginator extends DoctrinePaginator
{
    /**
     * Paginator contructor
     *
     * @param Query|QueryBuilder $query
     * @param integer $page
     * @param integer $perpage
     */
    public function __construct($query, int $page = 1, int $perpage = 15)
    {
        if ($page < 1) {
            $page = 1;
        }

        if ($perpage < 1 || $perpage > 1000) {
            $page = 15;
        }

        $offset = ($page - 1) * $perpage;

        $query
            ->setMaxResults($perpage)
            ->setFirstResult($offset);

        parent::__construct($query, false);
    }
}
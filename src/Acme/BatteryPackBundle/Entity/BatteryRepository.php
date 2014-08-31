<?php
namespace Acme\BatteryPackBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class BatteryRepository extends EntityRepository
{
    /**
     * Find battery types information
     *
     * @return array
     */
    public function findTypes()
    {
        return $this->createQueryBuilder('b')
            ->select('b.type, SUM(b.count) AS tcount')
            ->addGroupBy('b.type')
            ->getQuery()
            ->getResult();
    }
}
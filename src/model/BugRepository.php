<?php

use Doctrine\ORM\EntityRepository;

/**
 * Handles access to the 'Model_Bug' entity.
 */
class Model_BugRepository extends EntityRepository
{

    /**
     * @param int $number
     *
     * @return Model_Bug[]
     */
    public function getRecentBugs($number = 30)
    {
        $dql = "SELECT b, e, r FROM Model_Bug b JOIN b.engineer e JOIN b.reporter r ORDER BY b.created DESC";

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setMaxResults($number);
        return $query->getResult();
    }

}
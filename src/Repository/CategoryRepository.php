<?php
namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use App\Entity\Job;

class CategoryRepository extends EntityRepository {

    public function findWithActiveJobs() {
        return $this->createQueryBuilder('c')
            ->select('c')
            ->innerJoin('c.jobs', 'j')
            ->where('j.expiresAt > :date')
            ->setParameter('date', new \DateTime())
            ->getQuery()
            ->getResult();
    }
}
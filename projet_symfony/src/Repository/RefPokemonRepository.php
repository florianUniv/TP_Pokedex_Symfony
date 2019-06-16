<?php

namespace App\Repository;

use App\Entity\RefPokemon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RefPokemon|null find($id, $lockMode = null, $lockVersion = null)
 * @method RefPokemon|null findOneBy(array $criteria, array $orderBy = null)
 * @method RefPokemon[]    findAll()
 * @method RefPokemon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RefPokemonRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RefPokemon::class);
    }

    // /**
    //  * @return RefPokemon[] Returns an array of RefPokemon objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RefPokemon
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

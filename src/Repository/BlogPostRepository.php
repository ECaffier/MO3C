<?php

namespace App\Repository;

use App\Entity\BlogPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BlogPost>
 *
 * @method BlogPost|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogPost|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogPost[]    findAll()
 * @method BlogPost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogPostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogPost::class);
    }

/**
 * @return BlogPost[] Returns an array of BlogPost objects
 */
public function findLastBlogPosts(): array
{
    // SELECT * FROM blog_post ORDER BY created_at DESC LIMIT 3;
    return $this->createQueryBuilder('e')
        ->orderBy('e.createdAt', 'DESC')
        ->setMaxResults(3)
        ->getQuery()
        ->getResult(); // Utilisez getResult() au lieu de getOneOrNullResult()
}


//    public function findOneBySomeField($value): ?BlogPost
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

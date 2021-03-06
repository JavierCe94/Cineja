<?php

namespace Javier\Cineja\Infrastructure\Repository\Room\Seat;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\Seat;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepository as SeatRepositoryI;

class SeatRepository extends ServiceEntityRepository implements SeatRepositoryI
{
    /**
     * @param array $seats
     * @return array|Seat
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createSeatsRoom(array $seats): array
    {
        foreach ($seats as $seat) {
            $this->getEntityManager()->persist($seat);
        }
        $this->getEntityManager()->flush();

        return $seats;
    }

    /**
     * @param array $seats
     * @param bool $isTypeSpace
     * @return array
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function changeTypeSeat(array $seats, bool $isTypeSpace): array
    {
        foreach ($seats as $seat) {
            $seat->setTypeSpace($isTypeSpace);
        }
        $this->getEntityManager()->flush();

        return $seats;
    }

    /**
     * @param int $id
     * @return object|Seat
     */
    public function findSeatById(int $id): ?Seat
    {
        return $this->find($id);
    }

    public function findSeatsByIdRoom(int $idRoom): array
    {
        return $this->createQueryBuilder('se')
            ->innerJoin('se.room', 'ro')
            ->andWhere('ro.id = :idRoom')
            ->setParameter('idRoom', $idRoom)
            ->getQuery()
            ->execute();
    }
}

<?php

namespace Javier\Cineja\Infrastructure\Repository\Room\Seat;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\Seat;

class SeatRepository extends ServiceEntityRepository
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

    public function changeToTypeSpaceSeat(array $idSeats): void
    {
        $this->changeToSpaceSeat($idSeats, true);
    }

    public function changeToTypeNormalSeat(array $idSeats): void
    {
        $this->changeToSpaceSeat($idSeats, false);
    }

    private function changeToSpaceSeat(array $idSeats, bool $typeSpace): void
    {
        $update = $this->getEntityManager()->createQueryBuilder()
            ->update('Javier\Cineja:Room\Seat\Seat', 'se')
            ->set('se.typeSpace', $typeSpace)
            ->where($this->getEntityManager()->createQueryBuilder()->expr()->in('se.id', $idSeats))
            ->getQuery();
        $update->execute();
    }

    public function findSeatById(int $id): ?Seat
    {
        /* @var Seat $seat */
        $seat = $this->find($id);

        return $seat;
    }

    public function findSeatsByIdRoom(int $idRoom): array
    {
        $query = $this->createQueryBuilder('se')
            ->innerJoin('se.room', 'ro')
            ->andWhere('ro.id = :idRoom')
            ->setParameter('idRoom', $idRoom)
            ->getQuery();

        return $query->execute();
    }
}

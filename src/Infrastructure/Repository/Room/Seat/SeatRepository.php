<?php

namespace Javier\Cineja\Infrastructure\Repository\Room\Seat;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\Seat;

class SeatRepository extends ServiceEntityRepository
{
    /**
     * @param array|Seat[] $seats
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createSeatsRoom(array $seats): void
    {
        foreach ($seats as $seat) {
            $this->getEntityManager()->persist($seat);
        }
        $this->getEntityManager()->flush();
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

    public function showByIdRoomSeats(int $idRoom): array
    {
        $query = $this->createQueryBuilder('se')
            ->andWhere('se.room = :idRoom')
            ->setParameter('idRoom', $idRoom)
            ->getQuery();

        return $query->execute();
    }
}

<?php

namespace Javier\Cineja\Infrastructure\Repository\Room\Seat;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\Seat;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepositoryInterface;

class SeatRepository extends ServiceEntityRepository implements SeatRepositoryInterface
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
     * @return array
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function changeToTypeSpaceSeat(array $seats): array
    {
        foreach ($seats as $seat) {
            $seat->setTypeSpace(true);
        }
        $this->getEntityManager()->flush();

        return $seats;
    }

    /**
     * @param array $seats
     * @return array
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function changeToTypeNormalSeat(array $seats): array
    {
        foreach ($seats as $seat) {
            $seat->setTypeSpace(false);
        }
        $this->getEntityManager()->flush();

        return $seats;
    }

    public function findSeatById(int $id): ?Seat
    {
        /* @var Seat $seat */
        $seat = $this->find($id);

        return $seat;
    }

    public function findSeatsFilmRoom(int $idRoom, int $idFilmRoom): array
    {
        $query = $this->createQueryBuilder('s')
            ->leftJoin('s.userSeatsFilm', 'usf')
            ->innerJoin('usf.filmRoom', 'fr')
            ->innerJoin('s.room', 'r')
            ->andWhere('r.id = :idRoom')
            ->andWhere('fr.id = :idFilmRoom')
            ->setParameter('idRoom', $idRoom)
            ->setParameter('idFilmRoom', $idFilmRoom)
            ->getQuery();

        return $query->execute();
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

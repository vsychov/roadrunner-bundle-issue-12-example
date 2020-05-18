<?php

declare(strict_types=1);

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(EntityManagerInterface $entityManager)
    {
        $entityManager->createNativeQuery('SELECT 1=1', new ResultSetMapping())
            ->getResult()
        ;

        $entityManager->flush();

        return new Response('ok');
    }

    /**
     * @Route("/rollback")
     */
    public function rollback(EntityManagerInterface $entityManager)
    {
        try {
            $entityManager->transactional(function () {
                throw new \RuntimeException('something wrong');
            });
        } catch (\RuntimeException $exception) {
            //nothing to do
        }

        return new Response('em closed');
    }
}

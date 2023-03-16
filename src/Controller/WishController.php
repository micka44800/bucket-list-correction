<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    #[Route('/wish', name: 'app_wish')]
    public function index(): Response
    {
        return $this->render('wish/index.html.twig', [
            'controller_name' => 'WishController',
        ]);
    }

    #[Route('/list', name: 'wish_list')]
    public function list(WishRepository $wishRepository): Response
    {

        // todo : aller chercher les séries en BDD
        $wish = $wishRepository->findAll();
        //aller chercher les 30 series les plus populaires
        //  $series = $serieRepository->findBy([], ['popularity'=>'DESC'], 30);
        //$series = $serieRepository->findBestSeries();
        dump($wish);
        return $this->render('wish/list.html.twig', [
            'wish' => $wish
        ]);
    }




    #[Route('/create', name:'wish_create')]
    public function create (EntityManagerInterface  $entityManager)
    {
        $wish = new Wish();
        $wish->setDateCreated(new \DateTime());
        $wish->setAuthor('micka');
        $wish->setDescription('x6 m, m8');
        $wish->setTitle("bmw");
        $wish->setIsPublished(true);
        /*
                        $wish = new Wish();
                        $wish->setDateCreated(new \DateTime());
                        $wish->setAuthor('micka');
                        $wish->setDescription('r8 v10 plus, rs6-r abt');
                        $wish->setTitle("audi");
                        $wish->setIsPublished(true);

                        $wish = new Wish();
                        $wish->setDateCreated(new \DateTime());
                        $wish->setAuthor('micka');
                        $wish->setDescription('c 63 amg');
                        $wish->setTitle("mercedes");
                        $wish->setIsPublished(true);

                        $wish = new Wish();
                        $wish->setDateCreated(new \DateTime());
                        $wish->setAuthor('micka');
                        $wish->setDescription('chiron');
                        $wish->setTitle("bugatti");
                        $wish->setIsPublished(true);
                */

        $entityManager->persist($wish);
        $entityManager->flush();
        dump($wish);

            return $this->render('wish/index.html.twig');
    }
}

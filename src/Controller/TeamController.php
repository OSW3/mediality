<?php

namespace App\Controller;

use App\Entity\Team;
use App\Entity\Users;
use App\Repository\TeamRepository;
use App\Repository\UsersRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TeamController extends AbstractController
{
    /**
     * @Route("/team", name="team")
     * @param TeamRepository $repository
     * @return Response
     */
    public function teamList(TeamRepository $repository)
    {
        $team = $repository->findAll();

        return $this->render('team/index.html.twig', [
            'team' => $team,
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NotificationsController extends AbstractController
{
    /**
     * @Route("/notifications", name="notifications")
     */
    public function notifications()
    {
        return $this->render('notifications/index.html.twig', [
            'controller_name' => 'NotificationsController',
        ]);
    }

    /**
     * @Route("/notifications/show/{id}", name="notificationsShow")
     */
    public function notificationsShow()
    {
        return $this->render('notifications/index.html.twig', [
            'controller_name' => 'NotificationsController',
        ]);
    }

    /**
     * @Route("/notifications/delete/{id}", name="notificationsDelete")
     */
    public function notificationsDelete()
    {
        return $this->render('notifications/index.html.twig', [
            'controller_name' => 'NotificationsController',
        ]);
    }
}

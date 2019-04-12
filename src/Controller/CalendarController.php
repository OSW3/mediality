<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    /**
     * @Route("/calendar-event", name="calendar_event")
     */
    public function calendarEvent()
    {
        return $this->render('calendar/calendarEvent.html.twig', [
            'controller_name' => 'CalendarController',
        ]);
    }
    /**
     * @Route("/calendar-manager", name="calendar_manager")
     */
     public function calendarManager()
     {
         return $this->render('calendar/calendarManager.html.twig', [
             'controller_name' => 'CalendarController',
         ]);
     }
}

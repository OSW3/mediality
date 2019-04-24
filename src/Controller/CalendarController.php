<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\HttpFoundation\Request;

class CalendarController extends AbstractController
{
    /**
     * @Route("/calendar-event", name="calendar_event")
     */
    public function calendarEvent(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('filterEvent', CheckboxType::class)
            ->add('filterOrder', CheckboxType::class)
            ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted()) {
                // $form->getData() renvoie les données soumises
                dump($form->getData());
                
            }
        return $this->render('calendar/calendarEvent.html.twig', [
                'form' => $form->createView(),
        ]);
    }
    
}

<?php

namespace App\EventListener;

use CalendarBundle\Entity\Event;
use App\Repository\CommandeRepository;
use App\Repository\EvenementRepository;
use CalendarBundle\Event\CalendarEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CalendarListener
{
    private $eventRepository;
    private $orderRepository;
    private $router;

    public function __construct(EvenementRepository $eventRepository, CommandeRepository $orderRepository, UrlGeneratorInterface $router)
    {
        $this->router = $router;
        $this->eventRepository = $eventRepository;
        $this->orderRepository = $orderRepository;
    }

    public function load(CalendarEvent $calendar)
    {
        $start = $calendar->getStart();
        $end = $calendar->getEnd();
        $filters = $calendar->getFilters();

        // Recupération des events
        $events = $this->eventRepository
            ->createQueryBuilder('e')
            ->where('e.dateStart BETWEEN :start and :end')
            ->setParameter('start', $start->format('Y-m-d H:i:s'))
            ->setParameter('end', $end->format('Y-m-d H:i:s'))
            ->getQuery()
            ->getResult()
        ;

        // Récupération des commandes
        $orders = $this->orderRepository
            ->createQueryBuilder('o')
            ->where('o.dateDelivery BETWEEN :start and :end')
            ->setParameter('start', $start->format('Y-m-d H:i:s'))
            ->setParameter('end', $end->format('Y-m-d H:i:s'))
            ->getQuery()
            ->getResult()
        ;
        foreach ($events as $event) {
            // this create the events with your data (here booking data) to fill calendar
            $mediaEvent = new Event(
                $event->getTitle(),
                $event->getDateStart(),
                $event->getDateEnd() // If the end date is null or not defined, a all day event is created.
            );
            $mediaEvent->setOptions([
                'backgroundColor' => '#EA4335',
                'borderColor' => '#EA4335',
            ]);
            $mediaEvent->addOption(
                'url',
                $this->router->generate('eventSingle', [
                    'id' => $event->getId(),
                ])
            );
            // finally, add the event to the CalendarEvent to fill the calendar
            $calendar->addEvent($mediaEvent);
        }
        foreach ($orders as $order) {
            // this create the events with your data (here booking data) to fill calendar
            $mediaOrder = new Event(
                $order->getTitle(),
                $order->getDateRequest(),
                $order->getDateDiffusion() // If the end date is null or not defined, a all day event is created.
            );
            $mediaOrder->setOptions([
                'backgroundColor' => '#0CA0E8',
                'borderColor' => '#0CA0E8',
            ]);
            $mediaOrder->addOption(
                'url',
                $this->router->generate('orderSingle', [
                    'id' => $order->getId(),
                ])
            );
            $calendar->addEvent($mediaOrder);
        }

    }
}
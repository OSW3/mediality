<?php

namespace App\EventListener;

use App\Repository\EvenementRepository;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CalendarListener
{
    private $eventRepository;
    private $router;

    public function __construct(EvenementRepository $eventRepository, UrlGeneratorInterface $router)
    {
        $this->router = $router;
        $this->eventRepository = $eventRepository;
    }

    public function load(CalendarEvent $calendar)
    {
        $start = $calendar->getStart();
        $end = $calendar->getEnd();
        $filters = $calendar->getFilters();

        $events = $this->eventRepository
            ->createQueryBuilder('e')
            ->where('e.dateStart BETWEEN :start and :end')
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
                'backgroundColor' => 'red',
                'borderColor' => 'red',
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
    }
}
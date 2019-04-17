
document.addEventListener('DOMContentLoaded', () => {
    var calendarEl = document.getElementById('calendar-holder');
    var calendar = new FullCalendar.Calendar(calendarEl, {

        defaultView: 'dayGridMonth',
        editable: true,
        eventSources: [
            {
                url: "/fc_load_events",
                type: "POST",
                data: {
                    filters: {},
                },
                error: () => {
                    // alert("There was an error while fetching FullCalendar!");
                },
            },
        ],
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay',
        },
        buttonText: {
            today:    "Aujourd'hui",
            month:    'Mois',
            week:     'Semaine',
            day:      'Jour',
            list:     'liste',
        },

        firstDay:1,
        plugins: [ 'interaction', 'dayGrid', 'timeGrid' ], // https://fullcalendar.io/docs/plugin-index
        timezone: ('Europe/Paris'),

    });
    calendar.setOption('locale', 'fr');
    calendar.render();
});
            
            
            
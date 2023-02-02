/*
Template Name: Minia - Admin & Dashboard Template
Author: Themesbrand
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Calendar init js
*/

!function ($) {
    "use strict";

    var CalendarPage = function () { };

    CalendarPage.prototype.init = function () {

        var defaultEvents =[];
        
        for (var clave in holidays){
            
            let fecha=holidays[clave]["date"];

            let nombre=holidays[clave]["name"];
            let fecha2=fecha.split(' ');
            let fecha3=fecha2[0].split('-');
            let ano=fecha3[0];
            let mes=fecha3[1];
            let dia=fecha3[2];
           
            let objecto={
                title:nombre,
                allDay: true,
                start:new Date(ano,mes-1,dia,0),
                className: 'bg-danger'

            }
            defaultEvents.push(objecto);
        }


        //list crew 

        console.log("crew usuarios");

        console.log(list_crew);

        for (var listado in list_crew){
            
            let usuario=list_crew[listado]["name_user"];
            console.log(usuario);
            let funcionframe=list_crew[listado]["function_frame_name"];
            console.log(funcionframe);
            let calendariousuarios=list_crew[listado]["calendar"];
            console.log(calendariousuarios);

            let colorframe=list_crew[listado]["function_frame_color"];
          //  for (var listado2 in calendariousuarios){

                let startusuario=list_crew[listado]["start_date_contract"];
                let endusuario=list_crew[listado]["finish_date_contract"];

                console.log("fecha usuario:");
                console.log(startusuario);
                console.log(endusuario);

                let startusuario2=startusuario.split(' ');
                let startusuario3=startusuario2[0].split('-');
                let ano2=startusuario3[0];
                let mes2=startusuario3[1];
                let dia2=startusuario3[2];
                console.log("aca las variables");
                console.log(ano2+mes2+dia2);

                let endusuario2=endusuario.split(' ');
                let endusuario3=endusuario2[0].split('-');
                let ano3=endusuario3[0];
                let mes3=endusuario3[1];
                let dia3=endusuario3[2];
                console.log("aca las variables");
                console.log(ano3+mes3+dia3);


                let objecto={
                    title:usuario+funcionframe,
                    start:new Date(ano2,mes2-1,dia2,0),
                    end:new Date(ano3,mes3-1,dia3,0),
                    allDay: true,
                    color:colorframe,
    
                }
                defaultEvents.push(objecto);

            //}

        }
        //defaultEvents3=defaultEvents3.substring(0,defaultEvents3.length - 1);
        //var defaultEvents=[defaultEvents3];

        console.log(defaultEvents);


        var addEvent = $("#event-modal");
        var modalTitle = $("#modal-title");
        var formEvent = $("#form-event");
        var selectedEvent = null;
        var newEventData = null;
        var forms = document.getElementsByClassName('needs-validation');
        var selectedEvent = null;
        var newEventData = null;
        var eventObject = null;
        /* initialize the calendar */

        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var Draggable = FullCalendar.Draggable;
        var externalEventContainerEl = document.getElementById('external-events');
        // init dragable
        new Draggable(externalEventContainerEl, {
            itemSelector: '.external-event',
            eventData: function (eventEl) {
                return {
                    title: eventEl.innerText,
                    className: $(eventEl).data('class')
                };
            }
        });
        var defaultEvents2 = [{
            title: 'All Day Event',
            start: new Date(y, m, 1)
        },
        {
            title: 'Long Event',
            start: new Date(y, m, d - 5),
            end: new Date(y, m, d - 2),
            className: 'bg-warning'
        },
        {
            id: 999,
            title: 'Repeating Event',
            start: new Date(y, m, d - 3, 16, 0),
            allDay: false,
            className: 'bg-info'
        },
        {
            id: 999,
            title: 'Repeating Event',
            start: new Date(y, m, d + 4, 16, 0),
            allDay: false,
            className: 'bg-primary'
        },
        {
            title: 'Meeting',
            start: new Date(y, m, d, 10, 40),
            allDay: false,
            className: 'bg-success'
        },
        {
            title: 'Lunch',
            start: new Date(y, m, d, 12, 0),
            end: new Date(y, m, d, 14, 0),
            allDay: false,
            className: 'bg-danger'
        },
        {
            title: 'Birthday Party',
            start: new Date(y, m, d + 1, 19, 0),
            end: new Date(y, m, d + 1, 22, 30),
            allDay: false,
            className: 'bg-success'
        },
        {
            title: 'Casa',
            start: new Date(y, m, 28),
            end: new Date(y, m, 29),
            url: 'http://google.com/',
            className: 'bg-dark'
        }];
        console.log(defaultEvents);

        var draggableEl = document.getElementById('external-events');
        var calendarEl = document.getElementById('calendar');

        function addNewEvent(info) {
            addEvent.modal('show');
            formEvent.removeClass("was-validated");
            formEvent[0].reset();

            $("#event-title").val();
            $('#event-category').val();
            modalTitle.text('Add Event');
            newEventData = info;
        }
        function getInitialView() {
            if (window.innerWidth >= 768 && window.innerWidth < 1200) {
                return 'timeGridWeek';
            } else if (window.innerWidth <= 768) {
                return 'listMonth';
            } else {
                return 'dayGridMonth';
            }
        }


        var calendar = new FullCalendar.Calendar(calendarEl, {
            editable: true,
            droppable: true,
            selectable: true,
            initialView: getInitialView(),
            themeSystem: 'bootstrap',
            locale: 'es',
            // responsive
            windowResize: function (view) {
                var newView = getInitialView();
                calendar.changeView(newView);
            },
            eventDidMount: function (info) {
                if (info.event.extendedProps.status === 'done') {

                    // Change background color of row
                    info.el.style.backgroundColor = 'red';

                    // Change color of dot marker
                    var dotEl = info.el.getElementsByClassName('fc-event-dot')[0];
                    if (dotEl) {
                        dotEl.style.backgroundColor = 'white';
                    }
                }
            },
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            eventClick: function (info) {
                addEvent.modal('show');
                formEvent[0].reset();
                selectedEvent = info.event;
                $("#event-title").val(selectedEvent.title);
                $('#event-category').val(selectedEvent.classNames[0]);
                newEventData = null;
                modalTitle.text('Edit Event');
                newEventData = null;
            },
            dateClick: function (info) {
                addNewEvent(info);
            },
            events: defaultEvents
        });
        calendar.render();

        /*Add new event*/
        // Form to add new event

        $(formEvent).on('submit', function (ev) {
            ev.preventDefault();
            var inputs = $('#form-event :input');
            var updatedTitle = $("#event-title").val();
            var updatedCategory = $('#event-category').val();

            // validation
            if (forms[0].checkValidity() === false) {
                // event.preventDefault();
                // event.stopPropagation();
                forms[0].classList.add('was-validated');
            } else {
                if (selectedEvent) {
                    selectedEvent.setProp("title", updatedTitle);
                    selectedEvent.setProp("classNames", [updatedCategory]);
                } else {
                    var newEvent = {
                        title: updatedTitle,
                        start: newEventData.date,
                        allDay: newEventData.allDay,
                        className: updatedCategory
                    }
                    calendar.addEvent(newEvent);
                }
                addEvent.modal('hide');
            }
        });

        $("#btn-delete-event").on('click', function (e) {
            if (selectedEvent) {
                selectedEvent.remove();
                selectedEvent = null;
                addEvent.modal('hide');
            }
        });

        $("#btn-new-event").on('click', function (e) {
            addNewEvent({ date: new Date(), allDay: true });
        });

    },
        //init
        $.CalendarPage = new CalendarPage, $.CalendarPage.Constructor = CalendarPage
}(window.jQuery),

    //initializing 
    function ($) {
        "use strict";
        $.CalendarPage.init()
    }(window.jQuery);
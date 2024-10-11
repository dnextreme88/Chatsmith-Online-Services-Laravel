import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import listPlugin from '@fullcalendar/list';
import timeGridPlugin from '@fullcalendar/timegrid';

window.FullCalendar = function() {
    return {
        initializeCalendar(eventsToAdd) {
            const today = new Date();
            const calendar = new Calendar(document.getElementById('fullcalendar-employee-schedule'), {
                plugins: [dayGridPlugin, listPlugin, timeGridPlugin],
                events: JSON.parse(eventsToAdd),
                fixedWeekCount: false,
                initialView: 'dayGridMonth',
                validRange: {
                    start: new Date(today.getFullYear(), today.getMonth() - 1, 1), // Start day of previous month
                    end: new Date(today.getFullYear(), today.getMonth() + 2, 1) // Final day of next month
                }
            });
            calendar.render();

            console.log('LOG: Initialized script for FullCalendar.');
        }
    }
}

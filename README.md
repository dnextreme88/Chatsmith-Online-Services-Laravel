# Chatsmith-Online-Services-Laravel
An Employee Management System created using the TALL stack (Tailwind, Alpine, Laravel, and Livewire). Developed way back January 30, 2020 with Laravel 6, the project was rebooted to update the framework to the latest major version (at this time of writing), Laravel 11. The system is based on one of my former employments and was designed to automate most of the company's processes instead of relying heavily on other platforms such Google Spreadsheets and Open Time Clock. The original system was hosted with WordPress.

## Features
- Admin panel for staff members to handle most of what the system offers - announcements, employees, schedules, tasks etc
- Announcements made by staff members. Latest announcements are introduced in the employee dashboard
- Clock-in/Clock-out when starting and ending shifts, respectively, instead of relying to Open Time Clock
- Contact Us form that actually works and was based on an older mockup of the website
- Dark mode toggle
- Employee logins that properly utilizes the email and username given to every employee upon being hired
- Employee productions submission formss are refactored to support all 3 production types - chats, focals, and plates. In addition, employees can now view their own productions in their dashboards and can be filtered to daily/weekly
- Employee schedules and tasks can now be plotted at any time on its own admin panel without having to wait for a week before they are created. Schedules can now be plotted in advance as necessary
- Leave requests and other kinds of form requests without having to inform supervisors in Skype
- Revamped front page that outlines the website's mission and vision (for guests) and a common dashboard (for logged in employees)

### Planned features
- Add table to store the new hire's interview results. This was the process in getting the position, as far as I remember:
    1. Have sufficient WPM (words per minute)
    2. Pass the mock chat in Skype
    3. Fields to store in a new table (to be finalized): id, user_id (null by default, so this should not be a foreign key), mock_chat_result (probably gonna use an Enum class? - Passed/Failed), wpm (int), reviewed_by (user_id of staff who reviewed the applicant), date_applied
    4. Display these fields in the Profile page of the employee
- Include the COS handbook in the Dashboard so employees can view them at will. Allow downloads as well
- List of highest productions based on time period (daily, this week, this month) for chats, focals, and plates. The top performing employee should be given emphasis to stand out eg. higher font size
- Real-time notifications such as receiving announcements using Laravel Reverb. Since this is a small app, we can just refresh the notification bell component instead with `wire:poll`
- Receiving of salaries based on basic pay along with the ability to download/export to Excel (will probably use Laravel Excel for this feature). Must also include deductions to SSS, PhilHealth, Pag-IBIG etc.
- Stats for certain criteria to be placed in the admin panel (eg. production rates for chats, focals, and plates). A good package to use is `flowframe/laravel-trend`. Filters include last/this week, last/this month, last/this year

## Installation
1. Clone this repository somewhere on your computer. On your IDE, such as Visual Studio Code, go to the directory and open via `code .`
2. Run `composer i` to install Composer dependencies
3. Run `npm i` to install packages
4. Create a database using your `.env` variables. Run `php artisan migrate:fresh --seed` to populate the database with random data.
5. Run `php artisan serve` to run the server for local development
6. Run `npm run dev` to run Vite

## Software Development Tools
- VSCode
- XAMPP

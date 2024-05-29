document.addEventListener('DOMContentLoaded', function() {
    const readMoreText = document.querySelectorAll('.read-more-text');
    readMoreText.forEach(el => {
        el.addEventListener('click', function(ev) {
            el.previousElementSibling.classList.remove('m-0', 'text-ellipsis'); // Targets class .announcement-description
            el.classList.add('d-none');

            ev.preventDefault();
        });
    });

    console.log('LOG: Initialized script for Announcements component.');
});

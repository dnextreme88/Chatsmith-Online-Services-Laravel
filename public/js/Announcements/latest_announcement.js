document.addEventListener('DOMContentLoaded', function() {
    const announcementDescription = document.getElementsByClassName('latest-announcement-description')[0];
    const readMoreText = document.getElementsByClassName('read-more-text')[0];

    readMoreText.addEventListener('click', function() {
        announcementDescription.classList.remove('m-0', 'text-ellipsis');
        readMoreText.classList.add('d-none');
    });

    console.log('LOG: Initialized script for Latest Announcements component.');
});

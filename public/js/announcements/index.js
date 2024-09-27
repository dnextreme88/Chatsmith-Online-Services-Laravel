console.log('LOG: Initialized script for Announcements component.');

var readMore = document.getElementsByClassName('read-more-text');
if (readMore.length > 0) {
    console.log('LOG: Read more text elements found in DOM.');
    expandReadMoreText();
}

function expandReadMoreText() {
    const readMoreText = document.querySelectorAll('.read-more-text');
    readMoreText.forEach(el => {
        el.addEventListener('click', function(ev) {
            el.previousElementSibling.classList.remove('m-0', 'truncate-text-with-dots');
            el.classList.add('hidden');

            ev.preventDefault();
        });
    });
}

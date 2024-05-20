document.addEventListener('DOMContentLoaded', function() {
    console.log('LOG: Initialized script for homepage');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            console.log('entry: ', entry);

            if (entry.isIntersecting) {
                entry.target.classList.add('shown');
            } else {
                entry.target.classList.remove('shown');
            }
        });
    });

    const hiddenElements = document.querySelectorAll('.hidden-fade-on-show');
    hiddenElements.forEach((el) => observer.observe(el));
});

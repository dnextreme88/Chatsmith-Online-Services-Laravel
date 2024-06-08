var timeElement = document.getElementById('time');

if (timeElement) {
    console.log('LOG: #time element found in DOM. Running timer...');
    setInterval(showCurrentTime, 1000);
}

function showCurrentTime() {
    var date = new Date();
    const currentDate = new Date(
        date.getFullYear(), date.getMonth(), date.getDate(), date.getHours(), date.getMinutes(), date.getSeconds()
    );

    timeElement.innerHTML = currentDate.toLocaleString('en-US', {
        hour12: true, month: 'long', day: 'numeric', year: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric'
    });
}

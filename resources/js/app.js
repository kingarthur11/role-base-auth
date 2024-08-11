import './bootstrap';

window.Echo.channel('channel-name')
    .listen('YourEventName', (event) => {
        console.log('Event received:', event);
    });
import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;
Pusher.logToConsole=true;
window.Echo = new Echo({
    broadcaster: 'pusher', // Changed from 'reverb' to 'pusher'
    key: import.meta.env.VITE_PUSHER_APP_KEY, // Ensure this is set correctly
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER, // Add cluster if needed
    wsHost: import.meta.env.VITE_PUSHER_HOST, // Update host for Pusher
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80, // Update port for Pusher
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443, // Update secure port for Pusher
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https', // Update scheme for Pusher
    enabledTransports: ['ws', 'wss'],
});

window.Echo.channel('channel1')
    .listen('myevent1', (e) => {
        console.log(e.message);
    });

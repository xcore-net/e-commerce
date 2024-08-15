import Echo from "laravel-echo";
import Pusher from "pusher-js";
window.Pusher = Pusher;
Pusher.logToConsole = true;

// window.Echo = new Echo({ broadcaster: "pusher", key: import.meta.env.VITE_PUSHER_APP_KEY })

let echo = new Echo({
    broadcaster: "pusher",
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? "ap2",
    wsHost: import.meta.env.VITE_PUSHER_HOST
        ? import.meta.env.VITE_PUSHER_HOST
        : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? "https") === "https",
    enabledTransports: ["ws", "wss"],
});
echo.channel("notifications").listen(".LowStock", (e) => {
    alert("Low stock alert!");
    console.log(e.message);
});

// window.Echo = new Echo({
//     broadcaster: 'reverb',
//     key: import.meta.env.VITE_REVERB_APP_KEY,
//     wsHost: import.meta.env.VITE_REVERB_HOST,
//     wsPort: import.meta.env.VITE_REVERB_PORT,
//     wssPort: import.meta.env.VITE_REVERB_PORT,
//     forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

console.log(window.Echo);

// window.Echo.channel.bind("LowStock", function (data) {
//     alert("Low stock alert!");
//     alert(JSON.stringify(data));
// });

// window.Echo.listen("notifications","LowStock", (e) => {
//     alert("Low stock alert!");
//     console.log(e.message);
// });

// window.Echo.channel("notifications").listen("OutOfStock", (e) => {
//     alert("Out of stock alert!");
//     console.log(e.data);
// });

// window.Echo.private("App.Models.User." + userId).notification((LowStock) => {
//     console.log(LowStock.type);
// });

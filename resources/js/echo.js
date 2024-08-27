import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
    encrypted: true
});

// import Echo from "laravel-echo";
// import Pusher from "pusher-js";
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
//     forceTLS: true,
//     encrypted: true,
//     authEndpoint: '/broadcasting/auth',
//     auth: {
//         headers: {
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
//             'Authorization': "Bearer 16|JgxukrzwDFxhIHb5kSxIQDJYI6QmReGuj9Nmz2Ub7cbded03",
//             'X-Requested-With': 'XMLHttpRequest',
//         },

//     },
// });



// console.log(import.meta.env.VITE_PUSHER_APP_KEY);  
// console.log(import.meta.env.VITE_PUSHER_APP_CLUSTER); 

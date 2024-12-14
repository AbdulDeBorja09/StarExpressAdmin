import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: "3ba047d26d60c31ed932",
    cluster: "ap1",
    encrypted: true,
});

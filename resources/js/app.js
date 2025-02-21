import Pusher from "pusher-js";
import $ from "jquery";
window.$ = window.jQuery = $;

Pusher.logToConsole = false;
const pusher = new Pusher("3ba047d26d60c31ed932", {
    cluster: "ap1",
});

const channel = pusher.subscribe("new-order-channel");
channel.bind("new-order-notification", function (data) {
    let notifications = JSON.parse(localStorage.getItem("notifications")) || [];
    const notification = {
        order_reference: data.order_reference,
        order_id: data.order_id,
        timestamp: new Date().toISOString(),
        read: false,
    };
    notifications.push(notification);
    localStorage.setItem("notifications", JSON.stringify(notifications));
    displayNotifications();
});

function displayNotifications() {
    const notifications =
        JSON.parse(localStorage.getItem("notifications")) || [];
    document.getElementById("totalnotifcount").textContent =
        notifications.length;

    const notificationList = document.getElementById("notification-list");
    notificationList.innerHTML = "";

    notifications.forEach((notification, index) => {
        const notificationItem = document.createElement("li");
        notificationItem.classList.add("dark:text-white-light/90");

        notificationItem.innerHTML = `
            <div class="group flex items-center px-4 py-2" @click.self="toggle">
                <div class="flex flex-auto ltr:pl-3 rtl:pr-3">
                    <div class="ltr:pr-3 rtl:pl-3 py-2">
                        <h6><strong>New! ${notification.order_reference}</strong></h6>
                        <span class="block text-xs font-normal dark:text-gray-500 time-ago" data-timestamp="${notification.timestamp}"></span>
                    </div>
                    <button type="button"
                        class="text-neutral-300 opacity-0 hover:text-danger group-hover:opacity-100 ltr:ml-auto rtl:mr-auto"
                        onclick="redirectToDetails('${notification.order_reference}')">
                        <svg width="20" height="20" viewbox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="1.5"></circle>
                            <path d="M14.5 9.50002L9.5 14.5M9.49998 9.5L14.5 14.5" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round"></path>
                        </svg>
                    </button>
                </div>
            </div>
        `;
        notificationList.appendChild(notificationItem);
    });
    updateTimeAgo();
}

function updateTimeAgo() {
    const timeAgoElements = document.querySelectorAll(".time-ago");
    timeAgoElements.forEach((element) => {
        const timestamp = element.getAttribute("data-timestamp");
        element.textContent = timeAgo(timestamp);
    });
}

function timeAgo(timestamp) {
    const now = new Date();
    const diffInSeconds = Math.floor((now - new Date(timestamp)) / 1000);

    if (diffInSeconds < 60) return `${diffInSeconds} seconds ago`;
    const diffInMinutes = Math.floor(diffInSeconds / 60);
    if (diffInMinutes < 60) return `${diffInMinutes} minutes ago`;
    const diffInHours = Math.floor(diffInMinutes / 60);
    if (diffInHours < 24) return `${diffInHours} hours ago`;
    const diffInDays = Math.floor(diffInHours / 24);
    return `${diffInDays} days ago`;
}

document.addEventListener("DOMContentLoaded", function () {
    displayNotifications();
    setInterval(updateTimeAgo, 1000);
});

import "./bootstrap";

import axios from "axios";

const url = new URL(window.location.href);

const id = url.pathname.split("/").pop();

const messageInput = document.getElementById("messageInput");

const message = messageInput.value;

const channelName = `daryaft-payam.${Math.min(id, userId)}.${Math.max(id, userId)}`;

window.Echo.private(channelName).listen(".daryaft.payam", (e) => {
    const messages = document.getElementById("message-box");
    const messageElement = document.createElement("p");
    console.log(e);
    if (id == e.id_from) {
        messageElement.classList.add("to-message");
    } else {
        messageElement.classList.add("your-message");
    }
    messageElement.innerText = e.message;
    messages.appendChild(messageElement);
});

window.sendPayam = function () {
    const messageInput = document.getElementById("messageInput");
    const message = messageInput.value;
    axios
        .post(
            "/ersal/payam",
            { message: message, id: +id },
            {
                // headers: {
                //     Authorization: `Bearer ${token}`
                // },
            }
        )
        .then((response) => {
            console.log(response.data);
            // Clear the input field after sending
            messageInput.value = "";
        })
        .catch((error) => console.error(error));

    console.log("payamak shod");
};

import axios from "axios";

window.Echo.channel('chatroom')
    .listen('.message.sent', (e) => {
        console.log('ersal ersal');
        console.log(e);
        // Append the new message to the chatroom
        const messages = document.getElementById('messages');
        const messageElement = document.createElement('p');
        messageElement.innerText = e.message;
        messages.appendChild(messageElement);
    });


window.sendMessage = function() {
    const messageInput = document.getElementById('messageInput');
    const message = messageInput.value;
    axios.post('/chat/send-message', { message: message })
        .then(response => {
            console.log(response.data);
            // Clear the input field after sending
            messageInput.value = '';
        })
        .catch(error => console.error(error));

    console.log('sent message');

};

window.Echo.private('ersal')
    .listen('.message.send', (e) => {
        console.log('resid resid');
        console.log(e);
        const messages = document.getElementById('messages');
        const messageElement = document.createElement('p');
        messageElement.innerText = e.message;
        messages.appendChild(messageElement);
    });

window.send = function() {

    const messageInput = document.getElementById('messageInput');
    const message = messageInput.value;
    const mobile = document.getElementById('mobile');
    const phone = mobile.value;
    const token = '15|SIv8gtlnzEBOfO8GlAxJavlUV7uZlFCWEsjGWXy81120e384';
    axios.post('/api/send/message', { message: message, mobile: phone }, {headers: {'Authorization': `Bearer ${token}`}})
        .then(response => {
            console.log(response.data);
            messageInput.value = '';
        })
        .catch(error => console.error(error));

    console.log('sent message');
    
};
/**
 * Get all tweet from data base and displays them
 */
function getMessages(){
    const request = new XMLHttpRequest();
    request.open("GET", "?action=message");

    request.onload = function(){
        const resultat = JSON.parse(request.responseText);
        const html = resultat.map(function(message){
        return `
        <div class="message">
          <span class="date">${message.creation}</span>
          <span class="author"><a href="?action=profile">${message.username}</a></span> : 
          <hr>
          <span class="content">${message.message}</span> <br>
          <span class="rtBtn"> <i class="fas fa-retweet"></i> </span>
          <span class="rtBtn"> <i class="fas fa-heart"></i> </span>
        </div>`;
        }).join('');

        const messages = document.querySelector('.messages');

        messages.innerHTML = html;
        messages.scrollTop = messages.scrollHeight;


        const rtBtn = document.querySelectorAll('.rtBtn');
        for (var i in rtBtn) {
            console.log('test');
            
            rtBtn[i].onclick = function () {
                console.log('coucou');
            }
        };

    };

    request.send();
}

/**
 * Post message to data base with content, username and date and call getMessage() function
 * @param event
 */
function postMessage(event){
    event.preventDefault();
    const content = document.querySelector('#content');
    if (content.value === '') {
        const errorBlock = document.querySelector('.errorBlock');
        return errorBlock.innerHTML = 'message cannot be empty';
    }

    const data = {
        content: content.value
    };

    const request = new XMLHttpRequest();
    request.open('POST', '?action=message');
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onload = function(){
        content.value = '';
        content.focus();
        getMessages();
    };

    request.send(JSON.stringify(data));
}

document.querySelector('form').addEventListener('submit', postMessage);

//const interval = window.setInterval(getMessages, 3000);

getMessages();

function alreadyRt() {
    console.log('sakr');
}
  

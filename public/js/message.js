k = 0;

function messageBox(i, img, name, friend_id, user_id, token) {
    console.log(img);
    var image = window.parent.document.getElementById("messageUserImage");
    var text = window.parent.document.getElementById("messageUserText");
    if (i == 1)
        image.src = img;
    else
        image.src = "../" + img;
    text.setAttribute('onclick', 'profile(' + friend_id + ')');
    text.innerText = name;
    var send = window.parent.document.getElementById("send");
    send.setAttribute('onclick', 'newmessage(' + friend_id + ',' + user_id + ',"' + token + '")');
    var inputtext = window.parent.document.getElementById("textMessage");
    inputtext.setAttribute('onkeyup', 'waiting(' + friend_id + ',' + user_id + ',"' + token + '")');
    var iframe = window.parent.document.getElementById('message');
    if (i == 1)
        iframe.src = "message/" + friend_id;
    else
        iframe.src = "../message/" + friend_id;
    var form = window.parent.document.getElementsByClassName("message")[0];
    form.setAttribute('style', 'display:block');
    respond(user_id, friend_id, token);
    try {
        window.parent.document.getElementById("warn" + friend_id).style.display = "none";
    } catch {}
}

function closeMsgBox() {
    var form = document.getElementsByClassName("message")[0];
    form.setAttribute('style', 'display:none');
    var iframe = document.getElementById('message');
    iframe.src = "message/" + 0;
}

function waiting(fromid, toid, token) {
    if (k == 0) {
        k++
        console.log("wait");
        $.ajax({
            method: 'POST',
            type: 'POST',
            url: '/waiting',
            dataType: 'json',
            data: {
                'id': toid,
                'friend': fromid,
                '_token': token,
            },
        });
    }
}

function respond(toid, fromid, token) {
    var form_data = new FormData();
    k = 0;
    form_data.append('_token', token);
    var refreshId = setInterval(function() {
        $.ajax({
            method: 'POST',
            type: "POST",
            url: '/respond',
            dataType: 'text', // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: {
                'id': toid,
                'friend': fromid,
                '_token': token,
            },
            success: function(php_script_response) {
                k = php_script_response;
            }
        });
    }, 1000);
    // if (k == 0) {
    //     var message = window.parent.document.getElementById("message").contentWindow;
    //     console.log(message);
    //     var pic = message.document.getElementById("waiting");
    //     pic.setAttribute("style", "display:none");
    //     console.log(pic);
    // } else {
    //     var message = window.parent.document.getElementById("message").contentWindow;
    //     console.log(message);
    //     var pic = message.document.getElementById("waiting");
    //     pic.style.display = 'block';
    //     pic.setAttribute("style", "display:none");
    // }
}

function openmsg(e, num, num2, img, name, token) {
    var image = document.getElementById("messageUserImage");
    var text = document.getElementById("messageUserText");
    image.src = img;
    text.innerText = name;
    var send = document.getElementById("send");
    send.setAttribute('onclick', 'newmessage(' + num + ',' + num2 + ',"' + token + '")');
    var iframe = document.getElementById('message');
    iframe.src = "message/" + num;
    var form = document.getElementsByClassName("message")[0];
    form.setAttribute('style', 'display:block');
    var number = document.getElementsByClassName('msgs')[0];
    number.style.display = 'none';
    e.style.display = 'none';
}

function newmessage(fromid, toid, token) {
    var message = window.parent.document.getElementById("textMessage");
    console.log(message.value);
    $.ajax({
        method: 'POST',
        type: 'POST',
        url: '/saveMessage',
        dataType: 'json',
        data: {
            'id': toid,
            'friend': fromid,
            'message': message.value,
            '_token': token,
        },
    });
    var iframe = window.parent.document.getElementById('message');
    iframe.src = "message/" + fromid;
    message.value = "";
}
var load = false;

function pageScroll() {

    if (!load) {
        window.scrollBy(0, 2500);

        scrolldelay = setTimeout('pageScroll()', 50); //Increase this # to slow down, decrease to speed up scrolling
    }
    load = true;

}
loaders = document.getElementsByClassName('loader-wrapper');

function change(self) {
    for (var i = loaders.length - 1; i >= 0; i--) {
        loaders[i].style.display = "none";
    }
    id = self.id;
    loaders[id - 1].style.display = "inherit";
};
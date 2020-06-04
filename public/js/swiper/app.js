/* -----------------------------------------------
/* How to use? : Check the GitHub README
/* ----------------------------------------------- */

/* To load a config file (particles.json) you need to host this demo (MAMP/WAMP/local)... */
/*
particlesJS.load('particles-js', 'particles.json', function() {
  console.log('particles.js loaded - callback');
});
*/

/* Otherwise just put the config content (json): */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function addFriend(btn, id1, id2, token) {
    $.ajax({

        method: 'POST',
        type: 'POST',
        url: '/AddFriend',
        dataType: 'json',
        data: {
            'id': id1,
            'friend': id2,
            '_token': token
        },
        success: function(php_script_response) {
            window.location.href = window.location.href;
        }
    });
    btn.classList.remove("request");
    btn.classList.add("wait");
    btn.innerHTML = "wait";
    btn.setAttribute('onclick', "");
}

function acceptFriends(btn, id1, id2, token) {
    $.ajax({

        method: 'POST',
        type: 'POST',
        url: '/AcceptFriend',
        dataType: 'json',
        data: {
            'id': id1,
            'friend': id2,
            '_token': token,

        },
        success: function(php_script_response) {
            btn.classList.remove("accept");
            btn.classList.add("remove");
            btn.innerHTML = "Remove";
            btn.setAttribute('onclick', "removeFriend(this," + id1 + "," + id2 + ",'" + token + "')");
            window.location.href = window.location.href;
        }
    });

}

function acceptFriend(num, btn, id1, id2, token) {
    $.ajax({

        method: 'POST',
        type: 'POST',
        url: '/AcceptFriend',
        dataType: 'json',
        data: {
            'id': id1,
            'friend': id2,
            '_token': token
        },
        success: function(php_script_response) {
            window.location.href = window.location.href;
        }
    });
}

function refuseFriend(num, btn, id1, id2, token) {
    $.ajax({

        method: 'POST',
        type: 'POST',
        url: '/refuseFriend',
        dataType: 'json',
        data: {
            'id': id1,
            'friend': id2,
            '_token': token
        },
        success: function(php_script_response) {
            window.location.href = window.location.href;
        }
    });
    if (num == 1) {
        document.getElementById('friendsCount').style.display = 'none';
    } else
        document.getElementById('friendsCount').innerHTML = num - 1;
    document.getElementById('friends').src = '/friends';
}

function removeFriend(btn, id1, id2, token) {
    $.ajax({

        method: 'POST',
        type: 'POST',
        url: '/RemoveFriend',
        dataType: 'json',
        data: {
            'id': id1,
            'friend': id2,
            '_token': token
        },
        success: function(php_script_response) {
            window.location.href = "timeline";
        }
    });
    btn.classList.remove("btn-danger");
    btn.classList.add("btn-primary");
    btn.innerHTML = "add";
    btn.setAttribute('onclick', "addFriend(this," + id2 + "," + id1 + ",'" + token + "')");
}

function removeFriend(num, btn, id1, id2, token) {
    $.ajax({

        method: 'POST',
        type: 'POST',
        url: '/RemoveFriend',
        dataType: 'json',
        data: {
            'id': id1,
            'friend': id2,
            '_token': token
        },
        success: function(php_script_response) {
            window.location.href = "../timeline";
        }
    });
    parent.document.getElementById('friends').src = "friends";
    parent.document.getElementById('test').src = "welcome";
    parent.document.getElementsByClassName('message')[0].style.display = "none";
}
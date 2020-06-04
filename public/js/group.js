function group_post(token) {
    var text = document.getElementById('text2').value;
    var file_data = '';
    if ($("#imgpost").prop('files')[0] != null && document.getElementById("imgstate").value != 1) {
        file_data = $("#imgpost").prop('files')[0];
    }
    var form_data = new FormData();
    console.log(file_data);
    form_data.append('image', file_data);
    form_data.append('_token', token);
    form_data.append('text', text);
    $.ajax({
        method: 'POST',
        type: 'POST',
        url: '/group_post',
        dataType: 'text', // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        success: function() {
            setTimeout(function() {
                window.location.href = window.location.href;
            }, 500);
        }
    });

}

function Following(btn, id, token) {
    $.ajax({
        method: 'POST',
        type: 'POST',
        url: '/followgroup',
        dataType: 'json',
        data: {
            'id': id,
            '_token': token
        },
        success: function() {}
    });
    btn.classList.remove("btn-primary");
    btn.classList.add("btn-warning");
    btn.innerHTML = "Wait";
    btn.disabled = true;
}

function UnFollowing(btn, id, token) {
    var button = btn;
    $.ajax({
        method: 'POST',
        type: 'POST',
        url: '/unfollowgroup',
        dataType: 'json',
        data: {
            'id': id,
            '_token': token
        },
        success: function() {

        }
    });
    button.classList.remove("btn-danger");
    button.classList.add("btn-primary");
    button.innerHTML = "Join";
    button.setAttribute('onclick', "Following(this," + id + ",'" + token + "')");
}

function accept(group, notification, id, token) {
    $.ajax({

        method: 'POST',
        type: 'POST',
        url: '/acceptadd',
        dataType: 'json',
        data: {
            'id': id,
            'group': group,
            'notification': notification,
            '_token': token
        },
        sucess: function() {}
    });
    parent.document.getElementById('noti2' + notification).style.display = 'none';
}

function refuse(group, notification, id, token) {
    console.log(id);
    $.ajax({

        method: 'POST',
        type: 'POST',
        url: '/refuseadd',
        dataType: 'json',
        data: {
            'id': id,
            'group': group,
            'notification': notification,
            '_token': token
        },
        sucess: function() {}
    });
    parent.document.getElementById('noti2' + notification).style.display = 'none';
}
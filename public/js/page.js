function page_post(token) {
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
        url: '/page_post',
        dataType: 'text', // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        success: function(php_script_response) {
            window.location.href = window.location.href;
        }
    });

}

function Following(btn, id, token) {
    $.ajax({
        method: 'POST',
        type: 'POST',
        url: '/follow',
        dataType: 'json',
        data: {
            'id': id,
            '_token': token
        },


    });
    btn.classList.remove("btn-primary");
    btn.classList.add("btn-danger");
    btn.innerHTML = "UnFollow";
    btn.setAttribute('onclick', "UnFollowing(this," + id + ",'" + token + "')");
}

function UnFollowing(btn, id, token) {
    $.ajax({
        method: 'POST',
        type: 'POST',
        url: '/unfollow',
        dataType: 'json',
        data: {
            'id': id,
            '_token': token
        },


    });
    btn.classList.remove("btn-danger");
    btn.classList.add("btn-primary");
    btn.innerHTML = "Follow";
    btn.setAttribute('onclick', "Following(this," + id + ",'" + token + "')");
}

function Admin(friend, type, token) {
    if (type == 'add') {
        var id = document.getElementById('name').value;
        var length = document.getElementById('name').length;
    } else {
        var length = 1;
        var id = friend;
    }
    if (length > 0) {
        var form_data = new FormData();
        form_data.append('id', id);
        form_data.append('_token', token);
        form_data.append('type', type);
        $.ajax({
            method: 'Post',
            url: '/page_admin',
            dataType: 'text', // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'Post'
        });
        setTimeout(function() {
            window.location.href = window.location.href;
        }, 500);
    }
}
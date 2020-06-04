var modal = document.getElementById("myModal");
var image = document.getElementById("image");
var cover = document.getElementById("myform");
var imageedit = document.getElementById("changeImage");
// Get the button that opens the modal
var btn = document.getElementById("myBtn");
// When the user clicks on the button, open the modal 
function kiko(e) {

}

function empty(e) {
    document.getElementsByClassName('file-path validate')[0].value = "";
}

var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];

function Validate() {
    var arrInputs = document.getElementById("form1").getElementsByTagName("input");
    for (var i = 0; i < arrInputs.length; i++) {
        var oInput = arrInputs[i];
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }

                if (!blnValid) {
                    alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                    document.getElementById("imgstate").value = 1;
                    return false;
                }
            }
        }
    }
    document.getElementById("imgepost").innerHTML = "Image selected";
    document.getElementById("imgpost").style.display = "none";

    return true;
}


function state(token) {
    var form_data = new FormData();
    form_data.append('_token', token);
    setInterval(function() {
        $.ajax({
            method: 'POST',
            type: 'POST',
            type: "POST",
            url: '/state',
            dataType: 'text', // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            success: function(php_script_response) {
                console.log(php_script_response);
            }
        });
    }, 10000);
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    var modal = document.getElementById("myModal");
    var image = document.getElementById("image");
    var cover = document.getElementById("changeCover");
    var info = document.getElementById("changeInfo");
    var imageedit = document.getElementById("changeImage");
    var imageform2 = document.getElementById("myform");
    var imageform = document.getElementById("myform2")
    var infoform = document.getElementById("myform3");

    if (event.target == modal) {
        modal.style.display = "none";
        parent.document.body.setAttribute('style', 'overflow: auto;');
    }
    if (event.target == imageform) {
        cover.style.display = "none";
        image.style.display = "none";
        imageedit.style.display = "none";
        info.style.display = "none";
        parent.document.body.setAttribute('style', 'overflow: auto;');
    }
    if (event.target == image) {
        image.style.display = "none";
        cover.style.display = "none";
        imageedit.style.display = "none";
        info.style.display = "none";
        parent.document.body.setAttribute('style', 'overflow: auto;');
    }
    if (event.target == imageform2 || event.target == infoform) {
        image.style.display = "none";
        cover.style.display = "none";
        imageedit.style.display = "none";
        info.style.display = "none";
        parent.document.body.setAttribute('style', 'overflow: auto;');
    }
}

function show_name() {
    document.getElementById("name").style.display = 'block';
    if ($('#password-new').css('display') == 'none')
        document.getElementById('info').disabled = false;
}

function show_pass() {
    document.getElementById("password-old").style.display = 'block';
    document.getElementById('info').disabled = true;
}

function text() {
    if (document.getElementById("text2").getAttribute('rows') == "1") {
        document.getElementById("text2").setAttribute('rows', "5");
        document.getElementById("cont").setAttribute('style', 'top:105;');
        document.getElementsByClassName("post")[0].setAttribute('style', "height:250");

    } else {

        document.getElementById("text2").setAttribute('rows', "1");
        document.getElementById("cont").setAttribute('style', 'top:10;');
        document.getElementsByClassName("post")[0].setAttribute('style', "height:157");
    }
}

function coverChange() {
    var cover = document.getElementById("changeCover");
    cover.style.display = 'block';
}

function coverImage() {
    var cover = document.getElementById("changeImage");
    cover.style.display = 'block';
}

function changeInfo() {
    var cover = document.getElementById("changeInfo");
    cover.style.display = 'block';
}

function openOption() {
    var options = document.getElementById('options');
    if (options.getAttribute('style') == 'display:none;') {
        options.setAttribute('style', 'display:block;');
    } else
        options.setAttribute('style', 'display:none;');
    console.log(options.display);

}

function inputimg(e) {
    const regex = /[\d*|\D*]\.jpg|[\d*|\D*]\.png|[\d*|\D*]\.JPG/gm;
    if ((m = regex.exec(e.files[0].name)) !== null) {
        document.getElementById("inputlabel").innerHTML = (e.files[0].name).slice(-25);
        document.getElementById("mail4").disabled = false;
    } else {
        document.getElementById("mail4").disabled = true;
        console.log(e.files[0].name);
    }
}

function inputImg(e) {
    const regex = /[\d*|\D*]\.jpg|[\d*|\D*]\.png|[\d*|\D*]\.JPG/gm;
    if ((m = regex.exec(e.files[0].name)) !== null) {
        document.getElementById("imageChanger").innerHTML = (e.files[0].name).slice(-25);
        document.getElementById("img").disabled = false;
    } else {
        document.getElementById("img").disabled = true;
        console.log(e.files[0].name);
    }
}

function Update(name, n, token) {
    if (n != "info") {
        var file_data = $("#customFile").prop('files')[0];
        if (n == 'image' || n == 'pageimage' || n == 'groupimage') {
            file_data = $("#customFile2").prop('files')[0];
        }
        var form_data = new FormData();
        console.log(file_data);
        form_data.append('image', file_data);
        form_data.append('type', n);
        form_data.append('_token', token);
        $.ajax({
            url: '/welcome',
            dataType: 'text', // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            method: 'POST',
            type: 'POST',
            success: function(php_script_response) {
                window.top.location.reload();
            }
        });
        if (n == 'cover' || n == 'image') {
            this.updatePost(name + ' has updated his ' + n, file_data, 0, token);
        }
        if (n == 'coverPage' || n == 'pageimage')
            this.updatePost(name + ' has updated his ' + n, file_data, 1, token);
        if (n == 'coverGroup' || n == 'groupimage')
            this.updatePost(name + ' has updated his ' + n, file_data, 1, token);


    } else {
        var form_data = new FormData();
        console.log(file_data);
        name = document.getElementById('name').value;
        pass = document.getElementById('password-new').value;
        form_data.append('name', name);
        form_data.append('pass', pass);
        form_data.append('_token', token);
        $.ajax({
            url: '/updateInfo',
            dataType: 'text', // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(php_script_response) {
                window.top.location.reload();
            }
        });
        // window.top.location.reload();
    }
}

function deletePost(post, token) {
    var form_data = new FormData();
    form_data.append('post', post);
    form_data.append('_token', token);
    $.ajax({
        url: '/deletePost',
        dataType: 'text', // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(php_script_response) {
            console.log(php_script_response); // display response from the PHP script, if any
        }
    });
    window.location.href = window.location.href;
}

function updatePost(text, file_data, page, token) {
    var form_data = new FormData();
    console.log(file_data);
    form_data.append('image', file_data);
    form_data.append('_token', token);
    form_data.append('text', text);
    form_data.append('page', page);
    $.ajax({
        url: '/post',
        dataType: 'text', // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(php_script_response) {
            console.log(php_script_response); // display response from the PHP script, if any
        }
    });
    setTimeout(function() {
        window.location.href = window.location.href;
    }, 1000);
}

function post(token) {
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
        type: "POST",
        url: '/post',
        dataType: 'text', // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'POST',
        success: function(php_script_response) {
            console.log(php_script_response); // display response from the PHP script, if any
            window.location.href = '/welcomepost0';
        }
    });
    // setTimeout(function() {
    //     window.location.href = '/welcomepost0';
    //}, 500);
}

function timelinepost(token) {
    var text = document.getElementById('text2').value;
    var file_data = '';
    if ($("#imgpost").prop('files')[0] != null) {
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
        type: "POST",
        url: '/post',
        dataType: 'text', // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        success: function(php_script_response) {
            setTimeout(function() {
                window.location.href = window.location.href;
            }, 500);
        }
    });

}

function share(btn, post, token) {
    $.ajax({
        method: 'POST',
        type: 'POST',
        url: '/share',
        type: "POST",
        dataType: 'json',
        data: {
            'post': post,
            '_token': token
        },
    });
    btn.removeAttribute(onclick, "");
}

function prop(i) {
    let group = document.getElementById('prop' + i);
    if (group.classList.contains('active')) {
        group.classList.remove('active');
    } else
        document.getElementById('prop' + i).classList.add('active');
    console.log(i);

}

function like(post, user, type, token, number, img, liked, id) {
    $.ajax({
        method: 'POST',
        type: 'POST',
        url: '/like',
        type: "POST",
        dataType: 'json',
        data: {
            'post': post,
            'from_id': user,
            'user_id': id,
            'type': type,
            '_token': token
        },
    });
    if (type == 1) {
        document.getElementById('like' + post).innerHTML = "<i  class='fa fa-thumbs-up'style='color: darkcyan;'>Like</i>";
    }
    if (type == 2) {
        document.getElementById('like' + post).innerHTML = "<i  class='fas fa-grin-hearts'style='color: hotpink;'>Love</i>";
    }
    if (type == 3) {
        document.getElementById('like' + post).innerHTML = "<i  class='fas fa-laugh-squint'style='color: gold;'>Haha</i>";
    }
    if (type == 4) {
        document.getElementById('like' + post).innerHTML = "<i  class='fas fa-angry'style='color: crimson;'>Angry</i>";
    }
    if (type == 5) {
        document.getElementById('like' + post).innerHTML = "<i  class='fas fa-sad-tear' style='color: indigo;'>Sad</i>";
    }
    document.getElementById('like' + post).classList.add('active');
    if (liked == '0') {
        console.log(liked);
        document.getElementById("reaction" + post).style.display = 'none';
        if (number == 0) {
            document.getElementById('likeList' + post).innerHTML = "<span><a href='#'><img src='..\\" + img + "' /></a></span><span id='reaction'" + post + "' class = 'reaction'>React on this</span>";
        }
        if (number == 1) {
            console.log(document.getElementById('likeList' + post).innerHTML);
            document.getElementById('likeList' + post).innerHTML = document.getElementById('likeList' + post).innerHTML.replace('<span style="display:block;">', '<span class="no">') + "<span><a href='#'><img src='..\\" + img + "' /></a></span><span id='reaction'" + post + "' class = 'reaction'>React on this</span>";
        }
        if (number == 2) {
            document.getElementById('likeList' + post).innerHTML = document.getElementById('likeList' + post).innerHTML.replace('<span style="display:block;">', '<span class="no">') + "<span><a href='#'><img src='..\\" + img + "' /></a></span><span id='reaction'" + post + "' class = 'reaction'>React on this</span>";
        }
        if (number == 3) {
            document.getElementById('likeList' + post).innerHTML = document.getElementById('likeList' + post).innerHTML.replace('<span style="display:block;">', '<span class="no">') + "<span id='count'><a href='#'>+" + (number - 2) + " others</a></span>";
        }
        if (number > 3) {
            document.getElementById('count' + post).innerHTML = "<span id='count'><a href='#'>+" + (number - 2) + " others</a></span>";
        }
    }
}

function addComment(post, user, image, name, token) {
    var text = document.getElementById('textarea' + post).value;
    if (text != "") {
        $.ajax({
            method: 'POST',
            type: 'POST',
            url: '/comment',
            type: "POST",
            dataType: 'json',
            data: {
                'post': post,
                'text': text,
                '_token': token,
                'user': user
            }
        });
        var texting = "<div class='comment comment_div'>" +
            "<div class='add'>" + "<div class='profile'>" + "<img src='" + image + "' alt='' /></div>" +
            "<h3>" + name + "</h3>" +
            "<p>" + text + "</p></div></div>";
        console.log(texting);
        document.getElementById('post_comment' + post).innerHTML += texting;
        document.getElementById('textarea' + post).value = "";
        commentsShow(post);
    }
}

function openBubble(i) {
    $('#bubble' + i).show();
}

function closeBubble(i) {
    $('#bubble' + i).hide();
}

function Img(link) {
    if (typeof(link) == 'string')
        link = link.replace(/\\/g, '\\\\');
    console.log(link)
    var modal = document.getElementById("image");
    console.log(parent.window.scrollY);
    modal.style.display = 'block';
    document.getElementById('imageshowing').setAttribute('src', link);
    document.getElementById('imageshowing').setAttribute('style', 'margin-top:' + parent.window.scrollY);
    parent.document.body.setAttribute('style', 'overflow: hidden;');
}

function noScroll() {
    window.scrollTo(0, parent.window.scrollY);
}

function profile(id) {
    var iframe = window.parent.document.getElementById('test');
    window.location.href = "profile" + id + '/0';
}

function welcomeProfile() {
    var iframe = window.parent.document.getElementById('test');
    window.location.href = "welcomepost0";
}

function welcomeProfile2() {
    var iframe = window.parent.document.getElementById('test');
    window.location.href = "../welcomepost0";
}

function notification(group, page, i, id, token) {
    $.ajax({
        url: '/RemoveNotification',
        method: 'POST',
        type: 'POST',
        type: 'POST',
        dataType: 'json',
        data: {
            'id': i,
            '_token': token
        },
        success: function(data) {
            if (page != 0)
                window.location.href = 'pagepost' + page + '/' + id;
            else if (group != 0)
                window.location.href = 'grouppost' + group + '/' + id;
            else
                window.location.href = 'welcomepost' + id;
        }


    });
    try {
        document.getElementById('noti' + i).style.display = 'none';
    } catch {}
}

function hidenum() {
    if (document.getElementById('#notification') != null)
        document.getElementById('#notification').style.display = 'none';
}

function hidenum(e) {
    e.getElementsByTagName('span')[0].style.display = 'none';
}

function commentsShow(i) {
    let group = document.getElementById('group' + i);
    if (group.classList.contains('active')) {
        group.classList.remove('active');
    } else
        document.getElementById('group' + i).classList.add('active');
    resize();
    document.getElementById('textarea' + i).value = '';
    console.log(i);
}

function resize() {
    if (parent.document.getElementById("test") != null) {
        obj = parent.document.getElementById("test");
        obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
    }
}
loaders = document.getElementsByClassName('loader-wrapper');

function change(self) {
    for (var i = loaders.length - 1; i >= 0; i--) {
        loaders[i].style.display = "none";
    }
    id = self.id;
    loaders[id - 1].style.display = "inherit";
};

function pass(num, user, e, token) {
    if (num == 1) {
        $.ajax({
            method: 'POST',
            type: 'POST',
            url: '/ServerValidate',
            dataType: 'json',
            data: {
                mail: user,
                pass: e.value,
                _token: token
            },
            success: function(data) {
                if (data == 1) {
                    document.getElementById("password-old").style.display = 'none'
                    document.getElementById("password-old").style.borderWidth = "2px";
                    document.getElementById('password-new').style.display = 'block';
                    document.getElementById('password-confirm').style.display = 'block';
                } else {
                    document.getElementById("info").disabled = true;
                    document.getElementById("password-old").style.borderWidth = "0px";
                    document.getElementById('password-new').style.display = 'none';
                    document.getElementById('password-confirm').style.display = 'none';

                }
            }
        })

    }
    if (num == 2) {
        text = document.getElementById('password-new').value;
        text2 = document.getElementById('password-confirm').value;
        if (text == text2 && text != '' && text != null) {
            document.getElementById('info').disabled = false;
        } else {
            document.getElementById('info').disabled = true;
        }
    }
}

function acceptoffer(offer, token) {
    $.ajax({
        method: 'POST',
        type: 'POST',
        url: '/acceptoffer',
        dataType: 'json',
        data: {
            'offer': offer,
            '_token': token
        }
    });
    document.getElementById('offer' + offer).style.display = 'none';
    document.getElementById('offerrefuse' + offer).style.display = 'none';
    document.getElementById('offeraccept' + offer).style.display = 'none';

}

function refuseoffer(offer, token) {
    $.ajax({
        method: 'POST',
        type: 'POST',
        type: 'POST',
        url: '/refuseoffer',
        dataType: 'json',
        data: {
            'offer': offer,
            '_token': token
        }
    });
    document.getElementById('offer' + offer).style.display = 'none';
    document.getElementById('offerrefuse' + offer).style.display = 'none';
    document.getElementById('offeraccept' + offer).style.display = 'none';
}

function showbubble(i) {
    document.getElementById("bubble" + i).style.display = "block";
    if (i == 1)
        document.getElementById("change_name").classList.add("active_bubble");
    if (i == 2)
        try {

            document.getElementById("photo").classList.add("active_bubble2");
        }
    catch {}
}

function hidebubble(i) {
    document.getElementById("bubble" + i).style.display = "none";
    if (i == 1)
        document.getElementById("change_name").classList.remove("active_bubble");
    if (i == 2)
        try {
            document.getElementById("photo").classList.remove("active_bubble2");
        }
    catch {}
}

function hideinfo() {
    document.getElementById("changeInfo").style.display = "none";

}

function hidecover() {
    document.getElementById("changeCover").style.display = "none";

}

function hideimage() {
    document.getElementById("changeImage").style.display = "none";

}

function aboutChange() {
    window.location.href = "about";

}

function changemsgs() {
    document.getElementById("friendslist").style.display = "none";
    document.getElementById("friendsearch").style.display = "none";
    document.getElementById("messagelist").style.display = "block";
    document.getElementById("messagesearch").style.display = "block";
    document.getElementById("notilist").style.display = "none";
    document.getElementById("pagelist").style.display = "none";
    document.getElementById("groupslist").style.display = "none";
    document.getElementById("marketlist").style.display = "none";
    try {
        document.getElementById("message_bubble").style.display = "none";
    } catch {}
}

function changeFriends() {
    document.getElementById("friendslist").style.display = "block";
    document.getElementById("friendsearch").style.display = "block";
    document.getElementById("messagelist").style.display = "none";
    document.getElementById("messagesearch").style.display = "none";
    document.getElementById("notilist").style.display = "none";
    document.getElementById("pagelist").style.display = "none";
    document.getElementById("groupslist").style.display = "none";
    document.getElementById("marketlist").style.display = "none";


}

function changepages() {
    document.getElementById("friendslist").style.display = "none";
    document.getElementById("friendsearch").style.display = "none";
    document.getElementById("messagelist").style.display = "none";
    document.getElementById("messagesearch").style.display = "none";
    document.getElementById("notilist").style.display = "none";
    document.getElementById("pagelist").style.display = "block";
    document.getElementById("groupslist").style.display = "none";
    document.getElementById("marketlist").style.display = "none";

}

function changegroups() {
    document.getElementById("friendslist").style.display = "none";
    document.getElementById("friendsearch").style.display = "none";
    document.getElementById("messagelist").style.display = "none";
    document.getElementById("messagesearch").style.display = "none";
    document.getElementById("notilist").style.display = "none";
    document.getElementById("pagelist").style.display = "none";
    document.getElementById("groupslist").style.display = "block";
    document.getElementById("marketlist").style.display = "none";

}

function changemarket() {
    document.getElementById("friendslist").style.display = "none";
    document.getElementById("friendsearch").style.display = "none";
    document.getElementById("messagelist").style.display = "none";
    document.getElementById("messagesearch").style.display = "none";
    document.getElementById("notilist").style.display = "none";
    document.getElementById("pagelist").style.display = "none";
    document.getElementById("groupslist").style.display = "none";
    document.getElementById("marketlist").style.display = "block";


}

function changenoti() {
    document.getElementById("friendslist").style.display = "none";
    document.getElementById("friendsearch").style.display = "none";
    document.getElementById("messagelist").style.display = "none";
    document.getElementById("messagesearch").style.display = "none";
    document.getElementById("notilist").style.display = "block";
    document.getElementById("pagelist").style.display = "none";
    document.getElementById("groupslist").style.display = "none";
    document.getElementById("marketlist").style.display = "none";
    try {
        document.getElementById("notification_bubble").style.display = "none";
    } catch {}
}

function color(i) {
    console.log(i);
    var product = document.getElementById('product' + i);
    product.getElementById('p').style.color = "white";
}

function getpostsnum(i) {
    console.log("hi");
    var k = i;
    var x = 0;
    for (x = 0; x < 5; x++) {
        var y = x + k;
        try {
            var element = document.getElementById("post_number" + y);
            console.log("post_number" + y);
            element.style.display = "block";
        } catch {
            return 0;
        }
    }
    return k + 5;
}

// add listener to disable scroll
function checkfriend(i) {
    var elements = document.getElementsByClassName("user_search");
    Array.from(elements).forEach(function(entry) {
        // console.log(entry.id+"   ");
        console.log(i.toLocaleLowerCase());
        if (entry.id.includes(i.toLocaleLowerCase())) { entry.style.display = "block"; } else {
            entry.style.display = "none";
        }
    });
}

function clicks(i, type, id) {
    if (i == 1) {
        document.getElementById("h6" + type + id).style.color = "white";
        document.getElementById("p" + type + id).style.color = "white";
    } else {
        document.getElementById("h6" + type + id).style.color = "black";
        document.getElementById("p" + type + id).style.color = "black";
    }
}
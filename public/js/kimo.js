$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


function input(emails, e, n) {
    if (n == 0) {
        if (e.value !== "") {
            document.getElementById("mail0").disabled = false;
        } else
            document.getElementById("mail" + n).disabled = true;
    }
    if (n == 1) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if ((m = re.exec(e.value)) !== null) {
            document.getElementById("found").style.display = "none";
            document.getElementById("mail1").disabled = false;
            if (emails.includes(e.value) === true) {
                console.log("found");
                document.getElementById("mail" + n).disabled = true;
                document.getElementById("found").style.display = "block";

            }
        } else
            document.getElementById("mail" + n).disabled = true;
    }
    if (n == 2) {
        var re2 = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
        if ((m = re2.exec(e.value)) !== null) {
            document.getElementById("mail2").disabled = false;

        } else {
            document.getElementById("mail" + n).disabled = true;
            console.log("no");
        }
    }
    if (n == 3) {
        var password = document.getElementById("password").value;
        if (e.value === password) {
            document.getElementById("mail3").disabled = false;

        } else {
            document.getElementById("mail" + n).disabled = true;
            console.log("no");
        }
    }
}
user = -1;

function input_login(emails, pass, e, n) {
    if (n == 1) {
        if (emails.includes(e.value) === true) {
            console.log("found");
            document.getElementById("name").style.borderColor = "green";
            document.getElementById("pass").disabled = false;
            document.getElementById("name").style.borderWidth = "2px";
            this.user = e.value;
            console.log(user);
        } else {
            document.getElementById("name").style.borderWidth = "0px";
            document.getElementById("pass").disabled = true;
            this.user = -1;

        }
    }
    if (n == 2) {
        if (user !== -1) {
            $.ajax({
                method: 'POST',
                type: 'POST',
                url: '/ServerValidate',
                dataType: 'json',
                data: {
                    mail: user,
                    pass: e.value
                },
                success: function(data) {
                    if (data == 1) {
                        document.getElementById("pass").style.borderColor = "green";
                        document.getElementById("pass").style.borderWidth = "2px";
                        document.getElementById("login").disabled = false;
                    } else {
                        document.getElementById("pass").style.borderWidth = "0px";
                        document.getElementById("login").disabled = true;
                    }
                }
            })

        }


    }
}

function ready(n) {
    var step = document.getElementById("step" + n);
    step.classList.remove("step");
    step.classList.add("stepactive");
    // step.setAttribute("class", "stepactive");
    var par = document.getElementById("par" + n);
    par.textContent = "✔";
    var next = document.getElementById("stepnow" + (n + 1));
    var current = document.getElementById("stepnow" + (n));
    current.style.display = "none";

    if (n < 4) {
        next.style.visibility = "visible"
        next.style.display = "block";
        current.classList.remove("inputnow")
        next.classList.add("inputnow");
    } else { document.getElementById("myform").submit(); }

}

function back(n) {
    if (n > 0) {
        console.log(n);
        var step = document.getElementById("step" + (n - 1));
        step.classList.remove("stepactive");
        step.classList.add("step");
        // step.setAttribute("class", "stepactive");
        var par = document.getElementById("par" + (n - 1));
        par.textContent = n;
        var next = document.getElementById("stepnow" + (n - 1));
        var current = document.getElementById("stepnow" + (n));
        next.style.display = "block";
        current.style.display = "none";
        current.classList.remove("inputnow");
        next.classList.add("inputnow");
        next.style.display = "block";
    }
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


function addFriend(id1, id2) {
    $.ajax({
        method: 'POST',
        url: '/AddFriend',
        dataType: 'json',
        data: {
            id: id1,
            friend: id2
        },


    });
}
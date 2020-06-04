var from_input = $('#startingDate').pickadate({
        selectYears: true,
        selectMonths: true,
        selectYears: 100,
        max: new Date(((new Date()).getFullYear()), 12, 31) // Set it max to next year last day
    }),
    from_picker = from_input.pickadate('picker')
$('#startingDate').on('mousedown', function(event) {
    event.preventDefault();
})
$('select').on('mousedown', function(event) {
    event.preventDefault();
})
$(document).ready(function() {
    $('select').material_select();
});
// Check if there’s a “from” or “to” date to start with and if so, set their appropriate properties.
function open_page(e) {
    $('.content').hide();
    $('#create_page_container').show();
    $('#home').removeClass("active");
    $('#new_group').removeClass("active");
    $('#new_product').removeClass("active");
    $('#new_page').addClass("active");
}

function open_details(e) {
    $('.content').hide();
    $('#details_container').show();
    $('#home').addClass("active");
    $('#new_page').removeClass("active");
    $('#new_group').removeClass("active");
    $('#new_product').removeClass("active");
}

function open_group(e) {
    $('.content').hide();
    $('#create_group_container').show();
    $('#home').removeClass("active");
    $('#new_page').removeClass("active");
    $('#new_product').removeClass("active");
    $('#new_group').addClass("active");
}

function open_product() {
    $('.content').hide();
    $('#create_product_container').show();
    $('#home').removeClass("active");
    $('#new_page').removeClass("active");
    $('#new_group').removeClass("active");
    $('#new_product').addClass("active");
}

function inputimg(e) {
    const regex = /[\d*|\D*]\.jpg|[\d*|\D*]\.png|[\d*|\D*]\.JPG/gm;
    if ((m = regex.exec(e.files[0].name)) !== null) {
        document.getElementById("validate").value = (e.files[0].name).slice(-25);
        document.getElementById("submit").disabled = false;
    } else {
        document.getElementById("submit").disabled = true;
        console.log(e.files[0].name);
        document.getElementById("validate").value = "";
    }
}

function inputimg2(e) {
    const regex = /[\d*|\D*]\.jpg|[\d*|\D*]\.png|[\d*|\D*]\.JPG/gm;
    if ((m = regex.exec(e.files[0].name)) !== null) {
        document.getElementById("validate1").value = (e.files[0].name).slice(-25);
        document.getElementById("submit1").disabled = false;
    } else {
        document.getElementById("submit1").disabled = true;
        console.log(e.files[0].name);
        document.getElementById("validate1").value = "";
    }
}

function inputimg3(e) {
    const regex = /[\d*|\D*]\.jpg|[\d*|\D*]\.png|[\d*|\D*]\.JPG|[\d*|\D*]\.jpeg/gm;
    if ((m = regex.exec(e.files[0].name)) !== null) {
        document.getElementById("validate4").value = (e.files[0].name).slice(-25);
        document.getElementById("submit4").disabled = false;
    } else {
        document.getElementById("submit4").disabled = true;
        console.log(e.files[0].name);
        document.getElementById("validate4").value = "";
    }
}

function newproduct(token) {
    var name = document.getElementById('Productname').value;
    var details = document.getElementById('Productabout').value;
    var discription = document.getElementById('Productdiscription').value;
    var keys = document.getElementById('Productkeys').value;
    var contacts = document.getElementById('Productcontacts').value;
    var iframe = document.getElementById("Productframe");
    console.log(iframe);
    var from = iframe.contentWindow.document.getElementById('range-1a').value;
    var to = iframe.contentWindow.document.getElementById('range-1b').value;
    if ($("#ProductImage").prop('files')[0] != null) {
        file_data = $("#ProductImage").prop('files')[0];
    }
    var form_data = new FormData();
    form_data.append('image', file_data);
    form_data.append('_token', token);
    form_data.append('name', name);
    form_data.append('keys', keys);
    form_data.append('about', details);
    form_data.append('value1', from);
    form_data.append('value2', to);
    form_data.append('discription', discription);
    form_data.append('contacts', contacts);
    $.ajax({
        method: 'POST',
        type: "POST",
        url: '/makeproduct',
        dataType: 'text', // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'POST',
        success: function(php_script_response) {
            window.location.href = 'productinfo' + php_script_response;
        }
    });
}
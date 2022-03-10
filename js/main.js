var speed = '0.5s';

$('html, body').hide();

$(document).ready(function () {
    $('html, body').fadeIn(speed, function () {
        $('a[href], button[href]').click(function (event) {
            var url = $(this).attr('href');
            if (url.indexOf('#') == 0 || url.indexOf('javascript:') == 0) return;
            event.preventDefault();
            $('html, body').fadeOut(speed, function () {
                window.location = url;
            });
        });
    });
});

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function blurApplication() {
    $("#appWrapper").css("filter", "blur(20px)");
}
function unblurApplication() {
    $("#appWrapper").css("filter", "none");
}

function setCookie(name, value, minutes) {
    var expires = "";
    if (minutes) {
        var date = new Date();
        date.setTime(date.getTime() + (minutes * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}
function getCookie(name, defaultValue) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return defaultValue;
}
function eraseCookie(name) {
    document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}
function deleteAllCookies() {
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    }
}

function asyncConfirm(message, yes = "Yes", no = "No") {
    return new Promise(resolve => {
        bootbox.confirm({
            title: "",
            message: message,
            buttons: {
                confirm: {
                    label: yes
                },
                cancel: {
                    label: no
                }
            },
            callback: result => resolve(result)
        })
    })
}

function asyncPrompt(message, title, required = false, type = "text", buttons = null) {
    if (buttons == null) {
        buttons = {
            confirm: {
                label: "OK"
            },
            cancel: {
                label: "Cancel"
            }
        };
    }
    return new Promise(resolve => {
        bootbox.prompt({
            title: title,
            message: message,
            inputType: type,
            required: required,
            buttons: buttons,
            callback: result => resolve(result)
        })
    })
}

function logout() {
    deleteAllCookies();
    localStorage.clear();
    window.location.replace("/");
}

function download(data, filename, type) {
    var file = new Blob([data], { type: type });
    if (window.navigator.msSaveOrOpenBlob) // IE10+
        window.navigator.msSaveOrOpenBlob(file, filename);
    else { // Others
        var a = document.createElement("a"),
            url = URL.createObjectURL(file);
        a.href = url;
        a.download = filename;
        document.body.appendChild(a);
        a.click();
        setTimeout(function () {
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
        }, 0);
    }
}

function asyncAlert(message, title = "Starless Sky") {
    return new Promise(resolve => {
        bootbox.alert({
            message: `<h4>${title}</h4><br/>` + message,
            callback: result => resolve(result)
        })
    })
}

function toast(text) {
    Toastify({
        text: text,
        duration: 3000,
        gravity: "bottom",
        style: {
            background: "#323232",
        },
    }).showToast();
}

function friendlyTime(date) {
    var delta = Math.round(date / 1000);

    var minute = 60,
        hour = minute * 60,
        day = hour * 24,
        week = day * 7;

    var fuzzy;

    if (delta < 30) {
        fuzzy = 'just then.';
    } else if (delta < minute) {
        fuzzy = delta + ' seconds ago.';
    } else if (delta < 2 * minute) {
        fuzzy = 'a minute ago.'
    } else if (delta < hour) {
        fuzzy = Math.floor(delta / minute) + ' minutes ago.';
    } else if (Math.floor(delta / hour) == 1) {
        fuzzy = '1 hour ago.'
    } else if (delta < day) {
        fuzzy = Math.floor(delta / hour) + ' hours ago.';
    } else if (delta < day * 2) {
        fuzzy = 'yesterday';
    }

    return fuzzy;
}

const escapeHtml = (unsafe) => {
    return unsafe.replaceAll('&', '&amp;').replaceAll('<', '&lt;').replaceAll('>', '&gt;').replaceAll('"', '&quot;').replaceAll("'", '&#039;');
}

const sanitize = (html) => {
    return sanitizeHtml(html, {
        allowedTags: [
            "h1", "h2", "h3", "h4",
            "h5", "h6", "blockquote", "hr", "li", "ol", "p", "pre", "ul", "b", "br", "cite", "code",
            "em", "i", "kbd", "mark", "q", "small", "span", "strong", "sub", "sup", "u",
            "table", "tbody", "td", "tfoot", "th", "thead", "tr"
        ],
    });
}


function copyToClipboard(elementId, successText) {
    var copyText = document.getElementById(elementId);
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);

    toast(successText);
}

async function asyncForEach(array, callback) {
    for (let index = 0; index < array.length; index++) {
        await callback(array[index], index, array);
    }
}

function asyncAjax(url, method, data) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: url,
            method: method,
            dataType: "json",
            data: JSON.stringify(data),
            beforeSend: function () {
            },
            success: function (res) {
                resolve(res) // Resolve promise and when success
            },
            error: function (err) {
                reject(err) // Reject the promise and go to catch()
            }
        });
    });
}
const url = localStorage.getItem("url");

if (url == null) {
    window.location.replace("/");
}

if (localStorage.getItem("private_key_encrypted") != null) {
    window.location.replace("/dashboard");
}

function switchNetwork() {
    localStorage.clear();
    window.location.replace("/");
}

$(window).on("load", function () {
    $("#networkAddress").text(url);
})

function gotoCreateIdentity() {
    window.location.replace("/identity/new");
}

async function loadIdentity() {
    window.location.replace("/identity/import")
}
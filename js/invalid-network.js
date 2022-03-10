const url = localStorage.getItem("url");
const privateKeyEncoded = localStorage.getItem("private_key_encrypted");
const publicKeyEncoded = localStorage.getItem("public_key_encripted");

if (url == null || privateKeyEncoded == null || publicKeyEncoded == null) {
    logout();
}

$(window).on("load", function () {
    $("#url").text(url);
})
var response = null;

$(window).on("load", async function () {
    const url = localStorage.getItem("url");

    if (url == null) {
        window.location.replace("/");
    }

    await sleep(1500);
    $.ajax({
        url: url + "/identity.gen-private-key",
        method: "POST",
        success: function (res) {
            if (!res.success) {
                alert("Cannot connect to network.");
            } else {
                response = res.response;
                $("#private-key").text(response.private_key);
                $("#continueBtn").prop("disabled", false)
                $("#downloadBtn").prop("disabled", false)
            }
        },
        error: function (res) {
            alert("Cannot connect to network. Did you wrote the address correctly?");
            $("#loadingIcon").addClass("d-none");
            $("#connectButton span").text("Connect");
            $("#connectButton").prop("disabled", false);
        }
    })
});

function downloadKey() {
    download($("#private-key").text(), "starless-sky-key.pk", "text");
}

async function next() {
    let pass = await asyncPrompt("Please, choose an strong password to protect your keys in your computer. This password will be asked every time you access your app.", "Choose a password", true, "password");

    if (pass != null) {
        var crypto = new SimpleCrypto(pass);
        setCookie("password", pass, 30);
        localStorage.setItem("private_key_encrypted", crypto.encrypt(response.private_key));
        localStorage.setItem("public_key_encripted", crypto.encrypt(response.public_address));

        window.location.replace("/dashboard");
    }
}
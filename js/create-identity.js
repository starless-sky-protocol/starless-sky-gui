var response = null;

$(window).on("load", async function () {
    const url = localStorage.getItem("url");

    if (url == null) {
        window.location.replace("/");
    }

    await sleep(3000);

    $.ajax({
        url: url + "/identity/generate-keypair",
        method: "GET",
        success: function (res) {
            if (!res.success) {
                alert("Cannot connect to network.");
            } else {
                response = res.response;

                const mnemonicTexts = String(res.response.mnemonic).split(/\s/);
                $("#mnemonic-1").text(mnemonicTexts.slice(0, 8).join("\n"));
                $("#mnemonic-2").text(mnemonicTexts.slice(8, 16).join("\n"));
                $("#mnemonic-3").text(mnemonicTexts.slice(16, 24).join("\n"));

                $("#continueBtn").prop("disabled", false)
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

async function next() {
    let pass = await asyncPrompt("Please, choose an strong password to protect your keys in your computer. This password will be asked every time you access your app.", "Choose a password", true, "password");

    if (pass != null) {
        var crypto = new SimpleCrypto(pass);
        setCookie("password", pass, 30);
        localStorage.setItem("mnemonic_encrypted", crypto.encrypt(response.mnemonic));
        localStorage.setItem("private_key_encrypted", crypto.encrypt(response.private_key));
        localStorage.setItem("public_key_encripted", crypto.encrypt(response.public_key));

        window.location.replace("/dashboard");
    }
}
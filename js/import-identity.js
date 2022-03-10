const url = localStorage.getItem("url");

function checkMnemonic() {
    if ($("#mnemonic").val().split(' ').length == 24) {
        $("#continueBtn").prop("disabled", "");
    } else {
        $("#continueBtn").prop("disabled", "disabled");
    }
}

async function next() {
    let private_key = $("#private_key").val();
    $.ajax({
        url: url + "/identity.auth",
        data: JSON.stringify({
            private_key: private_key
        }),
        method: "POST",
        success: async function (res) {
            let pass = await asyncPrompt("Please, choose an strong password to protect your keys in your computer. This password will be asked every time you access your app.", "Choose a password", true, "password");

            if (pass != null) {
                var crypto = new SimpleCrypto(pass);
                setCookie("password", pass, 30);
                localStorage.setItem("private_key_encrypted", crypto.encrypt(private_key));
                localStorage.setItem("public_key_encripted", crypto.encrypt(res.response.public_address));

                window.location.replace("/dashboard");
            }
        },
        error: async function (res) {
            await asyncAlert("Cannot import your private key: " + res.responseJSON.messages[0].message, "Error");
        }
    })
}
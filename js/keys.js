function copyPublicKey() {
    var copyText = document.getElementById("publicKey");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);

    toast("Public key copied to clipboard");
}

async function showPrivateKeysDialog(appendText = "") {
    let password = await asyncPrompt("To decrypt your private keys, please enter the password used in your identity.<br/><br/>" + appendText,
        "Decrypt your private keys",
        true,
        "password",
        {
            confirm: {
                label: "Decrypt and show keys"
            },
            cancel: {
                label: "Cancel"
            }
        });

    if (password == null) return;

    let crypto = new SimpleCrypto(password);
    
    try {
        $("#privateKey").val(crypto.decrypt(privateKeyEncoded));
        $("#mnemonic").text(crypto.decrypt(mnemonicEncoded));
        $('#keysModal').modal({ backdrop: true })
    } catch (error) {
        console.log(error);
        showPrivateKeysDialog("Failed to decrypt: wrong password received.");
    }
}

function clearPrivateKeysInformation() {
    $("#privateKey").val("");
    $("#mnemonic").text("");
}

$(window).on("load", function () {
    var networkLabel = $("#networkLabel");
    var publicKeyLabel = $("#publicKey");

    networkLabel.text(url);
    publicKeyLabel.val(crypto.decrypt(publicKeyEncoded));
})
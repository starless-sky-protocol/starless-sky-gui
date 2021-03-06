const url = localStorage.getItem("url");
const privateKeyEncoded = localStorage.getItem("private_key_encrypted");
const publicKeyEncoded = localStorage.getItem("public_key_encripted");

if (url == null || privateKeyEncoded == null || publicKeyEncoded == null) {
    logout();
}

const crypto = new SimpleCrypto(getCookie("password") ?? "");

async function askForDecrypt(appendText = "") {
    blurApplication();

    let password = await asyncPrompt("To decrypt your dashboard, please enter the password used in your identity.<br/><br/>" + appendText,
        "Welcome again!",
        true,
        "password",
        {
            confirm: {
                label: "Decrypt"
            },
            cancel: {
                label: "Logout"
            }
        });

    if (password == null) logout();

    let crypto = new SimpleCrypto(password);
    try {
        crypto.decrypt(privateKeyEncoded);
        crypto.decrypt(publicKeyEncoded);
        // valid key
        setCookie("password", password, 30);
        document.location.reload();
    } catch (error) {
        console.log(error);
        askForDecrypt("Failed to decrypt: wrong password received.");
    }
}

function lock() {
    toast("Locking session...");
    deleteAllCookies();
    document.location.reload();
}

$(window).on("load", function () {
    if (getCookie("password") == null) {
        askForDecrypt();
        return;
    } else {
        try {
            crypto.decrypt(publicKeyEncoded);
        } catch {
            askForDecrypt();
            return;
        }
    }

    if (getCookie("node") == null) {
        validateNodes();
    }

    $.ajax({
        url: url + "/identity.get-public-info",
        method: "POST",
        data: JSON.stringify({
            public_keys: [crypto.decrypt(publicKeyEncoded)]
        }),
        success: function (res) {
            $("#card_name").html(res.response[0].identity.name ?? "&lt;no name&gt;");
            $("#card_address").html(res.response[0].public_key);
        },
        error: function (res) {
            console.log(res);
        }
    })

    sleep(50).then(function () {
        var sidebarWidth = $('#sidebar').width();
        $('.s-nav-link-wrapper').width(sidebarWidth);
    })
})
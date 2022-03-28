if (localStorage.getItem("url") != null) {
    window.location.replace("/identity");
}

function validateAddress(string) {
    let url;

    try {
        url = new URL(string);
        $("#addressValidation").addClass("d-none")
        $("#connectButton").prop("disabled", false);
    } catch (_) {
        $("#addressValidation").removeClass("d-none")
        $("#connectButton").prop("disabled", true);
    }

}

async function useStarlessSkyMainnet() {
    localStorage.setItem("url", "https://mainnet.starless-sky.org");
    window.location.replace("/identity");
}

async function connect() {
    $("#loadingIcon").removeClass("d-none");
    $("#connectButton").prop("disabled", true);
    $("#connectButton span").text("Connecting...");

    let uri = $("#address").val().replace(/\/\s*$/, "");

    var exit = false;
    if (uri.includes("http://")) {
        var cont = await asyncConfirm("You're using an non secure (HTTP) connection with this Starless Sky server. Information can be stolen while using this network. Are you sure you want to continue?", "Change connection", "Use an insecure connection");
        if (cont == true) {
            $("#loadingIcon").addClass("d-none");
            $("#connectButton span").text("Connect");
            $("#connectButton").prop("disabled", false);
            exit = true;
        }
    }
    if(exit) return;

    $.ajax({
        url: uri + "/server.ping",
        method: "POST",
        success: function (res) {
            localStorage.setItem("url", uri);
            $("#loadingIcon").addClass("d-none");
            $("#connectButton span").text("Connected!");
            window.location.replace("/identity");
        },
        error: function (res) {
            alert("Cannot connect to network. Did you wrote the address correctly?");
            $("#loadingIcon").addClass("d-none");
            $("#connectButton span").text("Connect");
            $("#connectButton").prop("disabled", false);
        }
    })
}
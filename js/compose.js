var editingId = null;

$(window).on("load", function () {
    let myPublicKey = crypto.decrypt(publicKeyEncoded);
    $.ajax({
        url: url + "/identity.get-public-info",
        method: "POST",
        data: JSON.stringify({
            public_keys: [myPublicKey]
        }),
        success: function (res2) {
            $("#from-public-key").val((res2.response[0].identity.name ?? "(unknown)") + " <" + myPublicKey + ">");
        }
    });

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    if (urlParams.get("reply")) {
        $.ajax({
            url: url + "/message.read",
            method: "POST",
            data: JSON.stringify({
                id: urlParams.get("reply"),
                private_key: crypto.decrypt(privateKeyEncoded)
            }),
            success: function (res2) {
                let lines = res2.response.message.content.split("\n");
                $("#to").val(res2.response.pair.from);
                $("#subject").val("RE: " + escapeHtml(res2.response.message.subject));
                $("#content").val("\n\n\n-----------------\n" + lines.map(function (element) { return '> ' + element; }).join('\n'));
                updateTextareaSize();
            }
        });
    }

    if (urlParams.get("edit")) {
        $.ajax({
            url: url + "/message.read",
            method: "POST",
            data: JSON.stringify({
                id: urlParams.get("edit"),
                private_key: crypto.decrypt(privateKeyEncoded)
            }),
            success: function (res2) {
                $("#title").text("Edit message");
                $("#to").val(res2.response.pair.from);
                $("#subject").val(escapeHtml(res2.response.message.subject));
                $("#content").val(res2.response.message.content);
                editingId = urlParams.get("edit");
                updateTextareaSize();
            }
        });
    }
});

function updateTextareaSize() {
    $("textarea").each(function () {
        this.setAttribute("style", "min-height: 200px; height:" + (this.scrollHeight) + "px; overflow-y:hidden;");
    }).on("input", function () {
        this.style.height = "auto";
        this.style.height = (this.scrollHeight) + "px";
    });
}

function switchTab(tabId) {
    $(".tab").css("display", "none")
    $("#" + tabId).css("display", "block")
}

function updatePreview() {
    $("#preview").html(sanitize(marked.parse($("#content").val())));
}

function send() {
    $.ajax({
        url: url + "/" + (editingId ? "message.edit" : "message.send"),
        method: "POST",
        data: JSON.stringify({
            id: editingId,
            private_key: crypto.decrypt(privateKeyEncoded),
            public_keys: [$("#to").val()],
            id: editingId ?? "",
            message: {
                content: $("#content").val(),
                subject: $("#subject").val()
            }
        }),
        success: function (res2) {
            toast(res2.messages[0].message);
            sleep(1800).then(() => window.location.replace("/dashboard/"));
        },
        error: function (err) {
            toast("Error: " + err.responseJSON.messages[0].message);
        }
    });
}
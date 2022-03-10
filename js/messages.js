$(window).on("load", function () {
    refreshMessageList(true);
    setInterval(function () {
        refreshMessageList(false);
    }, 8000)
})

async function refreshMessageList(forced) {
    let folder = $('#inbox-check').is(':checked') ? "inbox" : "sent";

    if (forced) {
        $("div[isclone='yes']").remove();
    }

    $.ajax({
        url: url + "/message.list",
        method: "POST",
        data: JSON.stringify({
            private_key: crypto.decrypt(privateKeyEncoded),
            folder: folder,
            pagination_data: {
                skip: 0,
                take: 15
            }
        }),
        success: function (res) {
            let keys = [];
            res.response.messages.map(function (msg) {
                keys.push(msg.from);
            })
            if (res.response.messages.length > 0) {
                $.ajax({
                    url: url + "/identity.get-public-info",
                    method: "POST",
                    data: JSON.stringify({
                        public_keys: keys
                    }),
                    success: function (res2) {
                        let keysResponse = res2.response;
                        res.response.messages.reverse().map(function (msg) {
                            if ($('div[skyid="' + msg.id + '"]').length) {
                                return;
                            }
                            $("#from-name").text(keysResponse.filter(function (i) { return i.public_key == msg.from })[0].identity.name ?? "(unknown)");
                            $("#from-public-key").text(msg.from);
                            if (msg.read) {
                                $("#subject").text(escapeHtml(msg.message.subject));
                            } else {
                                $("#subject").html("<strong>" + escapeHtml(msg.message.subject) + "</strong>");
                            }
                            $("#date").text(moment.unix(msg.created_at).fromNow());
                            $("#tag").attr("skyid", msg.id);
                            let element = $("#templateRow").clone().html()
                                .replace(`id="subject"`, `subject="${msg.id}"`)
                                .replaceAll(/\bid="/g, ' __id="')
                                .replace('d-none', '')
                                .replace("/*skyid*/", msg.id);
                            $("#templateRow").after("<div isclone='yes' class='col-12 border-bottom s-link'>" + element + "</div>");
                        });
                    }
                })
            }
        },
        error: function (res) {
            toast(res.responseJSON.messages[0].message)
        }
    })
}


var selectedMessage = "";
function viewMessage(id) {
    selectedMessage = id;
    let folder = $('#inbox-check').is(':checked');

    if (folder) {
        $("#delete-msg-btn span").text("Delete for me");
        $("#reply-msg-btn").css("display", "inline");
        $("#edit-msg-btn").css("display", "none");
    } else {
        $("#delete-msg-btn span").text("Delete for everyone");
        $("#reply-msg-btn").css("display", "none");
        $("#edit-msg-btn").css("display", "inline");
    }

    $.ajax({
        url: url + "/message.read",
        method: "POST",
        data: JSON.stringify({
            id: id,
            private_key: crypto.decrypt(privateKeyEncoded)
        }),
        success: function (res) {
            $.ajax({
                url: url + "/identity.get-public-info",
                method: "POST",
                data: JSON.stringify({
                    public_keys: [res.response.pair.from]
                }),
                success: function (res2) {
                    let timestamp = res.response.manifest.created_at;
                    let fromName = res2.response[0].identity.name ?? "no name";
                    let fromAddress = res.response.pair.from;

                    var output = "<ul class='from-address-info'>";
                    res.response.pair.to.forEach(function (address) {
                        output += `<li>${address}</li>`;
                    })
                    $("#from-addresses").html(output + "</ul>");

                    $("#info-from-address").val(fromAddress);
                    $("#info-id").val(res.response.id);
                    $("#info-receivers").val(res.response.pair.to.length + " address(es)");
                    $("#info-created-at").val(new Date(res.response.manifest.created_at * 1000).toLocaleString());
                    $("#info-updated-at").val(new Date(res.response.manifest.updated_at * 1000).toLocaleString());
                    $("#info-is-modified").val(res.response.manifest.is_modified ? "Yes" : "No");
                    $("#info-digest").val(res.response.manifest.message_digest);

                    $("#viewMessagePanel").css("visibility", "visible");
                    $("#msg-from-name").html(fromName);
                    $("#sent-hour").html(new Date(timestamp * 1000).toLocaleString() + " - " + moment.unix(timestamp).fromNow());
                    $("span[subject='" + id + "']").html(escapeHtml(res.response.message.subject));
                    $("#msg_subject").html(escapeHtml(res.response.message.subject));
                    $("#content").html(sanitize(marked.parse(res.response.message.content)));
                }
            })
        },
        error: async function (err) {
            await asyncAlert("Cannot read message: " + err.responseJSON.messages[0].message);
            refreshMessageList(true);
        }
    });
}

async function deleteMessage() {
    if (selectedMessage == "") return;

    var cont = await asyncConfirm("Are you sure want to delete this message permanently? If you have sent this message, it will be deleted for all recipients.", "Delete message", "Cancel");
    if (cont == false) return;
    $.ajax({
        url: url + "/message.delete/",
        method: "DELETE",
        data: JSON.stringify({
            id: selectedMessage,
            private_key: crypto.decrypt(privateKeyEncoded)
        }),
        success: function (res) {
            toast(res.messages[0].message);
            refreshMessageList(true);
        },
        error: async function (err) {
            await asyncAlert("Cannot delete message: " + err.responseJSON.messages[0].message);
            refreshMessageList(true);
        }
    });
}

function replyMessage() {
    window.location.replace("/dashboard/new?reply=" + selectedMessage);
}

function editMessage() {
    window.location.replace("/dashboard/new?edit=" + selectedMessage);
}

function viewTransactions() {
    window.location.replace("/dashboard/validate?type=message&id=" + selectedMessage);
}
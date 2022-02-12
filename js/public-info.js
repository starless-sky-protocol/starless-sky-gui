function updatePublicInfo() {
    $.ajax({
        url: url + "/identity",
        method: "PUT",
        data: JSON.stringify({
            private_key: crypto.decrypt(privateKeyEncoded),
            public: {
                name: $("#name").val(),
                biography: $("#biography").val()
            }
        }),
        success: function (res) {
            document.location.reload();
        },
        error: function (res) {
            console.log(res);
        }
    })
}

async function deletePublicInfo() {
    var cont = await asyncConfirm("Are you sure want to delete all your public information?", "Yes", "Cancel");
    if (cont == true) {
        $.ajax({
            url: url + "/identity",
            method: "DELETE",
            data: JSON.stringify({
                private_key: crypto.decrypt(privateKeyEncoded)
            }),
            success: function (res) {
                toast("Public Identity erased. Refreshing...");
                sleep(3000).then(function () {
                    document.location.reload();
                });
            },
            error: function (res) {
                console.log(res);
            }
        })
    }
}

$(window).on("load", function () {
    $.ajax({
        url: url + "/identity",
        method: "VIEW",
        data: JSON.stringify({
            public_keys: [crypto.decrypt(publicKeyEncoded)]
        }),
        success: function (res) {
            $("#name").val(res.response[0].identity.name);
            $("#biography").val(res.response[0].identity.biography);
        },
        error: function (res) {
            console.log(res);
        }
    })
})
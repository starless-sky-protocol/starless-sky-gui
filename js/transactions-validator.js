var validateInformation = "";

$(window).on("load", function () {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    const id = urlParams.get("id");
    if (!id) {
        window.location.replace("/dashboard/");
    }

    if (urlParams.get("type") == "message") {
        $.ajax({
            url: url + "/message.read",
            method: "POST",
            data: JSON.stringify({
                id: id,
                private_key: crypto.decrypt(privateKeyEncoded)
            }),
            success: res => {
                validateInformation = h_blake3(
                    res.response.id
                    + res.response.message.subject
                    + res.response.message.content
                    + JSON.stringify(res.response.manifest)
                    + res.response.pair.from
                    + JSON.stringify(res.response.pair.to)
                )
                validateNodes(res.response.id);
            }
        })
    } else {
        window.location.replace("/dashboard/");
    }
});

function validateNodes(searchFor) {
    let mainElement = $("#main");
    let tbodyElement = $("#tbody");
    let height = 0;
    let blockIndex = 0;
    $.ajax({
        url: url + "/server.bc.list",
        method: "POST",
        success: function (res) {
            let expect = "";
            let found = false;
            let is_valid = false;
            asyncForEach(res.response, async (block) => {
                blockIndex++;
                const block_data = await asyncAjax(url + "/server.bc.read", "POST", {block: block});
                let actual = block_data.response.header;
                if (expect == "") {
                    console.log("genesis!");
                } else {
                    if (actual == expect) {
                        console.log("validated!");
                    } else {
                        console.log("invalidated!");
                    }
                }
                let totalTransactions = block_data.response.transactions.length * res.response.length;
                expect = h_blake3(JSON.stringify(block_data.response));
                await asyncForEach(block_data.response.transactions, async (transaction) => {
                    height++;
                    let percent = Math.round((100 * height) / totalTransactions);
                    console.log(transaction.sky_id, transaction.command)
                    if (transaction.sky_id == searchFor) {
                        found = true;
                        is_valid = transaction.content == validateInformation;
                        tbodyElement.append(`
                            <tr>
                                <td>${blockIndex}</td>
                                <td>${height}</td>
                                <td class="font-monospace">${transaction.id}<br/><small>${moment.unix(transaction.time).fromNow()}</small></td>
                                <td>${transaction.command}</td>
                                <td class="${is_valid ? 'text-primary' : 'text-muted'}">${is_valid ? '<i class="las la-check"></i>' + " Validated" : '<i class="las la-times"></i>'}</td>
                            </tr>
                            `);
                    }

                    mainElement.html(`
                        <div>Validating blocks and transactions (${height}/${totalTransactions})</div>
                        <div class="progress mt-3">
                            <div class="progress-bar" style="width: ${percent}%;" role="progressbar"></div>
                        </div>
                        <div class="mt-3">
                        All transactions that will be displayed below are related to the object you are looking for.
                        If the last transaction is validated, then your content is valid and secure.
                        </div>
                    `);
                })
                if (blockIndex == res.response.length) {
                    console.log("finished validating nodes")
                    if(!found) {
                        $("#not-found").css("display", "block");
                    } else {
                        if(!is_valid) {
                            $("#not-valid").css("display", "block");
                        } else {
                            $("#valid").css("display", "block");
                        }
                    }
                }
            })
        }
    })
}
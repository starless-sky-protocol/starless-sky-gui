function validateNodes() {
    var dialog = bootbox.dialog({
        closeButton: false,
        title: 'Validating transactions',
        message: '<p>Validating nodes (0/0)...</p>'
    });

    dialog.init(function () {
        let height = 0;
        let blockIndex = 0;
        $.ajax({
            url: url + "/server.bc.list",
            method: "POST",
            success: function (res) {
                let expect = "";
                if (res.response.length == 0) {
                    sleep(500).then(() => {
                        setCookie("node", true, 30);
                        bootbox.hideAll()
                    })
                }
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
                    expect = h_blake3(JSON.stringify(block_data.response));
                    let percent = Math.round((100 * blockIndex) / res.response.length);
                    dialog.find('.bootbox-body').html(`
                        <div>Validating blocks (${blockIndex}/${res.response.length})</div>
                        <div class="progress mt-3">
                            <div class="progress-bar" style="width: ${percent}%;" role="progressbar"></div>
                        </div>
                        <div class="mt-3">
                            <small>This process is necessary to validate that this Starless Sky Network is
                            maintaining the integrity of information on the network and only runs periodically.</small>
                        </div>
                    `);
                    if (blockIndex == res.response.length) {
                        console.log("finished validating nodes")
                        sleep(500).then(() => {
                            setCookie("node", true, 30);
                            bootbox.hideAll()
                        })
                    }
                })
            }
        })
    });
}
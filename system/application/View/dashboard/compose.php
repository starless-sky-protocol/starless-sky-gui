<script src="/js/compose.js"></script>
<link rel="stylesheet" href="/css/compose.css" />

<div class="row">
    <div id="mainPanel" class="col-12 scroll-panel">
        <h3 class="<?= isMobile() ? '' : 'mt-5' ?> border-bottom d-flex pb-3 mb-3" style="font-weight: 300">
            <span id="title"><?= $title ?></span>
            <button onclick="send()" class="ml-auto btn btn-primary"><i class="las la-paper-plane"></i> Send</button>
        </h3>
        <div class="row mb-2">
            <div class="col-md-2 col-sm-12 d-flex align-items-center">
                <small>From</small>
            </div>
            <div class="col-md-10 col-sm-12 d-flex flex-column align-items-center">
                <div class="input-group">
                    <input class="form-control bg-white" readonly id="from-public-key" value="..." />
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-2 col-sm-12 d-flex align-items-center">
                <small>To</small>
            </div>
            <div class="col-md-10 col-sm-12 d-flex flex-column align-items-center">
                <div class="input-group">
                    <input class="form-control" id="to" value="" />
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12">
                <input style="font-size: 2.5rem;" class="form-control border-0" id="subject" placeholder="Subject" value="" />
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12 border-bottom border-top py-3">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-sm btn-primary active">
                        <input type="radio" name="options" data-mdb-toggle="tab" onclick="switchTab('tab_message')" autocomplete="off" checked> Message body
                    </label>
                    <label class="btn btn-sm btn-primary">
                        <input type="radio" name="options" data-mdb-toggle="tab" onclick="switchTab('tab_preview'); updatePreview()" autocomplete="off"> Preview
                    </label>
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="tab-content" id="ex1-content">
                    <div class="tab" id="tab_message" style="display: block">
                        <textarea id="content" oninput="updateTextareaSize()" class="form-control font-monospace border-0"></textarea>
                    </div>
                    <div class="tab" id="tab_preview" style="display: none">
                        <div id="preview"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
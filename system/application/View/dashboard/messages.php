<script src="/js/messages.js"></script>
<link rel="stylesheet" href="/css/messages.css" />

<div class="modal fade" id="addressesDialog" tabindex="-1" role="dialog" aria-labelledby="addressesDialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addressesDialog">Message receivers addresses</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="from-addresses" class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div id="messagesPane" class="col-md-4 col-sm-12 scroll-panel collapse show">
        <div class="row border-bottom">
            <div class="col-12 py-3">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-sm btn-primary active">
                        <input type="radio" name="options" id="inbox-check" onclick="refreshMessageList(true)" autocomplete="off" checked> <i class="las la-download"></i> Inbox
                    </label>
                    <label class="btn btn-sm btn-primary">
                        <input type="radio" name="options" onclick="refreshMessageList(true)" autocomplete="off"> <i class="las la-upload"></i> Sent
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-none s-link" id="templateRow" isclone="no">
                <a href="#" onclick="viewMessage('/*skyid*/')" <?= isMobile() ? 'data-toggle="collapse" data-target="#messagesPane"' : '' ?>>
                    <div class="row py-2">
                        <div id="tag" skyid="1" class="col-auto mr-auto d-flex text-truncate">
                            <span class="my-auto">
                                <small id="from-name">
                                    From name
                                </small>
                            </span>
                        </div>
                        <div class="col-auto d-flex">
                            <small class="my-auto text-right text-muted ml-auto" id="date"></small>
                        </div>
                        <div class="col-md-12 d-flex">
                            <span class="my-auto" id="subject"></span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div id="viewMessagePanel" class="<?= isMobile() ? 'border-top' : 'border-left' ?> col-md-8 col-sm-12 pt-4 scroll-panel" style="visibility: hidden">
        <?php if (isMobile()) : ?>
            <button class="collapse-btn mb-3" data-toggle="collapse" data-target="#messagesPane">
                <i class="las la-angle-left la-lg"></i> <span class="my-auto ml-3">Return back</span>
            </button>
        <?php endif; ?>

        <div class="row mb-3">
            <div class="col-12">
                <h1 id="msg_subject"></h1>
            </div>
            <div class="col-auto mr-auto">
                <small>
                    <span class="text-muted">Received from </span><span class="text-black" id="msg-from-name"></span>
                </small>
            </div>
            <div class="col-auto">
                <small class="text-muted">
                    <i class="las la-clock"></i> <span id="sent-hour"></span>
                </small>
            </div>
        </div>
        <div class="row border-top mt-4 pt-4 collapse hide" id="message-info-panel">
            <div class="col-sm-12">
                <div class="row mb-2">
                    <div class="col-md-3 col-sm-12 d-flex align-items-center">
                        <small>Sent by</small>
                    </div>
                    <div class="col-md-9 col-sm-12 d-flex flex-column align-items-center">
                        <div class="input-group">
                            <input class="form-control form-control-sm bg-white" readonly value="..." id="info-from-address" />
                            <div class="input-group-append">
                                <button onclick="copyToClipboard('info-from-address', 'Sender address copied to clipboard')" class="btn btn-sm btn-outline-primary" type="button"><i class="las la-copy"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 col-sm-12 d-flex align-items-center">
                        <small>Message ID</small>
                    </div>
                    <div class="col-md-9 col-sm-12 d-flex flex-column align-items-center">
                        <div class="input-group">
                            <input class="form-control form-control-sm bg-white" readonly value="..." id="info-id" />
                            <div class="input-group-append">
                                <button onclick="copyToClipboard('info-id', 'Copied to clipboard')" class="btn btn-sm btn-outline-primary" type="button"><i class="las la-copy"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 col-sm-12 d-flex align-items-center">
                        <small>Receivers</small>
                    </div>
                    <div class="col-md-9 col-sm-12 d-flex flex-column align-items-center">
                        <div class="input-group">
                            <input class="form-control form-control-sm bg-white" readonly value="..." id="info-receivers" />
                            <div class="input-group-append">
                                <button onclick="copyToClipboard('info-receivers', 'Copied to clipboard')" class="btn btn-sm btn-outline-primary" type="button"><i class="las la-copy"></i></button>
                                <button data-toggle="modal" data-target="#addressesDialog" class="btn btn-sm btn-outline-primary" type="button"><i class="las la-project-diagram"></i> View</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 col-sm-12 d-flex align-items-center">
                        <small>Created at</small>
                    </div>
                    <div class="col-md-9 col-sm-12 d-flex flex-column align-items-center">
                        <div class="input-group">
                            <input class="form-control form-control-sm bg-white" readonly value="..." id="info-created-at" />
                            <div class="input-group-append">
                                <button onclick="copyToClipboard('info-created-at', 'Created time copied to clipboard')" class="btn btn-sm btn-outline-primary" type="button"><i class="las la-copy"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 col-sm-12 d-flex align-items-center">
                        <small>Modified at</small>
                    </div>
                    <div class="col-md-9 col-sm-12 d-flex flex-column align-items-center">
                        <div class="input-group">
                            <input class="form-control form-control-sm bg-white" readonly value="..." id="info-updated-at" />
                            <div class="input-group-append">
                                <button onclick="copyToClipboard('info-updated-at', 'Updated time copied to clipboard')" class="btn btn-sm btn-outline-primary" type="button"><i class="las la-copy"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 col-sm-12 d-flex align-items-center">
                        <small>Is modified</small>
                    </div>
                    <div class="col-md-9 col-sm-12 d-flex flex-column align-items-center">
                        <div class="input-group">
                            <input class="form-control form-control-sm bg-white" readonly value="..." id="info-is-modified" />
                            <div class="input-group-append">
                                <button onclick="copyToClipboard('info-is-modified', 'Copied to clipboard')" class="btn btn-sm btn-outline-primary" type="button"><i class="las la-copy"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 col-sm-12 d-flex align-items-center">
                        <small>Blake3 digest</small>
                    </div>
                    <div class="col-md-9 col-sm-12 d-flex flex-column align-items-center">
                        <div class="input-group">
                            <input class="form-control form-control-sm bg-white" readonly value="..." id="info-digest" />
                            <div class="input-group-append">
                                <button onclick="copyToClipboard('info-digest', 'Copied to clipboard')" class="btn btn-sm btn-outline-primary" type="button"><i class="las la-copy"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 col-sm-12 d-flex align-items-center">
                        <small>Blockchain Transactions</small>
                    </div>
                    <div class="col-md-9 col-sm-12 d-flex flex-column align-items-center">
                        <div class="input-group">
                            <button onclick="viewTransactions()" class="btn btn-sm btn-outline-primary" type="button"><i class="las la-link"></i> View transactions</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mt-4 pt-4">
            <div class="col-sm-12">
                <a id="reply-msg-btn" onclick="replyMessage()" href="#" class="s-nav-link"><i class="las la-reply"></i><span>Reply</span></a>
                <a id="edit-msg-btn" onclick="editMessage()" href="#" class="s-nav-link"><i class="las la-pen"></i><span>Edit</span></a>
                <a href="#" class="s-nav-link" data-toggle="collapse" data-target="#message-info-panel"><i class="las la-qrcode"></i><span>Information</span></a>
                <a id="delete-msg-btn" onclick="deleteMessage()" href="#" class="s-danger-link"><i class="las la-trash"></i><span>Delete</span></a>
            </div>
        </div>
        <div class="row border-top mt-4 pt-4">
            <div class="col-sm-12">
                <div class="w-100" id="content"></div>
            </div>
        </div>
    </div>
</div>
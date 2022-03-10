<script src="/js/keys.js"></script>

<div class="row">
    <div class="col">
        <span>You're connected to the network <strong id="networkLabel">loading...</strong></span> <br />
        <button class="btn btn-primary btn-sm mt-2" onclick="logout()">Logout and switch network</button>
        <small class="d-block">This will require you to enter your private words (mnemonics) the next time you log in.</small>
    </div>
</div>

<section id="public-key">
    <span class="section-header">Your public address</span>
    <p>
        This is your public key. It is used as your web address to receive messages,
        contracts and other information. Your public key does not expose your private key.
    </p>
    <input class="form-control bg-white" readonly id="publicKey" value="Getting information from the server..." />
    <ul class="input-links">
        <li>
            <a href="#" onclick="copyPublicKey()"><i class="las la-copy"></i> Copy to clipboard</a>
        </li>
    </ul>
</section>

<section id="private-key">
    <span class="section-header">Your private key</span>
    <p>
        Your private key is the key which controls your identity on the network. It is automatically hidden for security reasons.
        If you want to back up this password or store it somewhere safe, click to view the password below.
    </p>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" onclick="showPrivateKeysDialog()">
        View private key
    </button>

    <!-- Modal -->
    <div class="modal fade" id="keysModal" tabindex="-1" role="dialog" aria-labelledby="keysModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="keysModal">Identity private keys</h5>
                    <button type="button" class="close" data-dismiss="modal" onclick="clearPrivateKeysInformation()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Do not send or show these keys to anyone. Once lost or stolen, your keys cannot be recovered.
                    </p>
                    <label>Private key</label>
                    <textarea id="privateKey" style="height: 250px" class="form-control bg-white font-monospace" readonly></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal" onclick="clearPrivateKeysInformation()">Close</button>
                </div>
            </div>
        </div>
    </div>
</section>
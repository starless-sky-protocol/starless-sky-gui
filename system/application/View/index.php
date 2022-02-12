<script src="js/index.js"></script>

<p>
    Welcome to Starless Sky, an more decentralized, private and secure internet.
</p>
<p>
    Let's connect to a Starless Sky Network you trust. Start it by typing it's address below:
</p>
<form>
    <div class="form-group">
        <label>Starless Sky Network Address:</label>
        <input type="text" oninput="validateAddress(this.value)" id="address" class="form-control" required />
        <div id="addressValidation" class="text-danger d-none mt-2">
            Please, insert an valid URL.
        </div>
    </div>
</form>
<p>
    Never connect to an unknown network or it could be malicious and steal your messages,
    private keys or identities. If necessary, we recommend that you create your own network.
</p>
<p>
    <a href="https://starless-sky-protocol.github.io/docs/#/getting-started">Learn how to make your own Starless Sky Network</a>
</p>
<button id="connectButton" disabled onclick="connect()" class="btn btn-primary mt-3">
    <div id="loadingIcon" class="spinner-border spinner-border-sm text-light d-none">
        <span class="sr-only">Loading...</span>
    </div>
    <span>Connect</span>
</button>
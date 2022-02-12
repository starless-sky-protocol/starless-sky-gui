<script src="/js/import-identity.js"></script>

<p>
    Insert here your recovery phrase to restore your Starless Sky dashboard, including your
    messages, contracts and keys.
</p>

<label>Paste here your secret recovery phrase (mnemonic):</label>
<input id="mnemonic" oninput="checkMnemonic()" class="form-control bg-white" type="password" autocomplete="no" readonly onfocus="this.removeAttribute('readonly');" />

<div class="d-flex flex-column mt-3">
    <button id="continueBtn" disabled onclick="next()" class="mx-auto btn btn-primary">
        <span>Import</span>
    </button>
</div>
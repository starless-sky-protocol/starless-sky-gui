<script src="/js/create-identity.js"></script>
<link rel="stylesheet" href="/css/create-identity.css" />

<p>
    An unique identity was generated and obtained through the server. It is unique and non-transferable.
    Your access is given by the mnemonic below.
</p>
<p>
    Save these values somewhere safe, without them you won't be able
    to regain access to your identity. You won't see them again.
</p>

<div class="row py-3 border rounded-10">
    <div class="col-md-4 col-sm-12">
        <pre class="text-center mnemonic-text" id="mnemonic-1"></pre>
    </div>
    <div class="col-md-4 col-sm-12">
        <pre class="text-center mnemonic-text" id="mnemonic-2">Generating...</pre>
    </div>
    <div class="col-md-4 col-sm-12">
        <pre class="text-center mnemonic-text" id="mnemonic-3"></pre>
    </div>
</div>

<div class="d-flex flex-column mt-3">
    <p class="text-center">
        Before proceeding, make sure this data is in a safe place. Next, you will see your public key information.
    </p>
    <button id="continueBtn" disabled onclick="next()" class="mx-auto btn btn-primary">
        <span>Continue</span>
    </button>
</div>
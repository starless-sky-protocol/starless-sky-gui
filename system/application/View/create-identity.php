<script src="/js/create-identity.js"></script>
<link rel="stylesheet" href="/css/create-identity.css" />

<p>
    An unique identity was generated and obtained through the server. It is unique and non-transferable.
    Your access is given by the information below.
</p>
<p>
    Save these text somewhere safe, without them you won't be able
    to regain access to your identity. You won't see them again.
</p>

<div class="row py-3 border rounded-10">
    <div class="col-12">
        <pre id="private-key">Generating your private key...</pre>
    </div>
</div>

<div class="d-flex flex-column mt-3">
    <p class="text-center">
        Before proceeding, make sure this data is in a safe place. Next, you will see your public key information.
    </p>
    <div class="d-flex justify-content-between">
        <button id="downloadBtn" disabled onclick="downloadKey()" class="btn btn-primary">
            <span>Download private key</span>
        </button>
        <button id="continueBtn" disabled onclick="next()" class="btn btn-primary">
            <span>Continue</span>
        </button>
    </div>
</div>
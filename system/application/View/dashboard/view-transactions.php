<script src="/js/transactions-validator.js"></script>

<div id="main">
    Fetching transactions for ID...
</div>

<div id="not-found" class="mt-3 alert alert-danger" style="display: none">
    <p><strong>Transactions not found</strong></p>
    <p class="mb-0">
        No transactions were found for this content. If the content is very recent,
        it is likely that the block has not yet been calculated by the server.
        If some time has passed and the transaction has not been displayed,
        it is likely that blocks have been deleted on the network.
    </p>
</div>

<div id="not-valid" class="mt-3 alert alert-danger" style="display: none">
    <p><strong>Last transaction wasn't validated</strong></p>
    <p class="mb-0">
        This indicates that the content displayed to you is not
        the same as was served on the network's Blockchain network.
    </p>
</div>

<div id="valid" class="mt-3 alert alert-primary" style="display: none">
    <p><strong>Last transaction validated</strong></p>
    <p class="mb-0">
        Your information is integral with the Blockchain content and the information that is displayed to you is authentic.
    </p>
</div>

<div class="mt-3 py-3 border-top">
    <table class="table-sm w-100">
        <thead>
            <th>Block</th>
            <th>Height</th>
            <th>Transaction ID</th>
            <th>Command</th>
            <th>Is valid</th>
        </thead>
        <tbody id="tbody">
        </tbody>
    </table>
</div>
<script src="/js/public-info.js"></script>

<p class="<?= isMobile() ? 'w-100' : 'w-75' ?>">
    Here you can manage your public information.
    This information is stored on the network and is visible to anyone who has your public key. All fields are optional.
</p>

<section id="info">
    <span class="section-header">My network's address</span>
    <p>
        You can view your network public key (address) in the <a href="/dashboard/settings/keys">Keys screen</a>.
    </p>
</section>

<section id="info">
    <span class="section-header">Identity Public Info</span>

    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                <label>Name:</label>
                <input class="form-control" id="name" />
            </div>
        </div>
        <div class="w-100"></div>
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                <label>Biography:</label>
                <textarea class="form-control" style="height: 200px" id="biography"></textarea>
            </div>
        </div>
        <div class="w-100"></div>
        <div class="col-12">
            <button class="btn btn-primary" onclick="updatePublicInfo()">Update public information</button>
        </div>
    </div>
</section>

<section id="info">
    <span class="section-header">Erase Public Info</span>
    <p class="<?= isMobile() ? 'w-100' : 'w-75' ?>">
        If you no longer want to display the above data to the network, use this option.
        Note that only your public information is deleted, but your public key remains unchanged, as well as your messages and contracts are unaffected.
    </p>
    <button class="btn btn-danger" onclick="deletePublicInfo()">Delete public identity information</button>
</section>
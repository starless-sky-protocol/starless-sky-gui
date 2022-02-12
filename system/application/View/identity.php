<script src="js/identity.js"></script>

<p class="text-center">
    You are on: <span id="networkAddress"></span>
    <br /><a href="#" onclick="switchNetwork()">Switch network</a>
</p>

<div class="row">
    <div class="col-12 mb-3">
        <div class="a card rounded-10" onclick="loadIdentity()">
            <div class="row no-gutters">
                <div class="col-3 d-flex">
                    <i class="m-auto las la-3x la-file-import"></i>
                </div>
                <div class="col-9 d-flex">
                    <div class="card-body my-auto">
                        <h5>Import your existing identity</h5>
                        <p class="mb-0">
                            Use this function if you want to use an existing identity on this network.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="a card rounded-10" onclick="gotoCreateIdentity()">
            <div class="row no-gutters">
                <div class="col-3 d-flex">
                    <i class="m-auto las la-3x la-plus-square"></i>
                </div>
                <div class="col-9 d-flex">
                    <div class="card-body my-auto">
                        <h5>Create a new identity</h5>
                        <p class="mb-0">
                            Create a new unique identity for you.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
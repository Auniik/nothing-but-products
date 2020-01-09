<template>
    <div class="modal fade modalSm" id="exampleModal2" tabindex="-1" role="dialog" style="z-index: 99999">
        <div class="modalSmOverlay"></div>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-content">
                    <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Brand</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Name :</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "sModal",
        data(){

        },
        methods: {

        },
    }
</script>

<style scoped>
    .modalSmOverlay {
        position: fixed;
        width: 100%;
        height: 100%;
        background: #333;
        opacity: .8;
    }

</style>
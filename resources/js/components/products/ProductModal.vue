<template>
    <div class="modal fade" data-backdrop="static" id="exampleModalScrollable" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{edit ? 'Edit' : 'Add New'}} Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>

                    </button>
                </div>
                <slot></slot>
            </div>
        </div>
    </div>


</template>

<script>


    export default {
        name: "ProductModal",
        props: ['edit']
    }
</script>

<style  >
    .rounded-left{
        border-radius: 0
    }
    .rounded-right{
        border-radius: 0;
        width: 50px
    }


</style>
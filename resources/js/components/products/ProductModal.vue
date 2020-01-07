<template>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>

                    </button>
                </div>
                <div class="modal-body">
<!--                    <button class="btn btn-info" @click="showModal()">show modal</button>-->
<!--                    <sModal ref="smodal"/>-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    // import sModal from './Modal'
    export default {
        name: "ProductModal",
        // components: [sModal],
        data(){
            return {
                id: '',
                name: '',
                price: '',
                brand_id: [],
                category_id: []
            }
        },
        methods: {
            showModal() {
                // let element = this.$refs.smodal.$el;
                // console.log(element)
            }
        },
    }
</script>

<style scoped>

</style>
<template>
    <div class="modal fade bd-example-modal-lg" data-backdrop="static" id="exampleModalScrollable" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>

                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-6">

                                <div class="row">
                                    <div class="col-10 pr-0">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select name="category_id" class="custom-select rounded-left">
                                                <option value="">Choose One</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-1 pl-0">
                                        <label for="">&nbsp;</label>
                                        <button type="button" class="btn btn-dark rounded-right" @click="showModal">+
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-10 pr-0">
                                        <div class="form-group">
                                            <label>Brand</label>
                                            <select name="brand_id" class="custom-select rounded-left" >
                                                <option value="">Choose One</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-1 pl-0">
                                        <label for="">&nbsp;</label>
                                        <button type="button" class="btn btn-dark rounded-right" @click="showModal">+
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-dark">Save changes</button>
                </div>
            </div>
        </div>
        <SModal ref="smodal"/>
    </div>


</template>

<script>
    import SModal from './Modal'
    export default {
        name: "ProductModal",
        components: {SModal},
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
                let element = this.$refs.smodal.$el;
                $(element).modal('show')
                console.log(element)
            }
        },
    }
</script>

<style scoped>
    .rounded-left{
        border-radius: 0
    }
    .rounded-right{
        border-radius: 0;
        width: 50px
    }
</style>
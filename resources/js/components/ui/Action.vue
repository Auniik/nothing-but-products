<template>
    <div>
        <td class="text-center">
            <div class="btn-group" role="group">
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-link"
                            data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"> </i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <button class="dropdown-item" @click="handleEdit(productId), showModal()" >Edit</button>
                        <button class="dropdown-item" @click="handleDelete(productId)" >Delete</button>
                    </div>
                </div>
            </div>
        </td>
        <ProductModal ref="modal"/>
    </div>

</template>

<script>
    import ProductModal from "../products/ProductModal";
    export default {
        name: "Action",
        components: {ProductModal},

        props: [
            'productId'
        ],

        data() {
            return {
                product: {}
            }
        },

        methods: {

            handleEdit: productId => {
                // window.axios.get(`/api/products/${productId}`)
                //     .then(({data}) =>  this.product = data )
                // .catch(e => console.log(e))
            },
            handleDelete: productId => {
                // console.log(productId)
            },
            showModal() {
                let element = this.$refs.modal.$el
                $(element).modal('show')
            }
        },
        mounted(){

        }
    }
</script>

<style scoped>

</style>
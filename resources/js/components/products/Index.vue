<template>
    <div class="card">
        <div class="card-header d-flex">
            <h4>Products</h4>
            <button class="btn btn-dark mr-0 ml-auto" @click="showModal">Add</button>
        </div>

        <div class="card-body">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
                    <th scope="col" width="1%">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="product in products" :key="product.id">
                    <td class="text-primary">{{product.name}}</td>
                    <td>{{product.brand.name}}</td>
                    <td>{{product.category.name}}</td>
                    <td>{{product.price}}</td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-link"
                                        data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"> </i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <button class="dropdown-item" @click="handleEdit(product)" >Edit</button>
                                    <button class="dropdown-item" @click="handleDelete(product.id)" >Delete</button>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <ProductModal ref="addModal"/>
    </div>
</template>

<script>
    import ProductModal from "./ProductModal";
    import QuickCreateModal from "../ui/QuickCreateModal"
    export default {
        name: "Index",
        components: {ProductModal, QuickCreateModal},

        data() {
            return {
                products: [],
            }
        },

        methods: {
            showModal() {
                this.$refs.addModal.clearForm()
                let element = this.$refs.addModal.$el;
                $(element).modal('show')
            },

            hideModal(){
                this.$refs.addModal.clearForm()
                let element = this.$refs.addModal.$el;
                $(element).modal('hide')
            },

            handleEdit(product){
                this.isEditModal = true;
                this.$refs.addModal.handleEdit(product)
            },

            handleDelete(productId){
                let confirmed = confirm('Are you sure wan\'t to delete?');
                if (confirmed)
                    window.axios.delete(`api/products/${productId}`)
                        .then(({data}) => {
                            this.getProducts()
                            console.log('Deleted Successfully!')
                        })
            },

            getProducts()
            {
                window.axios.get('/api/products')
                    .then(({data}) => {
                        this.products = data
                    })
                    .catch(e => console.log(e))
            },

            getBrands(){
                window.axios.get('/api/brands')
                    .then(({data}) => {
                        this.brands = data
                    })
                    .catch(e => console.log(e))
            },

            getCategories(){
                window.axios.get('/api/categories')
                    .then(({data}) => {
                        this.categories = data
                    })
                    .catch(e => console.log(e))
            }
        },


        mounted() {
            this.getProducts()
        },
    }
</script>

<style scope>

</style>
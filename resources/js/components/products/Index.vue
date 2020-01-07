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
                    <Action :productId="product.id"/>
                </tr>
                </tbody>
            </table>
        </div>
        <ProductModal ref="addModal"/>
    </div>
</template>

<script>
    import Action from '../ui/Action'
    import ProductModal from "./ProductModal";
    export default {
        name: "Index",
        components: {ProductModal, Action},


        data() {
            return {
                products: []
            }
        },

        methods: {
            showModal() {
                let element = this.$refs.addModal.$el;
                $(element).modal('show')
            }
        },


        mounted() {
            window.axios.get('/api/products')
                .then(({data}) => {
                    this.products = data
                })
                .catch(e => console.log(e))
        },
    }
</script>

<style scoped>

</style>
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

        <ProductModal ref="addModal" :edit="isEditModal">
            <form  @submit.prevent="isEditModal ? handleUpdate() : saveProduct()">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text"
                                   v-model="form.name"
                                   :class="{ 'is-invalid': form.errors.has('name') }"
                                   class="form-control"
                                   name="name"
                                   autocomplete="off"
                            >
                            <has-error :form="form" field="name"/>
                        </div>
                    </div>
                    <div class="col-6">

                        <div class="row">
                            <div class="col-10 pr-0">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category_id"
                                            v-model="form.category_id"
                                            :class="{ 'is-invalid': form.errors.has('category_id') }"
                                            class="custom-select rounded-left"
                                    >
                                        <option value="">Choose One</option>
                                        <option v-for="(name, id) in categories" :value="id">{{name}}</option>
                                    </select>
                                    <has-error :form="form" field="category_id"></has-error>
                                </div>
                            </div>
                            <div class="col-1 pl-0">
                                <label>&nbsp;</label>
                                <button type="button"
                                        class="btn btn-dark rounded-right"
                                        @click="showChildModal(true)"
                                >+
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-10 pr-0">
                                <div class="form-group">
                                    <label>Brand</label>
                                    <select name="brand_id"
                                            v-model="form.brand_id"
                                            :class="{ 'is-invalid': form.errors.has('brand_id') }"
                                            class="custom-select rounded-left"
                                    >
                                        <option value="">Choose One</option>
                                        <option v-for="(name, id) in brands" :value="id">{{name}}</option>
                                    </select>
                                    <has-error :form="form" field="brand_id"></has-error>
                                </div>
                            </div>
                            <div class="col-1 pl-0">
                                <label>&nbsp;</label>
                                <button type="button"
                                        @click="showChildModal(false)"
                                        class="btn btn-dark rounded-right"
                                >+
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text"
                                   v-model="form.price"
                                   :class="{ 'is-invalid': form.errors.has('price') }"
                                   class="form-control"
                                   name="price"
                                   autocomplete="off"
                            >
                            <has-error :form="form" field="price"/>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-dark">{{isEditModal ? 'Update Product' : 'Save changes'}}</button>
            </div>
            </form>
        </ProductModal>

        <ChildModal ref="childModal">
            <form @submit.prevent="isCategoryModal ? addCategory() : addBrand()">
                <div class="modal-header">
                    <h5 class="modal-title" id="childModalLabel">Add {{isCategoryModal ? 'Category': 'Brand'}} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Name :</label>
                        <input type="text"
                               class="form-control"
                               :class="{ 'is-invalid': childForm.errors.has('name') }"
                               name="name"
                               v-model="childForm.name"
                               id="recipient-name"
                        >
                        <has-error :form="childForm" field="name"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </ChildModal>
    </div>
</template>

<script>
    import Action from '../ui/Action'
    import ProductModal from "./ProductModal";
    import ChildModal from "./Modal"
    export default {
        name: "Index",
        components: {ProductModal, ChildModal, Action},

        data() {
            return {
                products: [],
                isEditModal: false,
                form: new Form({
                    id: '',
                    name: '',
                    price: '',
                    brand_id: '',
                    category_id: ''
                }),
                childForm: new Form({
                    id: '',
                    name: ''
                }),
                brands: [],
                categories: [],
                isCategoryModal: true
            }
        },

        methods: {
            showModal() {
                this.form.clear()
                this.form.reset()

                let element = this.$refs.addModal.$el;
                $(element).modal('show')
            },

            hideModal(){
                let element = this.$refs.addModal.$el;
                $(element).modal('hide')
            },

            saveProduct () {
                this.form.post('/api/products')
                    .then(({ data }) => {
                        this.hideModal()
                        this.getProducts()
                        console.log(data)
                    })
            },

            handleEdit(product){

                this.isEditModal = true,
                this.showModal()
                this.form.fill(product);
            },

            handleUpdate(){

                this.form.patch(`api/products/${this.form.id}`)
                    .then(({data}) => {
                        this.getProducts()
                        this.hideModal()
                    })
            },

            handleDelete(productId){
                window.axios.delete(`api/products/${productId}`)
                    .then(({data}) => {
                        this.getProducts()
                        console.log('Deleted Successfully!')
                    })

            },

            showChildModal(isCategory){
                this.childForm.clear()
                let element = this.$refs.childModal.$el;
                $(element).modal('show')
                this.isCategoryModal = isCategory ? true : false;
            },
            addCategory(){

                this.childForm.post('/api/categories')
                .then(({data}) => {
                    this.getCategories();
                    let element = this.$refs.childModal.$el;
                    $(element).modal('hide')
                    console.log(data)
                });
            },

            addBrand(){
                let element = this.$refs.childModal.$el;
                $(element).modal('show')
                this.childForm.post('/api/brands')
                    .then(({data}) => {
                        this.getBrands();
                        let element = this.$refs.childModal.$el;
                        $(element).modal('hide')
                        console.log(data)
                    });
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
            this.getProducts(),
            this.getBrands(),
            this.getCategories()


        },
    }
</script>

<style scope>

</style>
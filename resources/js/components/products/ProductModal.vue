<template>
    <div class="modal fade" data-backdrop="static" id="exampleModalScrollable" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{isEditModal ? 'Edit' : 'Add New'}} Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>

                    </button>
                </div>
                <form  @submit.prevent="isEditModal ? handleUpdate() : handleStore()"
                       @keydown="form.onKeydown($event)"
                >
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
                                                @click="showQuickModal({
                                                    label: 'Category',
                                                    url: '/api/categories',
                                                    target: 'categories'
                                                })"
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
                                                @click="showQuickModal({
                                                    label: 'Brands',
                                                    url: '/api/brands',
                                                    target: 'brands'
                                                })"
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
                        <button type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                                @click="handleHideModal"
                        >Close</button>
                        <button type="submit"
                                class="btn btn-dark">
                            {{isEditModal ? 'Update Product' : 'Save changes'}}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <QuickCreateModal ref="quickModal" />
    </div>


</template>

<script>
    import QuickCreateModal from "../ui/QuickCreateModal";

    export default {
        name: "ProductModal",
        components: {QuickCreateModal},
        data(){
            return {
                form: new Form({
                    id: '',
                    name: '',
                    price: '',
                    brand_id: '',
                    category_id: ''
                }),
                brands: [],
                categories: [],
                isEditModal: false,
            }
        },

        methods: {
            showModal(){
                this.clearForm();
                this.refreshCategoriesBrands();
                $(this.$el).modal('show');
            },
            handleHideModal(){
                this.clearForm();
                $(this.$el).modal('hide')
            },
            handleEdit(product){
                this.showModal();
                this.isEditModal = true;
                this.form.fill(product);
            },

            handleStore () {
                this.form.post('/api/products')
                    .then(({ data }) => this.refreshProducts())
                    .catch(err => console.log(err.response))
            },
            handleUpdate(){
                this.form.patch(`api/products/${this.form.id}`)
                    .then(({data}) => {
                        this.refreshProducts()
                        this.isEditModal = false;
                    })
                    .catch(err => console.log(err.response))
            },


            showQuickModal(options){
                this.$refs.quickModal.showModal(options)
            },


            getBrands(){
                window.axios.get('/api/brands')
                    .then(({data}) => this.brands = data )
                    .catch(e => console.log(e))
            },
            getCategories(){
                window.axios.get('/api/categories')
                    .then(({data}) =>  this.categories = data )
                    .catch(e => console.log(e))
            },

            clearForm(){
                this.form.clear()
                this.form.reset()
            },

            refreshProducts(){
                this.handleHideModal()
                this.$parent.getProducts()
            },
            refreshCategoriesBrands() {
                this.getBrands();
                this.getCategories();
            }
        },

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
<template>
    <div class="modal fade modalSm" id="exampleModal2" tabindex="-1" role="dialog" style="z-index: 99999">
        <div class="modalSmOverlay"></div>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-content">
                    <form @submit.prevent="handleSave">
                        <div class="modal-header">
                            <h5 class="modal-title" id="childModalLabel">Add {{options.label}} </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Name :</label>
                                <input type="text"
                                       class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('name') }"
                                       name="name"
                                       v-model="form.name"
                                       id="recipient-name"
                                >
                                <has-error :form="form" field="name"/>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-dark">Save</button>
                            <button type="button" class="btn btn-secondary" @click="hideModal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "QuickCreateModal",
        props: ['quickModalOption'],
        data(){
            return {
                form: new Form({
                    id: '',
                    name: ''
                }),
                options: {}
            }
        },

        methods: {

            showModal(options){
                this.options = options;
                $(this.$el).modal('show');
            },

            hideModal(){
                this.options = {};
                this.form.clear();
                this.form.reset();
                $(this.$el).modal('hide').animate(100);
            },

            handleSave(){
                this.form.post(this.options.url)
                    .then(({data}) => {
                        this.$parent.refreshCategoriesBrands(),
                        this.hideModal();
                    }).catch(e => console.log(e));
            },
        }

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
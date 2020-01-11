<template>
    <div class="modal fade modalSm" id="exampleModal2" tabindex="-1" role="dialog" style="z-index: 99999">
        <div class="modalSmOverlay"></div>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-content">
                    <form @submit.prevent="addData">
                        <div class="modal-header">
                            <h5 class="modal-title" id="childModalLabel">Add {{quickModalOption.label}} </h5>
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
            }
        },

        methods: {
            addData(){
                this.form.post(this.quickModalOption.url)
                    .then(({data}) => {
                        this.$parent.getBrands(),
                        this.$parent.getCategories(),
                        this.hideModal();
                    }).catch(e => console.log(e));
            },

            hideModal(){
                let element = this.$el
                $(element).modal('hide').animate(100);
            }
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
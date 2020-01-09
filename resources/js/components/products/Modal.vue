<template>
    <div class="modal fade modalSm" id="exampleModal2" tabindex="-1" role="dialog" style="z-index: 99999">
        <div class="modalSmOverlay"></div>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-content">
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ChildModal",

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
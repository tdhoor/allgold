<template>
    <!-- Modal -->
    <div
        class="modal fade"
        :id="modalName"
        tabindex="-1"
        role="dialog"
        aria-hidden="true"
        aria-labelledby="exampleModalCenterTitle"
    >
        <div class="modal-dialog modal-dialog-top" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ title }}</h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col message">
                        <p>
                            <span v-html="message"></span>
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ModalMessage',
    props: ['modalName', 'title', 'message']
}
</script>

<style>
.message {
    white-space: pre-wrap;
    word-wrap: break-word;
}
</style>

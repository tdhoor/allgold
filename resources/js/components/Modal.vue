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
        <div class="modal-dialog modal-dialog-centered" role="document">
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
                    <form>
                        <div class="form-row">
                            <div
                                class="form-group col-md-6"
                                v-for="(value, key) in items"
                                :key="key"
                            >
                                <label for="inputEmail4">{{ key }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    :id="key"
                                    :placeholder="value"
                                    :readonly="
                                        key.includes('id') ||
                                        key.includes('created') ||
                                        key.includes('updated')
                                    "
                                    v-model="items[key]"
                                />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                    >
                        Close
                    </button>
                    <button
                        @click="saveEntry()"
                        type="button"
                        class="btn btn-primary"
                    >
                        Speichern
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Modal',
    props: ['items', 'modalName', 'title'],
    watch: {
        items: {
            deep: true,
            handler(newItem) {
                return newItem
            }
        }
    },
    methods: {
        saveEntry: function () {
            this.$parent.saveEntry(this.items)
        }
    }
}
</script>

<style></style>

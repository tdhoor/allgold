<template>
    <!-- Modal -->
    <div
        class="modal fade"
        :id="modalName"
        tabindex="-1"
        role="dialog"
        aria-hidden="true"
        data-backdrop="static"
        data-keyboard="false"
    >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ title }}</h5>
                    <button
                        @click="reset()"
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
                                <label :for="value">{{
                                    key.replace('_hide', '').replace('_', '')
                                }}</label>
                                <input
                                    v-if="key !== '_type'"
                                    :type="handleInputType(key, value)"
                                    class="form-control"
                                    :id="key"
                                    :readonly="
                                        key.toLowerCase().includes('id') ||
                                        key.includes('created') ||
                                        key.includes('updated') ||
                                        key.includes('info')
                                    "
                                    v-model="items[key]"
                                    required
                                />

                                <select
                                    v-if="key === '_type'"
                                    v-model="items[key]"
                                    class="form-control"
                                    required
                                >
                                    <option value="A">Automaten</option>
                                    <option value="B">
                                        Verkaufsstelle mit Automaten
                                    </option>
                                    <option value="V">Verkaufsstelle</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button
                        @click="reset()"
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                    >
                        {{ BTN_TXT_CLOSE }}
                    </button>
                    <button
                        @click="saveEntry()"
                        type="button"
                        class="btn btn-primary"
                    >
                        {{ BTN_TXT_SAVE }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { BTN_TXT_SAVE, BTN_TXT_CLOSE } from '../utils/Variables'

export default {
    name: 'Modal',
    props: ['items', 'modalName', 'title'],
    watch: {
        items: {
            deep: true,
            handler(newItem) {
                if (this.firstLoad) {
                    this.backupItem = { ...newItem }
                    this.firstLoad = false
                }
                return newItem
            }
        }
    },
    data() {
        return {
            backupItem: {},
            firstLoad: true,
            BTN_TXT_SAVE: BTN_TXT_SAVE,
            BTN_TXT_CLOSE: BTN_TXT_CLOSE
        }
    },
    methods: {
        saveEntry: function () {
            this.$parent.handleModalSave(this.items)
            this.firstLoad = true
        },
        reset: function () {
            for (let item in this.backupItem) {
                this.items[item] = this.backupItem[item]
            }
            this.firstLoad = true
        },
        handleInputType: function (key, value) {
            const type = typeof this.backupItem[key]
            const types = {
                number: 'number',
                string: 'text'
            }
            return types[type] || 'text'
        }
    }
}
</script>

<style></style>

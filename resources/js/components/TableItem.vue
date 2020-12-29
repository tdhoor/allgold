<template>
    <tr>
        <!-- items -->
        <td v-for="(value, key) in item" :key="key">
            {{ value }}
        </td>
        <!-- btns -->
        <td class="btn-box">
            <input
                v-if="inputField"
                type="number"
                class="form-control"
                :placeholder="inputPlaceholder"
            />
            <a
                v-if="btnAction"
                @click="clickTableAction()"
                class="btn btn-primary"
                >{{ BTN_TXT_ADD }}</a
            >
            <a
                v-if="btnEdit"
                @click="clickTableEdit()"
                class="btn btn-warning"
                >{{ BTN_TXT_EDIT }}</a
            >
            <a
                v-if="btnDelete"
                @click="clickTableDelete()"
                class="btn btn-danger"
                >{{ BTN_TXT_DELETE }}</a
            >
        </td>
    </tr>
</template>

<script>
import { BTN_TXT_ADD, BTN_TXT_EDIT, BTN_TXT_DELETE } from '../utils/Variables'

export default {
    name: 'TableItem',
    props: [
        'item',
        'btnAction',
        'btnDelete',
        'btnEdit',
        'inputField',
        'inputPlaceholder'
    ],
    data() {
        return {
            BTN_TXT_ADD: BTN_TXT_ADD,
            BTN_TXT_EDIT: BTN_TXT_EDIT,
            BTN_TXT_DELETE: BTN_TXT_DELETE
        }
    },
    methods: {
        clickTableAction: function () {
            this.$parent.clickTableAction(this.item)
        },
        clickTableEdit: function () {
            this.$parent.clickTableEdit(this.item)
        },
        clickTableDelete: function () {
            this.$parent.clickTableDelete(this.item)
        }
    }
}
</script>

<style>
.btn-box {
    display: flex;
}
.btn-box > a,
.btn-box > input {
    margin-right: 4px;
}
.btn-box > input {
    max-width: 100px;
}
</style>

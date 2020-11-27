<template>
    <tr>
        <!-- items -->
        <td v-for="(value, key) in item" :key="key">
            {{ value }}
        </td>
        <!-- btns -->
        <td>
            <a
                v-if="btnAction"
                @click="clickTableAction()"
                class="btn btn-primary"
                >Add</a
            >
            <a v-if="btnEdit" @click="clickTableEdit()" class="btn btn-warning"
                >Edit</a
            >
            <a
                v-if="btnDelete"
                @click="clickTableDelete()"
                class="btn btn-danger"
                >Delete</a
            >
        </td>
    </tr>
</template>

<script>
export default {
    name: 'TableItem',
    props: ['item', 'btnAction', 'btnDelete', 'btnEdit'],
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

<style></style>

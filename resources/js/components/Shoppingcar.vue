<template>
    <div></div>
</template>

<script>
export default {
    name: 'Table',
    props: ['items', 'btnAction', 'btnEdit', 'btnDelete'],
    methods: {
        clickTableAction: function (index) {
            this.$parent.clickTableAction(this.items[index])
        },
        clickTableEdit: function (index) {
            this.$parent.clickTableEdit(this.items[index])
        },
        clickTableDelete: function (index) {
            this.$parent.clickTableDelete(this.items[index])
        }
    }
}
</script>

<style></style>

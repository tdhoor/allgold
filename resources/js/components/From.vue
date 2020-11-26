<template>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <!-- foreach element -->
                    <th v-for="(value, key) in items[0]" :key="key">
                        {{ key.replace('_', '') }}
                    </th>
                    <!-- btns -->
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- @foreach($stations as $station) -->
                <tr v-for="(item, i) in items" :key="i">
                    <td v-for="(value, key) in item" :key="key">
                        {{ value }}
                    </td>
                    <td>
                        <a
                            v-if="btnAction"
                            @click="clickTableAction(i)"
                            class="btn btn-primary"
                            >Add</a
                        >
                        <a
                            v-if="btnEdit"
                            @click="clickTableEdit(i)"
                            class="btn btn-warning"
                            >Edit</a
                        >
                        <a
                            v-if="btnDelete"
                            @click="clickTableDelete(i)"
                            class="btn btn-danger"
                            >Delete</a
                        >
                    </td>
                </tr>
                <!-- @endforeach -->
            </tbody>
        </table>
    </div>
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

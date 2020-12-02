<template>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <TableHeader :item="items[0]" />
            </thead>
            <tbody>
                <TableItem
                    v-for="(item, i) in items"
                    :key="i"
                    :item="item"
                    :btnAction="btnAction"
                    :btnEdit="btnEdit"
                    :btnDelete="btnDelete"
                />
            </tbody>
        </table>
    </div>
</template>

<script>
import TableHeader from './TableHeader'
import TableItem from './TableItem'

export default {
    name: 'Table',
    components: { TableHeader, TableItem },
    props: ['items', 'btnAction', 'btnDelete', 'btnEdit', 'modalName'],
    methods: {
        clickTableAction: function (item) {
            this.$parent.clickTableAction(item)
        },
        clickTableEdit: function (item) {
            this.$parent.clickTableEdit(item)
        },
        clickTableDelete: function (item) {
            this.$parent.clickTableDelete(item)
        }
    }
}
</script>

<style>
.table-responsive {
    height: 100%;
}
tbody {
    height: 100%;
    overflow-y: scroll;
}

/* .table-responsive {
    height: 100%;
    position: absolute;
    width: 100vw;
    left: 15px;
}
thead {
    position: sticky;
    top: 0;
    background: white;
}
thead::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 10px;
    bottom: -8px;
    background: linear-gradient(white, transparent);
} */
</style>

<template>
    <tr>
        <!-- item -->
        <th v-for="(value, key) in item" :key="key">
            {{ key.replace('_', '') }}
        </th>
        <!-- btns -->
        <th></th>
    </tr>
</template>

<script>
export default {
    name: 'TableHeader',
    props: ['item'],
    watch: {
        item: function (newItem) {
            return newItem
        }
    }
}
</script>

<style></style>

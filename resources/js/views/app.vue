<template>
    <div>
        {{ message }}
        <button @click="test('sales')">sales</button>
        <button @click="test('inventories')">inventories</button>
        <button @click="test('products')">products</button>
        <button @click="test('shoppingcars')">shoppingcars</button>
        <button @click="test('stations')">stations</button>
    </div>
</template>
<script>
const default_layout = "default";

export default {
    computed: {

    },
    data () {
        return   {
            message: "hallo world!"
        };
    },
    methods: {
        test: (param) => {
            fetch('http://www.allgold.de/api/' + param, {
                    headers: {
                    Accept: 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': 's1CIuqNWtySD6EPGZRLEagORJnkcnELILBxZqK4p',
                },
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => console.log(data));
        }
    }
};
</script>

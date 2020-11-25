<template>
    <div>
        <Header v-bind:subPages="navItems" />
        <h1>verkauf</h1>
    </div>
</template>

<script>
import Header from '../components/Header';

export default {
    components: {
        Header,
    },
    computed: {

    },
    data () {
        return   {
            message: 'hellow',
            navItems: [
                {'url': 'http://www.allgold.de/verkaufsstellen', 'name': 'Verkaufsstellen'},
                {'url': 'http://www.allgold.de/lieferanten', 'name': 'Lieferanten'},
                {'url': 'http://www.allgold.de/verkauf', 'name': 'Verkauf'},
                {'url': 'http://www.allgold.de/reporting', 'name': 'Reporting'},
                {'url': 'http://www.allgold.de/formulare', 'name': 'Formulare'},
            ]
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
}
</script>

<template>
    <div>
        <Header />
        <div class="container p-5">
            <div class="row" style="overflow-y: hidden !important">
                <div
                    class="col-sm-3 m-3"
                    v-for="card in cards"
                    :key="card.btn.url"
                >
                    <CardItem :props="card" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Header from '../components/Header'
import CardItem from '../components/CardItem.vue'

export default {
    components: {
        Header,
        CardItem
    },
    computed: {},
    data() {
        return {
            message: 'hellow',
            cards: [
                {
                    heading: 'Verkaufsstellen',
                    subheading: 'Geschäftsführer',
                    text:
                        'Mit dieser App können Sie alle Verkaufstellen verwalten.',
                    btn: {
                        url: 'http://www.allgold.de/verkaufsstellen',
                        text: 'Starten'
                    }
                },
                {
                    heading: 'Lieferanten',
                    subheading: 'Lieferant',
                    text:
                        'Mit dieser App können Produktauffüllungen erfasst und Auffüllpläne erstellt werden.',
                    btn: {
                        url: 'http://www.allgold.de/lieferanten',
                        text: 'Starten'
                    }
                },
                {
                    heading: 'Verkauf',
                    subheading: 'Verkäufer',
                    text:
                        'Mit dieser App können Verkäufe und Produkte erfasst werden.',
                    btn: {
                        url: 'http://www.allgold.de/verkauf',
                        text: 'Starten'
                    }
                },
                {
                    heading: 'Reporting',
                    subheading: 'Geschäftsführer, Lagermitarbeiter',
                    text:
                        'Diese App dient zur Lagerverwaltung und zum erstellen von Produktumsatz- und Verkaufsstellenauszug.',
                    btn: {
                        url: 'http://www.allgold.de/reporting',
                        text: 'Starten'
                    }
                },
                {
                    heading: 'Formulare',
                    subheading: 'Mitarbeiter von Allgäu GmbH',
                    text:
                        'Mit dieser App können diverse Formulare und Dokumente gedruckt werden.',
                    btn: {
                        url: 'http://www.allgold.de/formulare',
                        text: 'Starten'
                    }
                }
            ]
        }
    },
    methods: {}
}
</script>

<style scoped></style>

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
import Server, {
    URL_VERKAUFSSTELLEN,
    URL_FORMULARE,
    URL_LIEFERANTEN,
    URL_REPORTING,
    URL_VERKAUF
} from '../server/Server'
import {
    APP_VERKAUFSSTELLEN_TITLE,
    APP_FORMULARE_TITLE,
    APP_LIEFERANTEN_TITLE,
    APP_REPORTING_TITLE,
    APP_VERKAUF_TITLE,
    BTN_TXT_START
} from '../utils/Variables'

export default {
    components: {
        Header,
        CardItem
    },
    computed: {},
    data() {
        return {
            message: '',
            cards: [
                {
                    heading: APP_VERKAUFSSTELLEN_TITLE,
                    subheading: 'Geschäftsführer',
                    text:
                        'Mit dieser App können Sie alle Verkaufstellen verwalten.',
                    btn: {
                        url: URL_VERKAUFSSTELLEN,
                        text: BTN_TXT_START
                    }
                },
                {
                    heading: APP_LIEFERANTEN_TITLE,
                    subheading: 'Lieferant',
                    text:
                        'Mit dieser App können Produktauffüllungen erfasst und Auffüllpläne erstellt werden.',
                    btn: {
                        url: URL_LIEFERANTEN,
                        text: BTN_TXT_START
                    }
                },
                {
                    heading: APP_VERKAUF_TITLE,
                    subheading: 'Verkäufer',
                    text:
                        'Mit dieser App können Verkäufe und Produkte erfasst werden.',
                    btn: {
                        url: URL_VERKAUF,
                        text: BTN_TXT_START
                    }
                },
                {
                    heading: APP_REPORTING_TITLE,
                    subheading: 'Geschäftsführer, Lagermitarbeiter',
                    text:
                        'Diese App dient zur Lagerverwaltung und zum erstellen von Produktumsatz- und Verkaufsstellenauszug.',
                    btn: {
                        url: URL_REPORTING,
                        text: BTN_TXT_START
                    }
                },
                {
                    heading: APP_FORMULARE_TITLE,
                    subheading: 'Mitarbeiter von Allgäu GmbH',
                    text:
                        'Mit dieser App können diverse Formulare und Dokumente gedruckt werden.',
                    btn: {
                        url: URL_FORMULARE,
                        text: BTN_TXT_START
                    }
                }
            ]
        }
    },
    methods: {}
}
</script>

<style scoped></style>

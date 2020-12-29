<template>
    <nav id="navbar" class="navbar navbar-dark bg-primary navbar-expand-lg">
        <a class="navbar-brand" href="/">{{ APP_TITLE }} {{ title }}</a>
        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item" v-for="item in items" :key="item.name">
                    <a class="nav-link" v-bind:href="item.url">{{
                        item.name
                    }}</a>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
import { APP_TITLE } from '../utils/Variables'

export default {
    name: 'Header',
    props: ['subPages'],
    data() {
        return {
            title: 'Allgold',
            items: []
        }
    },
    mounted() {
        this.title = this.$props.title
        this.items = this.$props.subPages
    }
}
</script>

<style></style>

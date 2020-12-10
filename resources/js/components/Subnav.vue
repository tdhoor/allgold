<template>
    <nav
        class="navbar navbar-light navbar-expand-lg"
        style="background-color: #e3f2fd"
    >
        <a class="navbar-brand" href="#">{{ title || 'Aktionen:' }}</a>
        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul
                class="navbar-nav ml-auto mt-2 mt-lg-0"
                style="margin-right: 12px"
            >
                <li class="nav-item" v-if="btnRefresh">
                    <button
                        @click="handleRefresh"
                        id="btnRefresh"
                        class="btn btn-outline-primary ml-auto my-lg-0"
                        style="margin-right: 12px"
                    >
                        Refresh
                    </button>
                </li>
                <li class="nav-item" v-if="btnAdd">
                    <button
                        @click="handleAdd"
                        id="btnAdd"
                        class="btn btn-outline-primary ml-auto my-lg-0"
                        style="margin-right: 12px"
                    >
                        Add
                    </button>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" v-if="formSearch">
                <input
                    class="form-control mr-sm-2"
                    type="text"
                    :value="inputText"
                    @input="inputText = $event.target.value"
                    placeholder="Station id or location..."
                />
                <button
                    @click.prevent="handleSearch()"
                    id="btnSubmit"
                    class="btn btn-outline-primary my-2 my-sm-0"
                    type="submit"
                    style="80px;"
                >
                    Search
                </button>
            </form>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'Subnav',
    props: ['formSearch', 'btnRefresh', 'btnAdd', 'title'],
    data() {
        return {
            searchValue: null,
            inputText: ''
        }
    },
    methods: {
        handleSearch: function () {
            this.$parent.handleSearch(this.inputText)
        },
        handleRefresh: function () {
            this.$parent.handleRefresh()
        },
        handleAdd: function () {
            this.$parent.handleAdd()
        }
    },
    watch: {
        inputText(el) {
            console.log(el)
        }
    }
}
</script>

<style></style>

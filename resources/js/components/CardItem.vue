<template>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title" :v-if="props.heading">
                {{ props.heading }}
            </h5>
            <h6 class="card-subtitle mb-2 text-muted" :v-if="props.subheading">
                {{ props.subheading }}
            </h6>
        </div>
        <div class="card-body">
            <p class="card-text" :v-if="props.text">{{ props.text }}</p>
            <a
                :href="props.btn.url"
                class="btn btn-primary"
                :v-if="props.btn"
                >{{ props.btn.text }}</a
            >
        </div>
    </div>
</template>

<script>
export default {
    props: ['props']
}
</script>

<style scoped>
.card {
    min-height: 300px;
}
.card-body {
    justify-content: space-between;
    display: flex;
    flex-direction: column;
}
</style>

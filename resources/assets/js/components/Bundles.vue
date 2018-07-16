

<template>
    <div class="container">
        <h2>Bundles</h2>
        <div class="row row-margin" v-for="i in Math.ceil(results.length / 3)" :key="'row' + i">
            <bundle v-for="result in results.slice((i - 1) * 3, i * 3)" 
            v-bind:key="result.id" v-bind:result="result">
            </bundle>
        </div>
    </div>
</template>

<script>
export default {

    data: function() {
        return {
            results: []
        }
    },

    created() {
        axios.get('api/bundles')
            .then((response) => {
                this.results = response.data
            })
            .catch(e => console.log(e));
    }
}
</script>

<style>

.row-margin {
    margin-bottom: 20px;
}

</style>

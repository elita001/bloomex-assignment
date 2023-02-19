<script>
    export default {
        emits: [
            'response'
        ],
        data() {
            return {
                countries: []
            }
        },
        methods: {
            async fetchData() {
                this.countries = []
                const res = await fetch(
                    `/api/userAddresses/countries`
                )
                this.countries = await res.json()
            },
            countrySelected(e) {
                this.$emit('response', e.target.value)
            }
        },
        mounted() {
            this.fetchData()
        },
    }
</script>
<template>
    <label>Filter by Country:</label>
    <select name="country_filter" class="users-datatable-filter-country" @change="countrySelected">
        <option value="">-Select Country-</option>
        <option v-for="country in countries" :key="country" :value="country">{{ country }}</option>
    </select>
</template>
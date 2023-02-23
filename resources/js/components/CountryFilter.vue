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
    <label for="users-datatable-filter-country" class="form-label">Filter by Country:</label>
    <select id="users-datatable-filter-country" name="country_filter" class="form-select" @change="countrySelected">
        <option value="">-Select Country-</option>
        <option v-for="country in countries" :key="country" :value="country">{{ country }}</option>
    </select>
</template>
<script>
    import DataTable from 'datatables.net-vue3';
    import DataTablesLib from 'datatables.net';
    import CountryFilter from './CountryFilter.vue';
    DataTable.use(DataTablesLib);

    export default {
        components: {
            DataTable,
            CountryFilter
        },
        data() {
            return {
                columns: [
                    {
                        data: 'firstname',
                        name: 'users.firstname'
                    },
                    {
                        data: 'lastname',
                        name: 'users.lastname'
                    },
                    {
                        data: 'email',
                        name: 'users.email'
                    },
                    {
                        data: 'userPhones',
                        name: 'userPhones',
                        orderable: false,
                        render: function(data) {
                            let html = '<ul>';
                            for (let i in data) {
                                let phone = data[i];
                                html += '<li>' + phone.phone_number + ' (<strong>' + phone.phone_type + '</strong>)' + '</li>';
                            }
                            html += '</ul>';
                            return html;
                        }
                    },
                    {
                        data: 'userAddress',
                        name: 'userAddress',
                        orderable: false,
                        render: function(data) {
                            if (!data)
                                return '';
                            return [data.street, data.city,data.country, data.zip].join(', ');
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'users.created_at',
                        type: 'datetime'
                    }
                ],
                options: {
                    serverSide: true
                },
                ajax: {
                    url: "/api/users",
                    data: function(d) {
                        let filters = [];
                        let countrySelect = document.querySelector('.users-datatable-filter-country');
                        if (countrySelect && countrySelect.value) {
                            filters.push({
                                relation: "userAddress",
                                column: "user_addresses.country",
                                value: countrySelect.value,
                                operator: "="
                            });
                        }
                        d.filter = filters;
                        return d;
                    }
                },
                dt: null
            }
        },
        mounted() {
            this.dt = this.$refs.table.dt();
        },
        methods: {
            countrySelected(country) {
//                console.log(this.dt.ajax.params());
                this.dt.ajax.reload();
            }
        }
    }
</script>

<template>
    <div class="container">
        <h1>Bloomex Users</h1>
        <CountryFilter @response="(country) => countrySelected(country)" />
        <DataTable
                ref="table"
                class="display"
                width="100%"
                :columns="columns"
                :options="options"
                :ajax="ajax"
        >
            <thead>
            <tr>
                <th>First Name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Created</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>First Name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Created</th>
            </tr>
            </tfoot>
        </DataTable>
    </div>
</template>

<style>
@import 'datatables.net-dt';
</style>

<script>
    import DataTable from 'datatables.net-vue3';
    import DataTablesLib from 'datatables.net-bs5';
    import 'datatables.net-datetime';
    import 'datatables.net-responsive-bs5';
    import 'datatables.net-searchpanes-bs5';
//    import 'datatables.net-bs5';
    import CountryFilter from './CountryFilter.vue';
    import Navbar from './Navbar.vue';
    DataTable.use(DataTablesLib);

    export default {
        components: {
            DataTable,
            CountryFilter,
            Navbar
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
                        type: 'datetime',
                        render: function(data) {
                            return new Date(data).toLocaleDateString();
                        }
                    }
                ],
                options: {
                    serverSide: true
                },
                ajax: {
                    url: "/api/users",
                    data: function(d) {
                        let filters = [];
                        let countrySelect = document.getElementById('users-datatable-filter-country');
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
    <Navbar />
    <div class="container">
        <h1 class="text-center  mt-4 mb-3">Bloomex Users</h1>
        <div class="row">
            <div class="col-lg-3 col-md-4 mb-2">
                <CountryFilter @response="(country) => countrySelected(country)" />
            </div>
        </div>
        <DataTable
                ref="table"
                class="display table table-striped table-bordered dt-responsive nowrap"
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
@import 'bootstrap';
@import 'datatables.net-bs5';
@import 'datatables.net-datetime';
@import 'datatables.net-responsive-bs5';
@import 'datatables.net-searchpanes-bs5';
</style>

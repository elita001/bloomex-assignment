<script setup lang="ts">
    import DataTable from 'datatables.net-vue3';
    import DataTablesLib from 'datatables.net';

    DataTable.use(DataTablesLib);

    const columns = [
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
                // TODO use Vue component
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
            // TODO use Vue component
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
    ];
</script>

<template>
<div class="container">
    <h1>Bloomex Users</h1>
    <DataTable
            :columns="columns"
            :options="{serverSide: true}"
            ajax="/api/users"
            class="display"
            width="100%"
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

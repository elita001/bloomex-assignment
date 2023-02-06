<script setup lang="ts">
    import DataTable from 'datatables.net-vue3';
    import DataTablesLib from 'datatables.net';

    DataTable.use(DataTablesLib);

    const columns = [
        { data: 'firstname' },
        { data: 'lastname' },
        { data: 'email' },
        {
            data: 'userPhones',
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
            orderable: false,
            render: function(data) {
                if (!data || !data.hasOwnProperty('street'))
                    return '';
                return [data.street, data.city,data.country, data.zip].join(', ');
            }
        },
        {
            data: 'created_at'
        }
    ];
</script>

<template>
<div class="container">
    <h1>Ajax data source table</h1>
    <h2>DataTables + Vue3 example</h2>
    <p>
        In this example the <code>datatables.net-vue3</code> package is used to
        load JSON data and display it in an interactive table. In this case we use
        object based row data, rather than arrays, so the
        <code>columns</code> option is specified to tell DataTables which property
        to read from the objects for each column.
    </p>

    <DataTable
            :columns="columns"
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

@extends('layouts.app')
@section('content')
@include('partials.navbar')
<main class="content-page" id="app">
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Supplies</h1>
            </div>
        </div>
    </section>
    <div class="container">
        <table id="supplies" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Grade</th>
                    <th>Price</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</main>
<script type="module">
    createApp({
        mounted() {
            this.loadTable();
        },
        methods: {
            loadTable() {
                new DataTable('#supplies', {
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('supplies.datatables') }}",
                        type: 'GET'
                    },
                    columns: [
                        { data: 'id' },
                        { data: 'name' },
                        { data: 'grade' },
                        { data: 'price' },
                        { data: 'created_at' },
                        { data: 'updated_at' },
                        {
                            data: null, // No vinculamos esta columna a un campo específico
                            render: function(data, type, row) {
                            return `
                                <button class="edit-btn" data-id="${row.id}">Edit</button>
                                <button class="delete-btn" data-id="${row.id}">Delete</button>
                            `;
                        }
            }
                    ]
                });
            }
        }
    }).mount('#app');
</script>
@endsection
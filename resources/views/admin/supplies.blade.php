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
                    <th></th>
                    <th></th>
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
                        url: "{{ url('/api/supplie/datatables') }}",
                        type: 'GET',
                        headers: {
                            'Authorization': 'Bearer ' + "{{ session('token') }}"
                        }
                    },
                    columns: [{
                            data: 'id'
                        },
                        {
                            data: 'name'
                        },
                        {
                            data: 'grade'
                        },
                        {
                            data: 'price'
                        },
                        {
                            data: 'created_at'
                        },
                        {
                            data: 'updated_at'
                        },
                        {
                            data: null,
                            render: function(data, type, row) {
                                let element = createIcon('edit');
                                let url = "{{ url('admin/supplie') }}/" + row.id;
                                element.setAttribute('href', url);
                                element.setAttribute('target', '_blank');
                                return element;
                            }
                        },
                        {
                            data: null,
                            render: function(data, type, row) {
                                let element = createIcon('delete');
                                element.addEventListener('click', function(event) {
                                    event.preventDefault();
                                    let url = "{{ url('api/supplie') }}/" + row.id;
                                    deleteElement(url, row.name, "{{ session('token') }}");
                                });
                                return element;
                            }
                        }
                    ]
                });
            }
        }
    }).mount('#app');
</script>
@endsection
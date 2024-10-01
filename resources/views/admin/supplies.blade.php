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
                    <th>Description</th>
                    <th>Grade</th>
                    <th>Price</th>
                    <th>Created</th>
                    <th>Updated</th>
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
            var sd = new DataTable('#supplies', {
                ajax: "{{ route('admin.supplies') }}",
                processing: true,
                serverSide: true
            });
            console.log(sd.ajax);
        }
    }).mount('#app');
</script>
@endsection
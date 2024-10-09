@extends('layouts.app')
@section('content')
@include('partials.navbar')
<main class="content-page" id="app">
    <section class="py-3 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Supplie</h1>
            </div>
        </div>
    </section>
    <div class="container">
    </div>
</main>
</main>
<script type="module">
    createApp({
        data() {
            return {
                id: "{{ $id }}",
                name: '',
                description: '',
                grade: '',
                price: '',
            }
        },
        mounted() {
            this.loadData();
        },
        methods: {
            async loadData() {
                if (this.isValidString()) {
                    let url = "{{ url('api/supplie') }}/" + this.id;
                    let supplie = await getElement(url, "{{ session('token') }}");
                    this.name = supplie.name;
                    this.description = supplie.description;
                    this.grade = supplie.grade;
                    this.price = supplie.price;
                }
            },
            isValidString() {
                return this.id !== null && this.id.trim() !== '';
            }
        }
    }).mount('#app');
</script>
@endsection
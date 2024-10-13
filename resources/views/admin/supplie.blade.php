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
        <div class="row align-items-start">
            <div class="col-2">
            </div>
            <div class="col-8">
                <div class="col-md-12 col-lg-12">
                    <form class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-sm-12">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" class="form-control" required v-model="name" @blur="v$.name.$touch()">
                                <span class="label-error" v-if="submit && v$.name.required.$invalid">Name required</span>
                                <span class="label-error" v-if="v$.name.maxLength.$invalid">User max length is 100</span>
                            </div>
                            <div class="col-md-6">
                                <label for="grade" class="form-label">Grade</label>
                                <select class="form-select" id="grade" required v-model="grade" @blur="v$.grade.$touch()">
                                    <option value="">Choose...</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                                <span class="label-error" v-if="submit && v$.grade.required.$invalid">Grade required</span>
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" id="price" class="form-control" required v-model="price" @blur="v$.price.$touch()">
                                <span class="label-error" v-if="submit && v$.price.required.$invalid">Price required</span>
                            </div>
                            <div class="col-md-6">
                                <label for="images" class="form-label">Images</label>
                                <input class="form-control" type="file" id="images" multiple>
                            </div>
                            <div class="col-md-6">
                                <label for="file" class="form-label">File</label>
                                <input class="form-control" type="file" id="file">
                            </div>
                            <div class="col-md-12">
                                <label for="description" class="form-label">Description</label>
                                <div id="editor"></div>
                                <span class="label-error" v-if="submit && v$.description.required.$invalid">Description required</span>
                            </div>
                        </div>
                        <button style="max-width: 300px; margin-top: 5em;" class="w-100 btn btn-primary btn-lg" @click="onSubmit">Save</button>
                    </form>
                </div>
            </div>
            <div class="col-2">
            </div>
        </div>
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
                submit: false
            }
        },
        validations() {
            return {
                name: {
                    required,
                    maxLength: maxLength(100)
                },
                description: {
                    required
                },
                grade: {
                    required,
                    minValue: minValue(1),
                    maxValue: maxValue(6)
                },
                price: {
                    required,
                    numeric
                }
            }
        },
        setup() {
            const v$ = useVuelidate();
            return {
                v$
            };
        },
        mounted() {
            this.loadData().then(() => {
                const quill = new Quill('#editor', {
                    theme: 'snow'
                });
                quill.setText(this.description);
                quill.on('text-change', () => {
                    this.description = quill.root.innerHTML;
                });
            });
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
            },
            onSubmit(event) {
                this.v$.$touch();
                if (this.v$.$invalid) {
                    event.preventDefault();
                    this.submit = true;
                    return;
                }
                alert('Hola');
            }
        }
    }).mount('#app');
</script>
@endsection
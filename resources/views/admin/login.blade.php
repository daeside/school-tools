@extends('layouts.app')
@section('content')
<main class="form-signin" id="app">
    <form action="admin/dologin" method="post" @submit="onSubmit">
        @csrf
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <div class="form-floating">
            <input type="text" class="form-control" id="user" name="user" placeholder="User" v-model="user" @blur="v$.user.$touch()">
            <label for="user">User</label>
            <span class="label-error" v-if="submit && v$.user.required.$invalid">User required</span>
            <span class="label-error" v-if="v$.user.maxLength.$invalid">User max length is 30</span>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" v-model="password" @blur="v$.password.$touch()">
            <label for="password">Password</label>
            <span class="label-error" v-if="submit && v$.password.required.$invalid">Password required</span>
            <span class="label-error" v-if="v$.password.maxLength.$invalid">Password max length is 50</span>
        </div>
        <div class="checkbox mb-3">
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    </form>
    @if ($errors->any())
    <div class="mt-3">
        <ul style="list-style-type: none;">
            @foreach ($errors->all() as $error)
            <li class="label-error">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</main>
<script type="module">
    createApp({
        data() {
            return {
                user: '',
                password: '',
                submit: false
            }
        },
        validations() {
            return {
                user: {
                    required,
                    maxLength: maxLength(30)
                },
                password: {
                    required,
                    maxLength: maxLength(50)
                }
            }
        },
        setup() {
            const v$ = useVuelidate();
            return {
                v$
            };
        },
        methods: {
            onSubmit(event) {
                this.v$.$touch();
                if (this.v$.$invalid) {
                    event.preventDefault();
                    this.submit = true;
                    return;
                }
            }
        }
    }).mount('#app');
</script>
@endsection
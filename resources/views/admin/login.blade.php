@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row center">
        <div class="col s3">
        </div>
        <div class="col s12 m6">
            <div class="card grey lighten-5">
                <form id="login" action="/admin/login" method="post">
                    <div class="card-content">
                        <i class="large material-icons">account_circle</i>
                        <div class="row">
                            <div class="input-field">
                                <i class="material-icons prefix">person</i>
                                <input class="validate" type="text" name="user" id="user" required="" />
                                <label for="user">Usuario</label>
                            </div>
                            <div class="input-field">
                                <i class="material-icons prefix">lock</i>
                                <input class="validate" type="password" name="password" id="password" required="" />
                                <label for="password">Contraseña</label>
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="waves-effect waves-light btn blue-grey darken-3" id="login-start">ingresar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col s3">
        </div>
    </div>
</div>
@endsection
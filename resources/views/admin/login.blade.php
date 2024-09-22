@extends('layouts.app')
@section('content')
<div class="container" style="margin-top: 1em;">
    <div class="center-align">
        <div class="row">
            <div class="col s3"></div>
            <div class="col s6">
                <div class="card grey lighten-5">
                    <form id="login" action="/admin/dologin" method="post">
                        {{ csrf_field() }}
                        <div class="card-content">
                            <i class="large material-icons">account_circle</i>
                            <div class="row">
                                <div class="input-field s12">
                                    <i class="material-icons prefix">person</i>
                                    <input class="validate" type="text" name="user" id="user" required="" />
                                    <label for="user">Usuario</label>
                                </div>
                                <div class="input-field s12">
                                    <i class="material-icons prefix">lock</i>
                                    <input class="validate" type="password" name="password" id="password" required="" />
                                    <label for="password">Contraseña</label>
                                </div>
                            </div>
                        </div>
                        <div style="margin-bottom: 1em;">
                            <button class="waves-effect waves-light btn blue-grey darken-3" id="login-start">ingresar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
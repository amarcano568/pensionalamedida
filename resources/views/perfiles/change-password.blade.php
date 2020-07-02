@extends('welcome')
@section('contenido')
<br> <br>
    <style>
        footer {
            background-color: black;
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 40px;
            color: white;
        }
    </style>
<form id="FormPassword" method="post" enctype="multipart/form-data" action="actualiza-password" data-parsley-validate="">
    @csrf
    <br><br><br>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <div class="card shadow">
                <div class="card-header">
                    <h4><i class="fas fa-key"></i> Cambiar contraseña</h4>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <input class="form-control" id="contrasenaActual" name="contrasenaActual" type="password"
                                placeholder="Contraseña actual" required
                                data-parsley-required-message="<i class='fas fa-exclamation-triangle'></i> Contraseña actual requerida."
                                data-parsley-length="[8, 50]" data-parsley-trigger="keyup" 
                                data-parsley-length-message="<i class='fas fa-exclamation-triangle'></i> Mínimo cuatro (8) caracteres y máximo cien (50).">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="newContrasena" id="newContrasena" type="password"
                                placeholder="Nueva contraseña" required
                                data-parsley-required-message="<i class='fas fa-exclamation-triangle'></i> Contraseña nueva requerida."
                                data-parsley-length="[8, 50]"  data-parsley-trigger="keyup" 
                                data-parsley-length-message="<i class='fas fa-exclamation-triangle'></i> Mínimo cuatro (8) caracteres y máximo cien (50).">
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="repetirContrasena" name="repetirContrasena" type="password"
                                placeholder="Repetir nueva contraseña" required
                                data-parsley-required-message="<i class='fas fa-exclamation-triangle'></i> Repetir nueva contraseña requerida."
                                data-parsley-length="[8, 50]"  required data-parsley-equalto="#newContrasena" data-parsley-trigger="keyup"  
                                data-parsley-equalto-message="<i class='fas fa-exclamation-triangle'></i> Esta contraseña no coincide con la nueva."
                                data-parsley-length-message="<i class='fas fa-exclamation-triangle'></i> Mínimo cuatro (8) caracteres y máximo cien (50).">
                        </div>
  
            <div class="form-group form-actions">
                <button class="btn btn-success" type="submit"><i class="cil-save"></i> Cambiar contraseña</button>
                <a href="/" class="btn btn-info" type="button">Cerrar</a>
            </div>
</form>
</div>
</div>
</div>
</div>
</form>
<br><br><br>
@endsection
@section('javascript')
<script src="{{ asset('jsApp/password.js') }}"></script>
@stop
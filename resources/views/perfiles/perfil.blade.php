@extends('welcome')
@section('contenido')
<br> <br>
<form id="FormPerfil" method="post" enctype="multipart/form-data" action="actualizar-perfil" data-parsley-validate="">
    @csrf
    <div class="row">

        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="card shadow ">
                <div class="card-header">
                    <h4>
                        <svg class="c-icon mr-2 c-icon-2xl">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                        </svg> PERFIL DEL
                        <strong>
                            USUARIO.
                        </strong>
                    </h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="historial-tab" data-toggle="tab" href="#historial" role="tab"
                                aria-controls="historial" aria-selected="true">
                                <i class="fas fa-info"></i>
                                Datos personales
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="graficos-tab" data-toggle="tab" href="#graficos" role="tab"
                                aria-controls="graficos" aria-selected="false">
                                <i class="far fa-thumbs-up"></i>
                                Redes sociales
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <br>
                        <input class="form-control" id="idUser" name="idUser" type="text" style="display: none;">
                        <div class="tab-pane fade show active" id="historial" role="tabpanel"
                            aria-labelledby="historial-tab">
                            <div class="form-group">
                                <label for="email">
                                    <i class="far fa-envelope"></i> Email / Username
                                </label>
                                <input class="form-control" id="email" name="email" type="text"
                                    placeholder="Email / Username" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre y Apellido</label>
                                <input class="form-control" id="nombre" name="nombre" type="text"
                                    placeholder="Nombre y Apellido" required
                                    data-parsley-required-message="<i class='fas fa-exclamation-triangle'></i> El nombre del usuario es obligatorio."  data-parsley-length="[4, 100]" data-parsley-length-message="<i class='fas fa-exclamation-triangle'></i> Mínimo cuatro (4) caracteres y máximo cien (100).">
                            </div>
                            <div class="form-group">
                                <label for="country">
                                    Rol
                                </label>
                                <select readonly id="rol" name="rol" class="chosen-select">
                                    <option></option>
                                    <option value="Administrator">Administrator</option>
                                    <option value="User">User</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="telefonoFijo">
                                        <i class="fas fa-phone"></i> Teléfono fijo
                                    </label>
                                    <input class="form-control" id="telefonoFijo" name="telefonoFijo" type="text"
                                        placeholder="Teléfono fijo." value="">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="telefonoMovil">
                                        <i class="fas fa-mobile-alt"></i> Teléfono Movil
                                    </label>
                                    <input class="form-control" id="telefonoMovil" name="telefonoMovil" type="text"
                                        placeholder="Teléfono movil" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-8">
                                    <label for="direccion">
                                        <i class="fas fa-map-signs"></i> Dirección
                                    </label>
                                    <input class="form-control" id="direccion" name="direccion" type="text"
                                        placeholder="Dirección" value="">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="cp">
                                        Código postal
                                    </label>
                                    <input class="form-control" id="cp" name="cp" type="text"
                                        placeholder="Código postal" value="">
                                </div>
                            </div>
                            <!-- /.row-->                          
                        </div>
                        <div class="tab-pane fade" id="graficos" role="tabpanel" aria-labelledby="graficos-tab">
                            <br>
                            <div class="form-group">
                                <label for="linkedin">
                                    <i class="fab fa-linkedin"></i> Linkedin
                                </label>
                                <input class="form-control" id="linkedin" name="linkedin" type="text"
                                    placeholder="linkedin"  data-parsley-type="url">
                            </div>
                            <div class="form-group">
                                <label for="twitter">
                                    <i class="fab fa-twitter"></i> Twitter
                                </label>
                                <input class="form-control" id="twitter" name="twitter" type="text"
                                    placeholder="twitter"  data-parsley-type="url">
                            </div>
                            <div class="form-group">
                                <label for="facebook">
                                    <i class="fab fa-facebook-f"></i> Facebook
                                </label>
                                <input class="form-control" id="facebook" name="facebook" type="text"
                                    placeholder="facebook"  data-parsley-type="url">
                            </div>
                            <div class="form-group">
                                <label for="instagram">
                                    <i class="fab fa-instagram"></i> Instagram
                                </label>
                                <input class="form-control" id="instagram" name="instagram" type="text"
                                    placeholder="instagram"  data-parsley-type="url">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success" type="submit"> Guardar</button>
                    <a href="/" class="btn btn-info" type="button">Cerrar</a>
                </div>

            </div>
        </div>
    </div>
</form>
@endsection
@section('javascript')
<script src="{{ asset('jsApp/perfil.js') }}"></script>
@stop
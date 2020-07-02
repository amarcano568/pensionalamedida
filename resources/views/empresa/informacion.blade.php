@extends('welcome')
@section('contenido')
<br> <br>
<form id="FormEmpresa" method="post" enctype="multipart/form-data" action="actualizar-empresa" data-parsley-validate="">
    @csrf
    <div class="row">

        <div class="col-sm-3" style="padding-left: 3em;">
            <div class="card shadow ">
                <div class="card-header">
                    <h4>
                        <svg class="c-icon mr-2 c-icon-2xl">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-image-plus"></use>
                        </svg>
                        <strong>
                            LOGO.
                        </strong>
                    </h4>
                </div>
                <div class="card-body" id="divLogo">
                    <img src="" alt="Logo empresa" height="150" width="150" id="logo" class="img-thumbnail img-fluid">
                </div>
                <div class="card-footer">
                    <button data-toggle="modal" data-target="#ModalAgregarLogo"  class="btn btn-success btn-sm pull-right" type="button"><i class="cil-cloud-upload"></i> Nuevo logo</button>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card shadow ">
                <div class="card-header">
                    <h4>
                        <svg class="c-icon mr-2 c-icon-2xl">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-building"></use>
                        </svg> INFORMACION DE LA
                        <strong>
                            EMPRESA.
                        </strong>
                    </h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="historial-tab" data-toggle="tab" href="#historial" role="tab"
                                aria-controls="historial" aria-selected="true">
                                <i class="fas fa-info"></i>
                                Datos principales
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

                        <input class="form-control" id="idEmpresa" name="idEmpresa" type="text" style="display: none;">
                        <div class="tab-pane fade show active" id="historial" role="tabpanel"
                            aria-labelledby="historial-tab">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for="nombreFiscal">
                                        Nombre fiscal
                                    </label>
                                    <input class="form-control" id="nombreFiscal" name="nombreFiscal" type="text"
                                        placeholder="Nombre fiscal"
                                        data-parsley-required-message="<i class='fas fa-exclamation-triangle'></i> El nombre Fiscal es requerido."
                                        data-parsley-length="[4, 100]"
                                        data-parsley-length-message="<i class='fas fa-exclamation-triangle'></i> Mínimo cuatro (4) caracteres y máximo cien (100).">
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="nombreComercial">Nombre comercial</label>
                                    <input class="form-control" id="nombreComercial" name="nombreComercial" type="text"
                                        placeholder="Nombre comercial" required
                                        data-parsley-required-message="<i class='fas fa-exclamation-triangle'></i> El nombre comercial es requerido."
                                        data-parsley-length="[4, 100]"
                                        data-parsley-length-message="<i class='fas fa-exclamation-triangle'></i> Mínimo cuatro (4) caracteres y máximo cien (100).">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="rfc">
                                        RFC
                                    </label>
                                    <input class="form-control" id="rfc" name="rfc" type="text" placeholder="RFC"
                                        required
                                        data-parsley-required-message="<i class='fas fa-exclamation-triangle'></i> El nombre comercial es requerido.">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="estado">
                                        Estado
                                    </label>
                                    <select id="estado" name="estado" class="chosen-select"
                                        data-placeholder="Seleccione un Estado...">
                                        <option></option>
                                        @foreach( $estados as $estado )
                                            <option value="{{ $estado->id }}">
                                                {{ $estado->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for="direccion">
                                        <i class="cil-map"></i> Dirección
                                    </label>
                                    <input class="form-control" id="direccion" name="direccion" type="text"
                                        placeholder="Dirección"
                                        data-parsley-required-message="<i class='fas fa-exclamation-triangle'></i> La dirección es requerida."
                                        data-parsley-length="[4, 200]"
                                        data-parsley-length-message="<i class='fas fa-exclamation-triangle'></i> Mínimo cuatro (4) caracteres y máximo cien (200).">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="provincia">
                                        Provincia
                                    </label>
                                    <input class="form-control" id="provincia" name="provincia" type="text"
                                        placeholder="Provincia" required
                                        data-parsley-required-message="<i class='fas fa-exclamation-triangle'></i> La provincia es requerida."
                                        data-parsley-length="[4, 80]"
                                        data-parsley-length-message="<i class='fas fa-exclamation-triangle'></i> Mínimo cuatro (4) caracteres y máximo cien (80).">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="cp">
                                        Código Postal
                                    </label>
                                    <input class="form-control" id="cp" name="cp" type="text"
                                        placeholder="Código Postal" required
                                        data-parsley-required-message="<i class='fas fa-exclamation-triangle'></i>El código postal es requerido."
                                        data-parsley-length="[1, 20]"
                                        data-parsley-length-message="<i class='fas fa-exclamation-triangle'></i> Mínimo cuatro (1) caracteres y máximo cien (20).">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="telefonoFijo">
                                        <i class="fas fa-phone"></i> Teléfono fijo
                                    </label>
                                    <input class="form-control" id="telefonoFijo" name="telefonoFijo" type="text"
                                        placeholder="Teléfono fijo." value="">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="telefonoMovil">
                                        <i class="fas fa-mobile-alt"></i> Teléfono Movil
                                    </label>
                                    <input class="form-control" id="telefonoMovil" name="telefonoMovil" type="text"
                                        placeholder="Teléfono movil" value="">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="fax">
                                        <i class="cil-fax"></i> Fax
                                    </label>
                                    <input class="form-control" id="fax" name="fax" type="text" placeholder="Fax"
                                        value="">
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for="email">
                                        <i class="far fa-envelope"></i> Correo
                                    </label>
                                    <input class="form-control" id="email" name="email" type="email"
                                        placeholder="Correo" required
                                        data-parsley-required-message="<i class='fas fa-exclamation-triangle'></i> El correo es requerido.">
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="web"><i class="fab fa-internet-explorer"></i> Web</label>
                                    <input class="form-control" id="web" name="web" type="url" placeholder="Web">
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="graficos" role="tabpanel" aria-labelledby="graficos-tab">
                            <div class="form-group">
                                <label for="linkedin">
                                    <i class="fab fa-linkedin"></i> Linkedin
                                </label>
                                <input class="form-control" id="linkedin" name="linkedin" type="text"
                                    placeholder="linkedin" data-parsley-type="url">
                            </div>
                            <div class="form-group">
                                <label for="twitter">
                                    <i class="fab fa-twitter"></i> Twitter
                                </label>
                                <input class="form-control" id="twitter" name="twitter" type="text"
                                    placeholder="twitter" data-parsley-type="url">
                            </div>
                            <div class="form-group">
                                <label for="facebook">
                                    <i class="fab fa-facebook-f"></i> Facebook
                                </label>
                                <input class="form-control" id="facebook" name="facebook" type="text"
                                    placeholder="facebook" data-parsley-type="url">
                            </div>
                            <div class="form-group">
                                <label for="instagram">
                                    <i class="fab fa-instagram"></i> Instagram
                                </label>
                                <input class="form-control" id="instagram" name="instagram" type="text"
                                    placeholder="instagram" data-parsley-type="url">
                            </div>
                            <div class="form-group">
                                <label for="youtube">
                                    <i class="fab fa-youtube"></i> Youtube
                                </label>
                                <input class="form-control" id="youtube" name="youtube" type="text"
                                    placeholder="Youtube" data-parsley-type="url">
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
@include('empresa.modal-foto')
@endsection
@section('javascript')
<script src="{{ asset('jsApp/empresa.js') }}"></script>
@stop
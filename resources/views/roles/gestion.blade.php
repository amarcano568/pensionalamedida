@extends('welcome')
@section('css')
<link rel="stylesheet" href="{{ asset('css/stylo-ul.css') }}" />
@endsection
@section('contenido')

<br><br>
<div class="row">

    <div class="col-sm-10" style="padding-left: 10em;">
        <div class="card shadow ">
            <div class="card-header">
                <h4>
                    <svg class="c-icon mr-2 c-icon-2xl">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-shield-alt"></use>
                    </svg>
                    <strong>
                        GESTION DE ROLES.
                    </strong>
                    <button id="btnNuevoRol" style="float: right!important" class="btn btn-success btn-sm " type="button"><i class="cil-shield-alt"></i> Nuevo Role</button>
                </h4>
            </div>
            <div class="card-body" id="divLogo">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="country">
                                <i class="cil-shield-alt"></i> Seleccione un Rol
                            </label>
                            <select required id="role" name="role" class="chosen-select"
                                data-placeholder="Seleccione un Role..." >
                                <option></option>
                                @foreach( $roles as $role )
                                    <option value="{{ $role->id }}">
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="country">
                            <i class="cil-calendar"></i> Creado el
                        </label>
                        <input class="form-control" id="created_at" name="created_at" type="text" placeholder="Creado el" readonly>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6 class="text-center">
                                    .:: OPCIONES DISPONIBLES ::.
                                </h6>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -2em;">
                            <div class="col-sm-12">
                                <div class="column">
                                    <ul class="ulOpciones connected-sortable droppable-area1" id="permisosDisponibles">
                                      
                                    </ul>
                                  </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-sm-2" style="padding-top: 10em;">
                        <button id="PasarTodas" class="btn btn-sm btn-info" style="width: 8em;display:none;"><i class="cil-chevron-double-right"></i>
                        </button>
                        <br><br>
                        <button id="RevocarTodas" class="btn btn-sm btn-info" style="width: 8em;display:none;"><i class="cil-chevron-double-left"></i>
                        </i>
                        </button>
                    </div>
                    <div class="col-sm-5">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6 class="text-center">
                                    .:: OPCIONES ASIGNADAS AL ROL ::.
                                </h6>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -2em;">
                            <div class="col-sm-12">
                                <div class="column">
                                    <ul id="permisosAsignados" class="ulOpciones connected-sortable droppable-area2">
                                    
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                
            </div>
        </div>
    </div>
</div>


@include('roles.modal-role')


@endsection
@section('javascript')
<script src="{{ asset('jsApp/gestion-roles.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
@endsection
@extends('welcome')
@section('contenido')
<br><br>
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-9">
                                <i class="cil-people"></i> Gestión de estudiantes
                            </div>
                            <div class="col-sm-3">
                                <select name="filtro" id="filtro" class="form-control">
                                    <option value="1">Activos</option>
                                    <option value="0">Inactivos</option>
                                    <option value="">Todos los estudiantes</option>
                                </select>
                            </div>
                        </div>                                                
                    </div>
                    <div class="card-body">
                        <!-- /.row--><br>
                        <div class="table-responsive">
                        <table id="table-estudiantes" class="table table-responsive-sm table-hover table-outline mb-0" style="width: 100%">
                            <thead class="thead-light">
                                <tr>
                                    <th></th>
                                    <th class="text-center">
                                        <svg class="c-icon">
                                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                                        </svg>
                                    </th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Apellidos</th>
                                    <th class="text-center">Teléfonos</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Codigo Expediente</th>                                   
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Acciones</th>
                                    <th class="text-center">Detalle</th>
                                </tr>
                            </thead>
                            <tbody id="body-estudiantes">
                                
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
    </div>
</div>
@include('alumnos.modal-imputar')
@include('alumnos.modal-grupo-familiar')
@include('alumnos.modal-habitacion')
@endsection
@section('javascript')
<script src="{{ asset('jsApp/gestion-alumnos.js') }}"></script>
@stop
@extends('welcome')
@section('contenido')
<br><br>
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><i class="cil-people"></i> Gesión de Usuarios <button id="BtnNuevo" class="btn btn-primary float-right"><i class="cil-user-plus"></i>
                         Nuevo usuario</button></div>
                    <div class="card-body">
                        <!-- /.row--><br>
                        <table id="tableUsuarios" class="table table-responsive-sm table-hover table-outline mb-0" style="width: 100%">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">
                                        <svg class="c-icon">
                                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                                        </svg>
                                    </th>
                                    <th class="text-center">Nombre del usuario</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">País</th>
                                    <th class="text-center">Rol</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody id="bodyUsuarios">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
    </div>
</div>
@include('usuarios.modal-usuario')
@endsection
@section('javascript')
<script src="{{ asset('jsApp/gestion-usuarios.js') }}"></script>
@stop
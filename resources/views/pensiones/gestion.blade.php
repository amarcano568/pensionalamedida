@extends('welcome')
@section('contenido')

<br><br>
<div class="container-fluid" id="divPantallaPrincipal">
    <div class="fade-in">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <i class="cil-beach-access"></i> Planes de Pensiones Gestionados
                            </div>
                            <div class="col-sm-6">
                                <ul class="nav navbar-right" style="float: right">
                                    <li class="dropdown dropbottom">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                            aria-haspopup="true" aria-expanded="false">
                                            Nuevos planes de pensión
                                        </a>
                                        <ul class="dropdown-menu" role="menu" x-placement="left-start"
                                            style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-2px, 0px, 0px);">
                                            <li>
                                                <a id="BtnNuevo" class="dropdown-item" href="">
                                                    <i class="far fa-file-alt"></i>
                                                    Nuevo plan de pensión completo
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <i class="far fa-file-alt"></i>
                                                    Nuevo plan de pensión ya Cotizando M40
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <i class="far fa-file-alt"></i> 
                                                    Nuevo plan de pensión simple
                                                </a>
                                            </li>
        
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- /.row--><br>
                        <table id="table-pensiones" class="table table-responsive-sm table-hover table-outline mb-0"
                            style="width: 100%">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Apellidos</th>
                                    <th class="text-center">Nro. Documento</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Plan</th>
                                    <th class="text-center">Creado por</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody id="body-pensiones">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
    </div>
</div>

@endsection
@section('javascript')
<script src="{{ asset('jsApp/gestion-pensiones.js') }}"></script>
@stop
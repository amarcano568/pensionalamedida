@extends('welcome')
@section('contenido')

<br><br>
<div class="container-fluid" id="divPantallaPrincipal">
    <div class="fade-in">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><i class="cil-beach-access"></i> Planes de Pensiones Gestionados 
                        <button id="BtnNuevo" class="btn btn-primary float-right">
                            <i class="cil-note-add"></i>
                        Nuevo plan pensión</button></div>
                    <div class="card-body">
                        <!-- /.row--><br>
                        <table id="table-pensiones" class="table table-responsive-sm table-hover table-outline mb-0" style="width: 100%">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Apellidos</th>
                                    <th class="text-center">Nro. Documento</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Creado el</th>
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
@include('pensiones.pensionalamedida')
@endsection
@section('javascript')
<script src="{{ asset('jsApp/gestion-pensiones.js') }}"></script>
@stop
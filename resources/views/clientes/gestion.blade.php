@extends('welcome')
@section('contenido')

<br><br>
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><i class="cil-contact"></i> Gestión de clientes <button id="BtnNuevo" class="btn btn-primary float-right"><i class="cil-user-plus"></i>
                         Nuevo cliente</button></div>
                    <div class="card-body">
                        <!-- /.row--><br>
                        <table id="tableClientes" class="table table-responsive-sm table-hover table-outline mb-0" style="width: 100%">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Apellidos</th>
                                    <th class="text-center">Nro. Documento</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">F. Nac.</th>
                                    <th class="text-center">Edad</th>
                                    <th class="text-center">Genero</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody id="bodyClientes">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
    </div>
</div>
@include('clientes.modal-cliente')
@endsection
@section('javascript')
<script src="{{ asset('jsApp/gestion-clientes.js') }}"></script>
@stop
@extends('welcome')
@section('contenido')
<br><br>
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><i class="cil-calendar"></i> Tipos de semanas descontadas <button id="BtnNuevo" class="btn btn-primary float-right"><i class="cil-calendar-check"></i>
                         Nuevo Tipo de Semanas descontadas</button></div>
                    <div class="card-body">
                        <!-- /.row--><br>
                        <table id="table-semanas-descontadas" class="table table-responsive-sm table-hover table-outline mb-0" style="width: 100%">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">
                                        <i class="cil-calendar"></i>
                                    </th>
                                    <th class="text-center">Tipo</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Creado el</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody id="body-semanas-descontadas">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
    </div>
</div>
@include('semanas_descontadas.modal-semanas')
@endsection
@section('javascript')
<script src="{{ asset('jsApp/gestion-semanas-descontadas.js') }}"></script>
@stop
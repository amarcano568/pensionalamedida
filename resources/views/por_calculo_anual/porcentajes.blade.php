@extends('welcome')
@section('contenido')
<br><br>
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><i class="cil-calculator"></i> Porcentaje (%) calculo anual <strong>M40</strong>  
                        <button id="BtnGuardar" class="btn btn-success float-right">
                            <i class="cil-save"></i>
                            Guardar porcentajes
                        </button>
                    </div>
                    <div class="card-body">
                        <!-- /.row--><br>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <table id="table-porcentaje-calculo" class="table table-responsive-sm table-hover table-outline mb-0" style="width: 100%">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">Id</th>
                                            <th class="text-center"><i class="cil-calendar"></i> Año</th>
                                            <th class="text-center">Operador</th>
                                            <th class="text-center">Porcentaje</th>
                                        </tr>
                                    </thead>
                                    <tbody id="body-porcentaje-calculo">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
<script src="{{ asset('jsApp/porcentaje_calculo.js') }}"></script>
@stop
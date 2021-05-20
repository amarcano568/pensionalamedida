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
                                <i class="cil-people"></i> Gestión de grupos familiares
                            </div>   
                            <div class="col-sm-3">
                                <button id="btn-crear-nuevo-grupo-familiar" class="btn btn-success"><i class="fas fa-users"></i>&nbsp;&nbsp;Crear un nuevo grupo familiar</button>
                            </div>                         
                        </div>                                                
                    </div>
                    <div class="card-body" id="listado-grupos-familiares">
                        <!-- /.row--><br>
                        
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
    </div>
</div>
@include('grupos-familiares.modal-grupo-familiar')
@endsection
@section('javascript')
<script src="{{ asset('jsApp/gestion-grupos-familiares.js') }}"></script>
@stop
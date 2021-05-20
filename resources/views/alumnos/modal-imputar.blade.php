<form id="form-imputar-trabajo" method="post" enctype="multipart/form-data" action="guardar-trabajo-imputado"  data-parsley-validate="">
    @csrf 
    <div id="modal-imputar" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="title-modal">Imputar trabajo realizado</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                        <input type="text" id="id_alumno_trabajo" name="id_alumno_trabajo" style="display: none;">
                        <div class="row">
                            <div class="col-sm-5">
                                <label for="trabajo_id">Trabajo realizado</label>
                                <select data-placeholder="Seleccione trabajo a imputar" name="trabajo_id"
                                    id="trabajo_id" class="form-control chosen-select" required>
                                    <option value=""></option>
                                    @foreach($trabajos as $trabajo)
                                        <option value="{{ $trabajo->id }}">{{ $trabajo->trabajo }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="fecha_trabajo">Fecha</label>
                                <input type="date" class="form-control" id="fecha_trabajo" name="fecha_trabajo">
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-success">Guardar trabajo</button>
                                <button class="btn btn-info">Maestro de trabajo</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <label for="trabajo_id">Observaciones</label>
                                <textarea name="observaciones_trabajo" id="observaciones_trabajo" rows="2"
                                    class="form-control"></textarea>
                            </div>
                        </div>                   
                    <hr>
                    <table id="table-trabajos-realizados"
                        class="table table-responsive-sm table-hover table-outline mb-0" style="width: 100%">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">Trabajo</th>
                                <th class="text-center">Fechas</th>
                                <th class="text-center">Observaciones</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="body-trabajos-realizados">

                        </tbody>
                    </table>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-info" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</form>
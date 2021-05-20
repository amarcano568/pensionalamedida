    <div id="modal-grupo-familiar" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="title-modal"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="select-padre">Padre</label>
                            <select data-placeholder="Seleccione el padre del grupo..." name="select-padre" id="select-padre" class="form-control chosen-select">
                                <option value=""></option>
                                @foreach ($padres as $padre)
                                    <option value="{{ $padre->numIdAlumno }}">{{ $padre->strNombre }} {{ $padre->strApellidos }}</option>   
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="select-madre">Madre</label>
                            <select data-placeholder="Seleccione la madre del grupo..." name="select-madre" id="select-madre" class="form-control chosen-select">
                                <option value=""></option>
                                @foreach ($madres as $madre)
                                    <option value="{{ $madre->numIdAlumno }}">{{ $madre->strNombre }} {{ $madre->strApellidos }}</option>   
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div id="datos-hijo">
                        <h5>Datos del Hijo</h5>
                        <form id="form-hijos" method="post" enctype="multipart/form-data" action="actualizar-hijo" data-parsley-validate="">
                            @csrf
                            <input type="text" id="uuid_grupo_familiar" name="uuid_grupo_familiar" style="display: none;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="nombre_hijo">Nombres</label>
                                    <input type="text" id="nombre_hijo" name="nombre_hijo" class="form-control" required>
                                </div>
                                <div class="col-sm-6">
                                    <label for="apellidos_hijo">Apellidos</label>
                                    <input type="text" id="apellidos_hijo" name="apellidos_hijo" class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="dni_hijo">Dni</label>
                                    <input type="text" id="dni_hijo" name="dni_hijo" class="form-control" required>
                                </div>
                                <div class="col-sm-4">
                                    <label for="fec_nac_hijo">F. Nacimiento</label>
                                    <input type="date" id="fec_nac_hijo" name="fec_nac_hijo" class="form-control" required>
                                </div>
                                <div class="col-sm-4">
                                    <label for="sexo_hijo">Sexo</label>
                                    <select name="sexo_hijo" id="sexo_hijo" class="form-control chosen-select" required>
                                        <option value="H">Hombre</option>
                                        <option value="M">Mujer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 float-right;">
                                    <button type="submit" class="btn btn-success" style="float: right;">Agregar hijo</button>
                                </div>
                            </div>
                        </form>
                        <br>
                    </div>
                    <div class="row" id="div-table-hijos">
                        <div class="col-sm-12 table-responsive">
                            <table id="table-hijo" class="table table-responsive-sm table-hover table-outline mb-0" style="width: 100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 5%" class="text-center">Id</th>
                                        <th style="width: 15%" class="text-center">Nombres</th>
                                        <th style="width: 15%" class="text-center">Apellidos</th>
                                        <th style="width: 15%" class="text-center">Dni</th>
                                        <th style="width: 15%" class="text-center">F. Nac.</th>
                                        <th style="width: 15%" class="text-center">Sexo</th>                                   
                                        <th style="width: 5%" class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="body-hijo">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-guardar-grupo-familiar" class="btn btn-primary btn-success">Guardar</button>
                    <button type="button" id="btn-guardar-nuevo-grupo-familiar" class="btn btn-primary btn-success">Guardar nuevo grupo familiar</button>
                    <button type="button" class="btn btn-secondary btn-info" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

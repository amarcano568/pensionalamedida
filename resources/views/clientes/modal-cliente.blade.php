<form id="FormCliente" method="post" enctype="multipart/form-data" action="actualizar-cliente" data-parsley-validate="">
    @csrf
    <div id="modal-cliente" class="modal" tabindex="-1" role="dialog">
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
                        <div class="col-sm-1"></div>
                        <div class="col-sm-10">
                            <div class="card shadow ">
                                <div class="card-body">
                                    <input class="form-control" id="idCliente" name="idCliente" type="text"
                                        style="display: none;">
                                    <div class="tab-pane fade show active" id="historial" role="tabpanel"
                                        aria-labelledby="historial-tab">
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="nombre">
                                                    Nombres
                                                </label>
                                                <input class="form-control" id="nombre" name="nombre" type="text"
                                                    placeholder="Nombre del cliente" required  data-parsley-required-message="<i class='cil-bolt'></i> El Nombre del cliente es requerido.">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="apellidos">
                                                    Apellidos
                                                </label>
                                                <input class="form-control" id="apellidos" name="apellidos" type="text"
                                                    placeholder="Apellidos del cliente" required  data-parsley-required-message="<i class='cil-bolt'></i> El Apellido(s) del cliente es requerido.">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-5">
                                                <label for="nroDocumento">
                                                    Nro. Documento
                                                </label>
                                                <input class="form-control" id="nroDocumento" name="nroDocumento"
                                                    type="text" placeholder="Nro. de documento" required  data-parsley-required-message="<i class='cil-bolt'></i> El Número de documento es requerido.">
                                            </div>
                                            <div class="form-group col-sm-5">
                                                <label for="fecNacimiento">
                                                    <i class="cil-calendar"></i> Fecha de nacimiento
                                                </label>
                                                <input class="form-control" id="fecNacimiento" name="fecNacimiento" type="date" required  data-parsley-required-message="<i class='cil-bolt'></i> La fecha de nacimiento es requerido.">
                                            </div>
                                            <div class="form-group col-sm-2">
                                                <label for="nroDocumento">
                                                    <i class="cil-birthday-cake"></i> Edad
                                                </label>
                                                <input class="form-control" id="edad" name="edad" type="text"
                                                    placeholder="edad" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="genero">
                                                    Genero
                                                </label>
                                                <select required id="genero" name="genero" class="chosen-select"
                                                    data-placeholder="Seleccione un Género..."
                                                    data-parsley-required-message="<i class='cil-bolt'></i> Género requerido">
                                                    <option></option>
                                                    <option value="M">Masculino</option>
                                                    <option value="F">Femenino</option>
                                                    </select>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="estadocivil">
                                                    Estado civil
                                                </label>
                                                <select required id="estadocivil" name="estadocivil"
                                                    class="chosen-select"
                                                    data-placeholder="Seleccione un Estado civil..."
                                                    data-parsley-required-message="<i class='cil-bolt'></i> Estado civil es requerido">>
                                                    <option></option>
                                                    <option value="Cas">Casado</option>
                                                    <option value="Sol">Soltero</option>
                                                    <option value="Con">Concubino</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label for="email">
                                                    <i class="cil-mail"></i> Email
                                                </label>
                                                <input class="form-control" id="email" name="email" type="email"
                                                    placeholder="Email" required  data-parsley-required-message="<i class='cil-bolt'></i> El Email es requerido.">
                                            </div>
                                        </div>
                                        <!-- /.row-->
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="estado">
                                                    Estado
                                                </label>
                                                <select id="estado" name="estado" class="chosen-select"
                                                data-placeholder="Seleccione un Estado..." data-parsley-required-message="<i class='cil-bolt'></i> El estado es requerido">
                                                <option></option>
                                                @foreach( $estados as $estado )
                                                    <option value="{{ $estado->id }}">
                                                        {{ $estado->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="codigopostal">
                                                    Código postal
                                                </label>
                                                <input class="form-control" id="codigopostal" name="codigopostal" type="text"
                                                    placeholder="Código postal" >
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label for="direccion">
                                                    <i class="cil-map"></i> Dirección
                                                </label>
                                                <input class="form-control" id="direccion" name="direccion" type="text"
                                                    placeholder="Dirección" >
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="telefonofijo">
                                                    <i class="cil-phone"></i> Teléfono fijo
                                                </label>
                                                <input class="form-control" id="telefonofijo" name="telefonofijo" type="text"
                                                    placeholder="Teléfono fijo" >
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="telefonoMovil">
                                                    <i class="cil-mobile"></i> Teléfono movil
                                                </label>
                                                <input class="form-control" id="telefonoMovil" name="telefonoMovil" type="text"
                                                    placeholder="Teléfono movil" >
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-success"><i class="cil-save"></i> Guardar</button>
                <button type="button" class="btn btn-secondary btn-info" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
    </div>
</form>
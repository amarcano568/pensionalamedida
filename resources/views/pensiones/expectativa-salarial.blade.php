<form id="formPaso1"  method="post" enctype="multipart/form-data" data-parsley-validate=""  action="/guardar-plan-pension" >
    @csrf
    <div class="card">
        <div class="card-header"><i class="far fa-money-bill-alt"></i> <strong>Expectativa</strong>
            <small>Salarial</small>
            <button id="btn-formulas" class="float-right btn btn-success btn-sm"><i class="cil-functions"></i> Formulas</button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card shadow" style="height: 10.5em;">
                        <div class="card-body">
                            <h6 class="card-title"><i class="cil-birthday-cake"></i> Determinación de la Edad</h6>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">Fecha Nac.</label>
                                        <input readonly class="form-control" id="fechaNacimiento" name="fechaNacimiento"
                                            type="date" required data-parsley-required-message="<i class='fas fa-exclamation-triangle'></i> La fecha de Nacimiento es requerida." >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">Fecha Plan.</label>
                                        <input class="form-control" id="fechaPlan" name="fechaPlan" type="date"
                                            required data-parsley-required-message="<i class='fas fa-exclamation-triangle'></i> La fecha del Plan es requerida.">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12" id="divEdadCliente">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card shadow" style="height: 10.5em;">
                        <div class="card-body">
                            <h6 class="card-title"><i class="cil-beach-access"></i> Edad para pensionarte</h6>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">De</label>
                                        <input style="text-align:right;" class="form-control" id="edadDe" name="edadDe"
                                            type="text" data-parsley-trigger="keyup" required data-parsley-type="number"
                                            required  data-parsley-required-message="<i class='fas fa-exclamation-triangle'></i>Edad requerida." data-parsley-length="[2, 2]"  data-parsley-length-message="<i class='fas fa-exclamation-triangle'></i> Debe ser un número de dos (2) digitos." data-parsley-trigger="keyup"  min="60" max="99" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">A.</label>
                                        <input style="text-align:right;" class="form-control" id="edadA" name="edadA"
                                            type="text" data-parsley-trigger="keyup" required data-parsley-type="number"
                                            required  data-parsley-required-message="<i class='fas fa-exclamation-triangle'></i> Edad requerida." data-parsley-length="[2, 2]" data-parsley-length-message="<i class='fas fa-exclamation-triangle'></i> Debe ser un número de dos (2) digitos." data-parsley-trigger="keyup"  min="60" max="99"  data-parsley-gte="#edadDe" data-parsley-gte-message="<i class='fas fa-exclamation-triangle'></i> La edad debe ser igual o mayor a la edad anterior.">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12" id="divEdadParaPensionarte">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card shadow" style="height: 10.5em;">
                        <div class="card-body" style="margin-top: -1em">
                            <h6 class="card-title"><i class="cil-calendar-check"></i> Semanas reportes</h6>
                            <div class="form-group row">
                                <label class="col-md-6 col-form-label" for="select1">Cotizadas</label>
                                <div class="col-md-6">
                                    <input style="text-align:right;" class="form-control" id="semanasCotizadas"
                                        name="semanasCotizadas" type="number" data-parsley-trigger="keyup" required
                                        data-parsley-type="number" required data-parsley-type="number"
                                        data-parsley-required-message="<i class='fas fa-exclamation-triangle'></i> Semanas cotizadas es requerida." data-parsley-trigger="keyup"  min="1" max="9999" >
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top: -1em;">
                                <label class="col-md-6 col-form-label text-danger" for="select1">
                                    Descontadas (-) 
                                    <a href="" id="descontar-semanas"><i class="text-info far fa-edit"></i></a>
                                </label>
                                <div class="col-md-6">
                                    <input style="text-align:right;" class="form-control" id="semanasDescontadas"
                                        name="semanasDescontadas" type="number" data-parsley-trigger="keyup"
                                        data-parsley-type="number" value="0"  min="0" max="9999" readonly>
                                </div>
                            </div>
                            <hr style="margin-top: -0.75em;">
                            <div class="form-group row" style="margin-top: -0.75em;">
                                <label class="col-md-6 col-form-label" for="totalSemanas">Total</label>
                                <div class="col-md-6">
                                    <input style="text-align:right;" class="form-control" id="totalSemanas"
                                        name="totalSemanas" type="number" data-parsley-trigger="keyup" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="card shadow" style="height: 10.5em;">
                        <div class="card-body" style="margin-top: -1em;">
                            <span class="card-title" style="font-size: 12.5px;font-weight: bold;"><i class="fas fa-people-arrows"></i> Asignaciones Familiares</span>
                            <br><br>
                            <div class="form-group row">
                                <div class="col-md-12" style="margin-top: -0.5em;">
                                    <select name="esposa" id="esposa" class="chosen-select">
                                        <option value="Si">Esposa: Si</option>
                                        <option value="No">Esposa: No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12" style="margin-top: -0.5em;">
                                    <select name="hijos" id="hijos" class="chosen-select">
                                        <option value="0">Hijos: 0</option>
                                        <option value="1">Hijos: 1</option>
                                        <option value="2">Hijos: 2</option>
                                        <option value="3">Hijos: 3</option>
                                        <option value="4">Hijos: 4</option>
                                        <option value="5">Hijos: 5</option>
                                        <option value="6">Hijos: 6</option>
                                        <option value="7">Hijos: 7</option>
                                        <option value="8">Hijos: 8</option>
                                        <option value="9">Hijos: 9</option>
                                        <option value="10">Hijos: 10</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12" style="margin-top: -0.5em;">
                                    <select name="padres" id="padres" class="chosen-select">
                                        <option value="0">Padres: 0</option>
                                        <option value="1">Padres: 1</option>
                                        <option value="2">Padres: 2</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="card shadow" style="height: 10.5em;">
                        <div class="card-body">
                            <h6 class="card-title"><i class="fas fa-tachometer-alt"></i> Rango de Pensión razonablemente
                                esperado</h6>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="rangoPensionDe" id="labelrangoPensionDe">De ($ 0)</label>
                                        <input style="text-align:right;" class="form-control" id="rangoPensionDe"
                                            name="rangoPensionDe" type="number" placeholder="$ Pesos" requireddata-parsley-type="number" required data-parsley-type="number"
                                            data-parsley-required-message="<i class='fas fa-exclamation-triangle'></i> El rango de la pensión es requerido." data-parsley-trigger="keyup"  min="1">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="rangoPensionA" id="labelrangoPensionA">A ($ 0)</label>
                                        <input style="text-align:right;" class="form-control" id="rangoPensionA"
                                            name="rangoPensionA" type="number" placeholder="$ Pesos" required data-parsley-gte="#rangoPensionDe" data-parsley-gte-message="<i class='fas fa-exclamation-triangle'></i> Este rango debe ser igual o mayor al rango anterior." data-parsley-required-message="<i class='fas fa-exclamation-triangle'></i> El rango de la pensión es requerido." data-parsley-trigger="keyup"  >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12" id="divEdadCliente">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card shadow" style="height: 10.5em;">
                        <div class="card-body">
                            <h6 class="card-title"><i class="fas fa-tachometer-alt"></i> Rango de inversión en M40</h6>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="rangoInversionDe" id="labelrangoInversionDe">De ($ 0)</label>
                                        <input style="text-align:right;" class="form-control" id="rangoInversionDe"
                                            name="rangoInversionDe" type="number" placeholder="$ Pesos" required data-parsley-required-message="<i class='fas fa-exclamation-triangle'></i> El rango de inversión es requerido." data-parsley-trigger="keyup"  min="1">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="rangoInversionA" id="labelrangoInversionA">A ($ 0)</label>
                                        <input style="text-align:right;" class="form-control" id="rangoInversionA"
                                            name="rangoInversionA" type="number" placeholder="$ Pesos" required data-parsley-gte="#rangoInversionDe" data-parsley-gte-message="<i class='fas fa-exclamation-triangle'></i> Este rango de inversión ser igual o mayor al rango anterior." data-parsley-required-message="<i class='fas fa-exclamation-triangle'></i> El rango de inversión es requerido." data-parsley-trigger="keyup"  >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12" id="divEdadCliente">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card shadow" style="height: 10.5em;">
                        <div class="card-body">
                            <h6 class="card-title"><i class="fas fa-feather-alt"></i> Vigente</h6>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="c-switch c-switch-label c-switch-success">
                                            <input class="c-switch-input" type="checkbox" checked="" id="statusRetiro" name="statusRetiro"><span class="c-switch-slider" data-checked="Si" data-unchecked="No"></span>
                                            </label>
                                        <input class="form-control" id="fechaBaja"
                                            name="fechaBaja" type="text" placeholder="Fecha de baja" required value="Vigente">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="comentarios">Peticiones o comentarios adicionales:</label>
                        <textarea class="form-control" id="comentarios" name="comentarios" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="otrosComentarios">Otros Comentarios:</label>
                        <textarea class="form-control" id="otrosComentarios" name="otrosComentarios" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
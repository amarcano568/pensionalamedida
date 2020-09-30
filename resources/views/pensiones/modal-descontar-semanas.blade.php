<div id="modal-descontar-semanas" class="modal fade" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" ><i class="fas fa-calendar-minus"></i> Descontar semanas</h4>
        <button id="cerrarModal" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" >
       
            <div class="row">
                <div class="col-sm-11">
                    <label for="">Seleccione tipo de descuento</label>  
                    <select name="tipo-desc-semana" id="tipo-desc-semana" class="chosen-select">
                        @foreach( $tiposDescuentoSemanas as $item )
                            <option value="{{ $item->tipo }}|{{ $item->id }}">
                                {{ $item->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-1">
                  <label for=""> </label>  
                    <button id="btn-agregar-tipo-semanas-desc" class="btn btn-primary"><i class="fas fa-check"></i></button>
                </div>
            </div>
            <hr>
            <div id="input-semanas-descontadas">
              
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-12">
                <table id="table-semanas-descontadas" class="table table-responsive-sm table-hover table-outline mb-0" style="width: 100%">
                  <thead class="thead-light">
                      <tr>
                          <th class="text-center">
                              Tipo
                          </th>
                          <th class="text-center">Descripción</th>
                          <th class="text-center">Desde</th>
                          <th class="text-center">Hasta</th>
                          <th class="text-center">Semanas</th>
                          <th class="text-center"></th>
                      </tr>
                  </thead>
                  <tbody id="body-semanas-descontadas">
                      
                  </tbody>
              </table>
              </div>
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
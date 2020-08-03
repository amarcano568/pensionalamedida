<form id="form-modal-inpc"  method="post" enctype="multipart/form-data" data-parsley-validate=""  action="" >
    @csrf
    <div id="modal-inpc" class="modal" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false">
        <div class="modal-dialog modal-xs modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="title-modal">
                        INPC</h5>
                </div>
                <div class="modal-body">
                   <div class="row">
                       <div class="col-sm-6">
                           <label for="inpc-mes-original">INPC DEL MES ORIGINAL</label>
                           <input data-parsley-type="number" required type="text" class="form-control" id="inpc-mes-original" name="inpc-mes-original" value="{{$nivel_vida->inpc_original}}">
                       </div>
                       <div class="col-sm-6">
                        <label for="inpc-mes-actual">INPC DEL MES ACTUAL</label>
                        <input data-parsley-type="number" required type="text" class="form-control" id="inpc-mes-actual" name="inpc-mes-actual" value="{{$nivel_vida->inpc_acual}}">
                    </div>
                   </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-cerrar-modal-inpc" class="btn btn-secondary btn-secondary"
                        >Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
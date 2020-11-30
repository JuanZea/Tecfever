<div id="editModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <h3 class="modal-title font-weight-bold">@lang('Actions')</h3>
      </div>
      <div class="modal-body d-flex justify-content-around">
        <a class="text-dark" data-dismiss="modal" data-toggle="modal" data-target="#importModal"><i class="fas fa-pencil-alt fa-3x sel hvr-grow" data-toggle="tooltip" data-placement="bottom" title="Importar productos"></i></a>
        <form class="mt-2" action="{{ route('products.destroy',$product) }}" method="POST">
            @csrf @method('DELETE')
            <button type="submit" class="text-dark" data-dismiss="modal" data-toggle="modal" data-target="#importModal"><i class="fas fa-trash-alt fa-3x sel hvr-grow" data-toggle="tooltip" data-placement="bottom" title="@lang('common.actions.delete')"></i></button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-block btn-danger" data-dismiss="modal">@lang('common.actions.cancel')</button>
      </div>
    </div>
  </div>
</div>

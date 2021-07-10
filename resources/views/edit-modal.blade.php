<div class="modal fade edit-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Country</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('update.country') }}" method="post" id="edit-country-form">
                            @csrf
      <div class="modal-body">
     
                            <input type="hidden" name="cid">
                            <div class="form-group">
                                <label for="">Country Name</label>
                                <input type="text" class="form-control" name="country_name" placeholder="Coutry Name..">
                                <span class="text-danger error-text country_name_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="">Capital City</label>
                                <input type="text" class="form-control" name="capital_city" placeholder="Capital City..">
                                <span class="text-danger error-text capital_city_error"></span>
                            </div>
                       
      </div>
      <div class="modal-footer">
         <button type="submit" class="btn btn-primary ">Save Changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
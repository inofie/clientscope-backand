<div class="modal fade new-modal" id="termsConditions" tabindex="-1" role="dialog" aria-labelledby="termsConditions" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title font-30" id="termsConditionsTitle">Terms and Conditions</h5>
            <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            {{ csrf_field() }}
            <div class="row">
               <div class="col-md-12">
                  <div id="termsConditionsFormError" class="error_div"></div>
                  <div id="termsConditionsFormSuccess" class="success_div"></div>
               </div>
            </div>
            <div class="row">
               <div class="form-group col-md-12 pt-3">
                  {!! !empty($appContent['termsConditions']->content) ? $appContent['termsConditions']->content : NULL !!}
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
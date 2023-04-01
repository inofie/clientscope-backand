<div class="modal fade new-modal" id="privacyPolicy" tabindex="-1" role="dialog" aria-labelledby="privacyPolicy" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title font-30" id="privacyPolicyTitle">Privacy Policy</h5>
            <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="form-group col-md-12 pt-3">
                  {!! !empty($appContent['privacyPolicy']->content) ? $appContent['privacyPolicy']->content : NULL !!}
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
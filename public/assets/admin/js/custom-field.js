$(document).ready(function () {
    let custom_field_html = '<div class="form-row">' +
        '                       <div class="col-md-4 statuses-righttable-select statuses-righttable-select-left form-group">\n' +
        '                          <select name="field_type[]" class="form-control" required>\n' +
        '                                  <option value="text">Text</option>\n' +
        '                                  <option value="textarea">Note</option>\n' +
        '                           </select>\n' +
        '                       </div>\n' +
        '                       <div class="col-md-4 statuses-righttable-select statuses-righttable-select-center form-group">\n' +
        '                          <input type="text" name="label[]" required class="form-control" placeholder="Field Name">\n' +
        '                       </div>\n' +
        '                       <div class="col-md-4  statuses-righttable-select" style="padding-left:10.5rem;">\n' +
        '                           <button style="margin-bottom: 10px; padding:0.6rem 1rem;" class="btn btn-cancel _remove_custom_field">Remove</button>\n' +
        '                       </div>' +
        '                    </div>';

    $('#_add_custom_field').click(function (e) {
        e.preventDefault();
        $('#_add_custom_field_section').append(custom_field_html);
    })

    $(document).on('click','._remove_custom_field',function(){
        $(this).parent().parent().remove();
    })

    $('._delete_custom_field').click( function(e){
        e.preventDefault();
        let ele = $(this);
        let id  = ele.attr('id');
        let msg = confirm('Are you sure you to delete this record?');
        if( msg ){
            ajax_request(base_url + '/admin/custom-fields/delete','POST',{id:id})
                .then( (res) => {
                    if( res.error ){
                        alert(res.message)
                        location.reload(true);
                    }else{
                        alert(res.message)
                        ele.parent().parent().fadeOut();
                    }
                })
        }else{
            return false
        }
    })
})
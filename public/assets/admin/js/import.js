$(document).ready( function(){

    var filename;

    $('#import_file_form').submit( function(e){
        e.preventDefault();
        if ($('#import_pin').get(0).files.length === 0) {
            alert("Import file is required");
        } else {
            filename = $('#import_pin')[0].files[0].name;
            $.ajax({
                type:'POST',
                url: base_url + '/admin/get-import-data',
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function(){
                    $('#overlay').show()
                },
                success: function(res){
                    $('#overlay').hide()
                    if( res.error ){
                        alert(res.message);
                    } else {
                        //step 1
                        $('#import_file_form').trigger("reset");
                        $('#step_1').attr('disabled','disabled')
                        //step 2
                        $('#step_2').removeAttr('disabled')
                        $('[data-target="#configCol"]').trigger('click')
                        $('#step2_data').html(res.data);
                    }
                }
            })
        }
    })

    $(document).on( 'click','#step_2_btn',function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: base_url + '/admin/get-import-step3',
            data: $('#step_2_form').serialize(),
            beforeSend: function(){
                $('#overlay').show()
            },
            success: function(res){
                $('#overlay').hide()
                $('#step_2').attr('disabled','disabled')
                $('#step_3').removeAttr('disabled');
                $('[data-target="#reviewData"]').trigger('click');
                $('#step3_data').html(res.data);
            }
        })
    })

    $(document).on('click','#_complete_import',function(e){
        e.preventDefault();
        var data = $('#step3_form').serializeArray();
        data.push({name: "filename", value: filename});
        $.ajax({
            type: 'POST',
            url: base_url + '/admin/get-import-step4',
            data: $.param(data),
            beforeSend: function(){
               $('#overlay').show()
            },
            success: function(res){
                $('#overlay').hide()
                $('#step_3').attr('disabled','disabled');
                $('#step_4').removeAttr('disabled');
                $('[data-target="#finish"]').trigger('click');
                $('form').trigger('reset');

                setTimeout(function(){
                   window.location.href = base_url + '/admin/user-pin';
                },3000)
            }
        })
    });

})
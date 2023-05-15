<script type="text/javascript">

var base_url = '<?php echo base_url(); ?>';
var csfr_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
var csfr_token_value = '<?php echo $this->security->get_csrf_hash(); ?>';

//-------------------------------------------------------------------
// Country State & City Change
  $(document).on('change','.country',function()
  {
    var data =  {
      country : this.value,
    }
    data[csfr_token_name] = csfr_token_value;

    $.ajax({
      type: "POST",
      url: "<?= base_url('account/get_country_states') ?>",
      data: data,
      dataType: "json",
      success: function(obj) {
        $('.state').html(obj.msg);
     },

    });

  });

  $(document).on('change','.state',function()
  {
    var data =  {
      state : this.value,
    }
    data[csfr_token_name] = csfr_token_value;
    $.ajax({
      type: "POST",
      url: "<?= base_url('account/get_state_cities') ?>",
      data: data,
      dataType: "json",
      success: function(obj) {
        $('.city').html(obj.msg);
     },

    });

  });

//-------------------------------------------------------------------
// Delete Confirm Dialogue box
$(document).ready(function(){
  $(".btn-delete").click(function(){
    if (!confirm("Are you sure? you want to delete")){
      return false;
    }
  });
});

// ---------------------------------------------------
// Close Education collapse
  $(document).on('click',".close_all_collapse",function(){
    $(".collapse").collapse('hide');
  });

// -------------------------------------------
// Edit user education
$(document).on('click','.edit-education',function(){
  var data = {
    edu_id : $(this).data('edu_id'),
  }
  data[csfr_token_name] = csfr_token_value;
   $.ajax({
    type: 'POST',
    url: base_url + 'profile/get_education_by_id',
    data: data,
    success: function (response) {
      $('#user-education-edit').html(response);
      $('#user-education-edit').collapse('show');
    }

  });
});

// -------------------------------------------
// Edit user language
$(document).on('click','.edit-language',function(){
  var data = {
    lang_id : $(this).data('lang_id'),
  }
  data[csfr_token_name] = csfr_token_value;
   $.ajax({
    type: 'POST',
    url: base_url + 'profile/get_language_by_id',
    data: data,
    success: function (response) {
      $('#user-language-edit').html(response);
      $('#user-language-edit').collapse('show');
    }

  });
});

//-------------------------------------
// 
// -------------------------------------------
// Edit user language
$(document).on('click','.edit-experience',function(){
  var data = {
    exp_id : $(this).data('exp_id'),
  }
  data[csfr_token_name] = csfr_token_value;
   $.ajax({
    type: 'POST',
    url: base_url + 'profile/get_experience_by_id',
    data: data,
    success: function (response) {
      $('#user-experience-edit').html(response);
      $('#user-experience-edit').collapse('show');
    }

  });
});

//-------------------------------------------
// current working or not
$(document).on('click','.currently_working_here',function(){
  $this = $(this);
  if($this.is(':checked'))
    $('.exp-end-field').addClass('hidden');
  else
    $('.exp-end-field').removeClass('hidden');
});

//------------------------------------------------------------
// Saved Job as favouite
$(document).on('click', '.saved_job', function(){
  
  var data = {
    job_id : $(this).data('job_id'),
  }
  data[csfr_token_name] = csfr_token_value;

  $.ajax({
    type: 'POST',
    url: base_url + 'myjobs/save_job',
    data: data,
    success: function (response) {
      console.log(response);
      if($.trim(response) == "not_login"){
       $.notify("Alert! Please login first", "danger");
      }
      if($.trim(response) == "already_saved"){
         $.notify("Alert! Job is already saved.", "danger");
      }
      if($.trim(response) == "saved"){
        $.notify("job has been saved Successfully", "success");
      }
    }

  });

}); // end save job

// shortlisted profile
$('.get_shortlisted_user_profile').on('click',function(){
  var data = {
    user_id : $(this).data('user'),
  }
  data[csfr_token_name] = csfr_token_value;

  $.ajax({
      data: data,
      type: 'POST',
      url: '<?php echo base_url();?>employers/applicants/get_shortlisted_user_profile',
      success: function(response){
        $('.shortlisted-profile-modal-body').html(response);
        $('#profileModal').modal('show');
      }
  });
  e.preventDefault();

});

//-------------------------------------------------------------------
// Sending Email to applicant

 $('#emailModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    var modal = $(this)
    modal.find('.modal-title').text('New message to ' + recipient)
    modal.find('.modal-body #email').val(recipient);

    var send_email = $(this).find('.send_email');

    send_email.click(function(e) {

      var _form = $(".email-form").serialize();
      $.ajax({
          data: _form,
          type: 'POST',
          url: '<?php echo base_url();?>employers/applicants/email',
          success: function(response){
            $(this).removeData('bs.modal');
            $.notify("Email has been sent Successfully", "success");
            $('.close').trigger('click');
          }
      });
      e.preventDefault();
    }); 

    $(this).on('hide.bs.modal', function() {
      send_email.off('click');
      $(this).find('form').trigger('reset');
    });
    
  }); // end email function

/* Footer Widget Script */

// Remove Widget
$(document).on('click','.remove-footer-widget',function()
{
  a = confirm('are you sure?');
  (a) ? $(this).closest('div.widget').remove() : '';
    
});

// Add new widget
$('.btn-add-widget').on('click',function()
{
widget = '<div class="widget">\
    <div class="row">\
        <div class="col-md-3">\
          <div class="form-group">\
            <input type="text" class="form-control" name="widget_field_title[]" >\
          </div>\
        </div>\
        <div class="col-md-2">\
        <div class="form-group">\
        <select class="form-control" name="widget_field_column[]">\
        <option value="4">1/4</option>\
        <option value="3">1/3</option>\
        <option value="2">1/2</option>\
        </select>\
        </div>\
        </div>\
        <div class="col-md-6">\
          <div class="form-group">\
            <textarea class="form-control" name="widget_field_content[]"></textarea>\
          </div>\
        </div>\
        <div class="col-md-1">\
            <button type="button" class="btn btn-danger remove-footer-widget"><i class="fa fa-trash"></i></button>\
        </div>\
    </div>\
</div>';

$('.footer-widget-body').append(widget);
});

</script>
$(function () {
   $('#confirm-box').click(function(){
      $('#myModal').modal('show');
      $('#confirmation-message').html($(this).data('msg'));
      $('#redirection-url').val($(this).data('redirect-to'));
      return false;
   });

   $('#redirection-url').click(function() {
      var url = $(this).val();

      if(url) {
         window.location.href = url;
      }
   });

});

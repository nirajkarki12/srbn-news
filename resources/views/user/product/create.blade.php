@extends('layouts.user-dashboard')

@section('content')

<!-- <div class="row justify-content-center"> -->

   <!-- <div class="col-md-12"> -->
      <!-- <div class="card"> -->
          <!-- <div class="card-header">Post New Ad</div> -->

          <!-- <div class="card-body"> -->
            <form method="POST" action="{{ route('user.post.store') }}" enctype="multipart/form-data">
               @csrf

               <div id="smartwizard">
                  <ul>
                     <li><a href="#step-1">Step 1<br /><small>Choose Your Post Category</small></a></li>
                     <li><a href="#step-2">Step 2<br /><small>Define Your Post</small></a></li>
                     <li><a href="#step-3">Step 3<br /><small>Upload Some Pictures</small></a></li>
                     <li><a href="#step-4">Step 4<br /><small>Publish This Post</small></a></li>
                  </ul>

                  <div>
                     <div id="step-1" class="row">
                        <div class="form-group row">
                           <label for="category_parent" class="col-md-2 col-form-label">Category</label>

                            <div class="col-md-9">
                                 <select class="form-control" id="category_parent" name="parent_id" @error('parent_id') is-invalid @enderror" required autocomplete="parent_id" autofocus>
                                    {!! $controller->printCategoryTree($arrCategory, old('parent_id')) !!}
                                </select>

                                @error('parent_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                     </div>
                     <div id="step-2" class="">
                        <h3 class="border-bottom border-gray pb-2">Step 2 Content</h3>
                        
                        <div class="form-group row">
                            <label for="title" class="col-md-2 col-form-label">Title</label>

                            <div class="col-md-9">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                           <label for="description" class="col-md-2 col-form-label">Description</label>

                            <div class="col-md-9">
                              <textarea class="form-control" id="description" name="description" rows="3" cols="80" value="{{ old('description') }}" @error('description') is-invalid @enderror" required autocomplete="description" autofocus>{{ old('description') }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                     </div>
                     <div id="step-3" class="">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                     </div>
                      <div id="step-4" class="">
                        <h3 class="border-bottom border-gray pb-2">Step 4 Content</h3>
                           <div class="card">
                              <div class="card-header">My Details</div>
                              <div class="card-block p-0">
                                 <table class="table">
                                    <tbody>
                                       <tr> <th>Name:</th> <td>Tim Smith</td> </tr>
                                       <tr> <th>Email:</th> <td>example@example.com</td> </tr>
                                    </tbody>
                                 </table>
                              </div>

                              <div class="form-group row mb-0">
                                  <div class="col-md-9 offset-md-3">
                                      <button type="submit" class="btn btn-primary">
                                          Save
                                      </button>
                                  </div>
                              </div>
                           </div>
                      </div>
                  </div>
               </div>
            </form>
          <!-- </div> -->
      <!-- </div> -->
   <!-- </div> -->
<!-- </div> -->


@endsection

<script src="{{ asset('vendor/bower_components/ckeditor/ckeditor.js') }}"></script>
@section('scripts')
<script type="text/javascript">
   $(document).ready(function() {
      CKEDITOR.replace('description');

      // Pre selecting if value already exists
      var addressLine1 = $("#address_line_1").val();
      var addressLine2Value = $("#address_line_2_value").val();
      if(addressLine1) loadDistricts(addressLine1, addressLine2Value);

      function loadDistricts(province, addressLine2Value = '') {
         var dataContent = $('body').find('#address_line_2');
         var url = '{!! route("address.district.lists", ":province") !!}';
         url = url.replace(':province', province);

         $.ajax({
             type:'post',
             data: { "_token": "{{ csrf_token() }}", "oldValue": addressLine2Value },
             url: url,
             success:function(data){
                 dataContent.html(data);
             }
         });
      }

      $("body").on("change","#address_line_1", function(){
         loadDistricts($(this).val());
      });

      $('#category_parent').bind("change", function() {
         var space_offset = 8;
         var matches = $("#category_parent option:selected").text().match(/\s{3}/g);
         var n_spaces = (matches) ? matches.length : 0;
         $(this).css('text-indent', -(n_spaces * space_offset));
      });

      $('#category_parent').val('{{ old('parent_id')}}').change();



      // Step show event
      $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
         //alert("You are on step "+stepNumber+" now");
         if(stepPosition === 'first'){
             $("#prev-btn").addClass('disabled');
         }else if(stepPosition === 'final'){
             $("#next-btn").addClass('disabled');
         }else{
             $("#prev-btn").removeClass('disabled');
             $("#next-btn").removeClass('disabled');
         }
      });

      $("#smartwizard").on("endReset", function() {
        $("#next-btn").removeClass('disabled');
      });

      // Toolbar extra buttons
      var btnFinish = $('<button></button>').text('Finish')
                     .addClass('btn btn-info')
                     .on('click', function(){ 
                        alert('Finish Clicked'); 
                     });
      var btnCancel = $('<button></button>').text('Cancel')
                     .addClass('btn btn-danger')
                     .on('click', function(){ 
                        $('#smartwizard').smartWizard("reset"); 
                     });


      // Smart Wizard
      $('#smartwizard').smartWizard({
              selected: 0,
              theme: 'arrows',
              transitionEffect:'fade',
              showStepURLhash: true,
              toolbarSettings: {
                  toolbarPosition: 'both',
                  toolbarButtonPosition: 'end',
                  toolbarExtraButtons: [btnFinish, btnCancel]
               }
      });


      $("#prev-btn").on("click", function() {
          // Navigate previous
          $('#smartwizard').smartWizard("prev");
          return true;
      });

      $("#next-btn").on("click", function() {
          // Navigate next
          $('#smartwizard').smartWizard("next");
          return true;
            });
   });
</script>
@endsection


@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">


    <div class="row profile-body">
      <!-- middle wrapper start -->
      <div class="col-md-8 col-xl-8 middle-wrapper">
        <div class="row">
          <div class="card">
             <div class="card-body">

                 <h6 class="card-title">Add Property Type</h6>

                 <form method="POST" action="{{ route('type.store') }}" enctype="multipart/form-data" class="forms-sample">
                     @csrf

                     <div class="mb-3">
                         <label for="type_name" class="form-label">Type Name</label>
                         <input name="type_name" type="text" class="form-control @error('type_name') is-invalid @enderror">
                         @error('type_name')
                         <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>

                     <div class="mb-3">
                         <label for="type_icon" class="form-label">Type Icon</label>
                         <input name="type_icon" type="text" class="form-control @error('type_icon') is-invalid @enderror">
                         @error('type_icon')
                         <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>

                     {{-- <div class="mb-3">
                        <label for="type_icon" class="form-label">Type Icon</label>
                        <input class="form-control" name="type_icon" type="file" id="type_icon">
                        </div>
                        <div class="mb-3">
                        <label for="exampleInputUsername1" class="form-label"></label>
                        <img class="wd-100 rounded-circle" id="showIcon"
                                src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="property type icon">
                        </div> --}}

                     <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                 </form>

             </div>
           </div>
        </div>
      </div>
    </div>
 </div>

 {{-- <script type="text/javascript">
    $(document).ready(function(){
        $('#type_icon').change(function(e){
            const reader = new FileReader();
            reader.onload = function(e){
                $('#showIcon').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script> --}}

@endsection


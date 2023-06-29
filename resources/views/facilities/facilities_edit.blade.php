@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">


    <div class="row profile-body">
      <!-- middle wrapper start -->
      <div class="col-md-8 col-xl-8 middle-wrapper">
        <div class="row">
          <div class="card">
             <div class="card-body">

                 <h6 class="card-title">Edit Property Facility</h6>

                 <form method="POST" action="{{ route('facilities.update') }}" class="forms-sample">
                     @csrf

                     <input type="hidden" name="id" value="{{ $facil->id }}">
                     <div class="mb-3">
                         <label for="facilities_name" class="form-label">Facility Name</label>
                         <input name="facilities_name" type="text" class="form-control @error('facilities_name') is-invalid @enderror" value="{{ $facil->facilities_name }}">
                         @error('facilities_name')
                         <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>

                     {{-- <div class="mb-3">
                         <label for="facilities_icon" class="form-label">Facility Icon</label>
                         <input name="facilities_icon" type="text" class="form-control @error('facilities_icon') is-invalid @enderror" value="{{ $facil->facilities_icon }}">
                         @error('facilities_icon')
                         <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div> --}}

                     <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                 </form>

             </div>
           </div>
        </div>
      </div>
    </div>
 </div>

@endsection




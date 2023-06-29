@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">


   <div class="row profile-body">
     <div class="col-md-6 col-xl-6 middle-wrapper">
       <div class="row">
         <div class="card">
            <div class="card-body">

                <h6 class="card-title">Change Password</h6>

                <form method="POST" action="{{ route('admin.password.update') }}"  class="forms-sample">
                    @csrf

                    <div class="mb-3">
                        <label for="old_password1" class="form-label">Old Password</label>
                        <input class="form-control @error('old_password') is-invalid @enderror" id="old_password" name="old_password" type="password" autocomplete="off">
                        @error('old_password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="new_password1" class="form-label">New Password</label>
                        <input class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" type="password" autocomplete="off">
                        @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="confirm_password1" class="form-label">Confirm New Password</label>
                        <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation"  autocomplete="off">
                    </div>


                    <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                </form>

            </div>
          </div>
       </div>
     </div>
   </div>
</div>


@endsection

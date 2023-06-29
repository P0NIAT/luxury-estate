@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('facilities.addnew') }}" class="btn btn-inverse-info">Add Property Facility</a>
        </ol>
    </nav>

        <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Property - All Facilities</h6>
                            <div class="table-responsive">
                                <table id="dataTableExample" class="table">
        <thead>
          <tr>
            <th>Serial number</th>
            <th>Facility Name</th>
            {{-- <th>Facility Icon</th> --}}
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($facil as $key => $item )
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $item->facilities_name }}</td>
                {{-- <td>{{ $item->facilities_icon }}</td> --}}
                <td>
                    {{-- <a href="{{ route('edit.facilities',$item->id) }}" class="btn btn-inverse-warning">Edit</a> --}}
                    <a href="{{ route('facilities.edit',$item->id) }}" class="btn btn-inverse-warning">Edit</a>
                    <a href="{{ route('facilities.delete',$item->id) }}" class="btn btn-inverse-danger" id="delete" >Delete</a>
                </td>
            </tr>
            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
     </div>
    </div>
</div>

@endsection


@extends('layouts.admin')

@section('title', 'Jobs Companies')

@section('content-header', 'List of Jobs Companies')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active"><a href="{{route('jobs.company')}}"><i class="fa fa-folder-o"></i> Companies</a></li>
@endsection

@section('content')

    @include('notification.notify')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">List of Companies</h3>
                    <div class="box-tools pull-right">
                        <a href="#" data-toggle="modal" data-target="#companyModal" class="btn pull-right" title="Add a Category">
                            <span class="fa fa-plus"> New Company</span>
                        </a>
                    </div>
                </div>
                <div class="box-body">

                    @if(count($companies) > 0)

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="4%">#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th class="text-center" width="11%">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($companies as $key => $company)
                                <tr>
                                    <td style="vertical-align:middle">{{ $key+1 }}</td>
                                    <td>
                                        <img src="{{$company->image}}" alt="image" style="height:35px">
                                    </td>
                                    <td style="vertical-align:middle">{{ $company->name }}</td>
                                    <td style="vertical-align: middle">{{substr($company->description,0, 120).'...'}}</td>
                                    <td>{{$company->address}}</td>
                                    <td>{{$company->phone}}</td>
                                    <td style="vertical-align:middle" class="text-center">
                                        <span class="btn btn-warning btn-xs" onclick="edit({{$company}})" style="cursor: pointer" title="Edit company">
                                            <span class="fa fa-pencil-square-o fa-lg"></span>
                                        </span>
                                        &nbsp;
                                        <a class="btn btn-danger btn-xs" href="{{route('jobs.company.delete' , $company)}}" title="Delete a company" onclick="return confirm('Are you sure?')">
                                            <span class="fa fa-times fa-lg"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <h3 class="no-result">No results found</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="companyModal" tabindex="-1" role="dialog" aria-labelledby="companyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form" action="{{route('jobs.company.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 id="modal-title">Create Company</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" value="{{old('name')}}" placeholder="Name of company" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Name Nepali</label>
                            <input type="text" id="name_nepali" name="name_nepali" value="{{old('name_nepali')}}" placeholder="Name of company in nepali" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description in English</label>
                            <textarea name="description" id="description" class="form-control" placeholder="Write description in english" required>{{old('description')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description_nepali">Description in Nepali</label>
                            <textarea name="description_nepali" id="description_nepali" class="form-control" placeholder="Write description in nepali" required>{{old('description_nepali')}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="address">Address in English</label>
                            <input type="text" name="address" id="address" value="{{old('address')}}" class="form-control" placeholder="Address in english language">
                        </div>

                        <div class="form-group">
                            <label for="address_nepali">Address in Nepali</label>
                            <input type="text" name="address_nepali" id="address_nepali" value="{{old('address_nepali')}}" class="form-control" placeholder="Address in nepali langauge">
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone number</label>
                            <input type="number" name="phone" id="phone" value="{{old('phone')}}" class="form-control" placeholder="Phone number of company" required>
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control" required>
                        </div>
                        <div id="image-file">

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function edit(company){
            $('#name').val(company.name)
            $('#name_nepali').val(company.name_nepali)

            $('#phone').val(company.phone)

            $('#description').val(company.description)
            $('#description_nepali').val(company.description_nepali)

            $('#address').val(company.address)
            $('#address_nepali').val(company.address_nepali)

            $('#image-file').html(`<img src="${company.image}" style="height:35px" title="${company.name}"/>`)

            $('#companyModal').modal('show')
            $('#modal-title').html('Edit Company')
            $('#form').attr('action', `{{route('jobs.company.store')}}/${company.id}`);
            $('#image').removeAttr('required');
        }

        $('#companyModal').on('hidden.bs.modal', function (e) {
            $('#companyModal').find('form')[0].reset();
            $('#image').attr('required', true);
            $('#image-file').html('')
            $('#modal-title').html('Create Company')
            $('#form').attr('action', `{{route('jobs.company.store')}}`);
        })
    </script>
@endsection

@extends('layouts.admin')

@section('title', 'Vacancies')

@section('content-header', 'List of Jobs Vacancies')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active"><a href="{{route('admin.vacancy')}}"><i class="fa fa-folder-o"></i> Vacancies</a></li>
@endsection

@section('content')

    @include('notification.notify')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">List of Vacancies</h3>
                    <div class="box-tools pull-right">
                        <a href="#" data-toggle="modal" data-target="#vacancyModal" class="btn pull-right" title="Add a Category">
                            <span class="fa fa-plus"> New Vacancy</span>
                        </a>
                    </div>
                </div>
                <div class="box-body">

                    @if(count($vacancies) > 0)

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="4%">#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Level</th>
                                <th>Location</th>
                                <th>Company</th>
                                <th>Salary</th>
                                <th>Apply Date</th>
                                <th class="text-center" width="11%">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($vacancies as $key => $vacancy)
                                <tr>
                                    <td style="vertical-align:middle">{{ $key+1 }}</td>
                                    <td>
                                        <img src="{{$vacancy->image}}" alt="image" style="height:35px">
                                    </td>
                                    <td style="vertical-align:middle">{{ $vacancy->title }}</td>
                                    <td style="vertical-align:middle">{{ $vacancy->level }}</td>
                                    <td style="vertical-align:middle">{{ $vacancy->location }}</td>
                                    <td style="vertical-align:middle">{{ $vacancy->company->name }}</td>
                                    <td style="vertical-align:middle">{{ $vacancy->salary }}</td>
                                    <td style="vertical-align:middle">{{ $vacancy->apply_date }}</td>
                                    <td style="vertical-align:middle" class="text-center">
                                        <span class="btn btn-warning btn-xs" onclick="edit({{$vacancy}})" style="cursor: pointer" title="Edit vacancy">
                                            <span class="fa fa-pencil-square-o fa-lg"></span>
                                        </span>
                                        &nbsp;
                                        <a class="btn btn-danger btn-xs" href="{{route('admin.vacancy.delete' , $vacancy)}}" title="Delete a vacancy" onclick="return confirm('Are you sure?')">
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

    <div class="modal fade" id="vacancyModal" tabindex="-1" role="dialog" aria-labelledby="vacancyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="modal-title">Create Vacancy</h4>
                </div>
                <form action="{{route('admin.vacancy.store')}}" method="post" id="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="vacancy">Company</label>
                                    <select name="company_id" id="company" class="form-control" required style="width: 100%;">
                                        <option value="" disabled>Type and select a vacancy</option>
                                        @foreach($companies as $vacancy)
                                            <option value="{{$vacancy->id}}">{{$vacancy->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="category">Job Categories</label><br>
                                    <select class="form-control" id="category" name="job_category_id[]" multiple="multiple" required style="width: 100%;">
                                        <option value="" disabled>Type and select Job Categories</option>
                                        @foreach($jobCategories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="title">Title English</label>
                                    <input type="text" value="{{old('title')}}" name="title" id="title" placeholder="Title in english" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="title_nepali">Title Nepali</label>
                                    <input type="text" value="{{old('title_nepali')}}" id="title_nepali" name="title_nepali" placeholder="Title in nepali" class="form-control" required>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="level">Level English</label>
                                    <input type="text" value="{{old('level')}}" name="level" id="level" placeholder="Level in english" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="level_nepali">Level Nepali</label>
                                    <input type="text" value="{{old('level_nepali')}}" id="level_nepali" name="level_nepali" placeholder="Level in nepali" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="employment_type">Employment Type English</label>
                                    <input type="text" value="{{old('employment_type')}}" name="employment_type" id="employment_type" placeholder="Employment Type in english" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="employment_type_nepali">Employment Type Nepali</label>
                                    <input type="text" value="{{old('employment_type_nepali')}}" id="employment_type_nepali" name="employment_type_nepali" placeholder="Employment Type in nepali" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="location">Location English</label>
                                    <input type="text" value="{{old('location')}}" name="location" id="location" placeholder="Employment Type in english" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="location_nepali">Location Nepali</label>
                                    <input type="text" value="{{old('location_nepali')}}" id="location_nepali" name="location_nepali" placeholder="Location in nepali" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="salary">Salary English</label>
                                    <input type="text" value="{{old('salary')}}" name="salary" id="salary" placeholder="Salary in english" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="salary_nepali">Salary Nepali</label>
                                    <input type="text" value="{{old('salary_nepali')}}" id="salary_nepali" name="salary_nepali" placeholder="Salary in nepali" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6" id="apply_date_picker">
                                    <label for="apply_date">Apply Date</label>
                                    <input type="datetime-local" min="{!! \Carbon\Carbon::now() !!}" name="apply_date" id="apply_date" placeholder="Apply Date" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="apply_link">Apply Link</label>
                                    <input type="text" value="{{old('apply_link')}}" id="apply_link" name="apply_link" placeholder="Apply link" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="number">Number of vacancies</label>
                                    <input type="number" value="{{old('number')}}" name="number" id="number" placeholder="Number of vacancies" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="image">Cover</label>
                                    <input type="file" id="image" name="image" class="form-control">
                                    <div id="image-file"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function edit(vacancy){
            $('#title').val(vacancy.title)
            $('#title_nepali').val(vacancy.title_nepali)
            $('#level').val(vacancy.level)
            $('#level_nepali').val(vacancy.level_nepali)
            $('#employment_type').val(vacancy.employment_type)
            $('#employment_type_nepali').val(vacancy.employment_type_nepali)
            $('#location').val(vacancy.location)
            $('#location_nepali').val(vacancy.location_nepali)
            $('#salary').val(vacancy.salary)
            $('#salary_nepali').val(vacancy.salary_nepali)
            $('#apply_link').val(vacancy.apply_link)
            $('#apply_date').val(vacancy.apply_date)
            $('#number').val(vacancy.number)

            $('#image-file').html(`<img src="${vacancy.image}" style="height:35px" title="${vacancy.name}"/>`)

            $('#vacancyModal').modal('show')
            $('#modal-title').html('Edit Vacancy')
            $('#form').attr('action', `{{route('admin.vacancy.store')}}/${vacancy.id}`);
            $('#image').removeAttr('required');
        }

        $('#vacancyModal').on('hidden.bs.modal', function (e) {
            $('#vacancyModal').find('form')[0].reset();
            $('#image-file').html('')
            $('#modal-title').html('Create Vacancy')
            $('#form').attr('action', `{{route('admin.vacancy.store')}}`);
        })

        $(function(){
            $('#category').select2();
            $('#company').select2();
        })
    </script>
@endsection

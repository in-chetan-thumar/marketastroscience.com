@extends('admin.layouts.master')

@section('title')
    New Role
@endsection
@section('css')
@endsection
@section('content')

    @component('components.breadcrumb', [
        'lists' => ['Dashboard' => route('root'), 'Role list' => route('roles.index')],
    ])
        @slot('title')
            New Role
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-end">
                        <a href="{{ route('roles.index') }}" class="btn btn-primary"><i class="mdi mdi-arrow-left"></i>
                            Back to list</a>
                    </div>
                    <div class="clearfix"></div>
                    {{ html()->form('POST', route('roles.store'))->id('role-form')->open() }}
                    <div class="row">
                        <div class="col-xs-6 col-sm-12 col-md-6">
                            <div class="mb-3">
                                <div class="form-group">
                                    {{ html()->label('Role') }}<span class="required">*</span>
                                    {{ html()->input('text', 'name', old('name'))->placeholder('Enter name')->class('form-control ' . ($errors->has('name') ? 'is-invalid' : '')) }}
                                    @error('name')
                                        <span style="color:red">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-12 col-md-6">
                            <div class="mb-3">
                                <div class="form-group">
                                    {{ html()->label('Where to redirect') }}<span class="required">*</span>
                                    {{ html()->select('redirect_to', $redirectablePermission, old('redirect_to'))->placeholder('Select where to redirect this role')->class('form-control form-select' . ($errors->has('redirect_to') ? 'is-invalid' : '')) }}
                                    @error('redirect_to')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="mb-3">
                                <div class="form-group">
                                    <strong>Permission:</strong>
                                    <br />
                                    <br />
                                    <div class="row">
                                        @if (!empty($permissions_data))
                                            @foreach ($permissions_data as $row)
                                                <div class="col-md-12">
                                                    <div class="nhsuk-do-dont-list">
                                                        <h6 class="nhsuk-do-dont-list__label"
                                                            style="font-size: 1.0rem !important;">
                                                            {{ $row['section_title'] }}</h6>
                                                        <hr />
                                                        <div class="row">
                                                            @foreach ($row['permission'] as $permisson_list)
                                                                <div class="col-md-3 mt-2">
                                                                    <div class="nhsuk-checkboxes__item">
                                                                        <input class="nhsuk-checkboxes__input"
                                                                            id="{{ $permisson_list['permission_label'] }}"
                                                                            name="permission[]" type="checkbox"
                                                                            value="{{ $permisson_list['id'] }}"
                                                                            aria-controls="conditional-contact-1"
                                                                            aria-expanded="false">
                                                                        <label class="nhsuk-label nhsuk-checkboxes__label"
                                                                            for="{{ $permisson_list['permission_label'] }}">
                                                                            {{ $permisson_list['permission_label'] }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <br />
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3">
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <button type="submit" class="btn btn-primary waves-effect btnSubmit waves-light">Add
                                        role</button>
                                </div>
                                {{ html()->form()->close() }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
        @endsection
        @section('script')
            <script type="text/javascript" src="{{ asset('assets/vendor/jsvalidation/js/jsvalidation.js') }}"></script>
            {!! JsValidator::formRequest('App\Http\Requests\RoleRequest', '#role-form') !!}
            <script type="text/javascript">
                $(".btnSubmit").on('click', function(e) {

                    $("#role-form").submit();

                    if ($("#role-form").valid()) {
                        $('#status').show();
                        $('#preloader').show();
                        $(".btnSubmit").prop('disabled', true);
                    }
                });
            </script>
        @endsection

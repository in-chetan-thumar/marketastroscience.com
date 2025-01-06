@extends('wireframe.admin.layouts.master')

@section('title')
    User list
@endsection
@section('css')
@endsection
@section('content')
    @component('components.breadcrumb', ['lists' => ['Dashboard' => route('wireframe.root')]])
        @slot('title')
            User list
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-end">
                        @can('usermanagements.create')
                            <a href="{{ route('wireframe.usermanagements.create') }}" onclick="showSaveModel(event)"
                                class="btn btn-primary right-button"><i class="mdi mdi-plus"></i>&nbsp;Add User</a>
                        @endcan
                    </div>
                    <div class="float-start">
                        {!! Form::open([
                            'url' => route('wireframe.usermanagements.index'),
                            'id' => 'form-search',
                            'class' => 'row row-cols-lg-auto g-3 align-items-center',
                            'method' => 'get',
                        ]) !!}
                        <div class="form-group ">
                            {{ Form::bsText('', 'query_str', request()->query('query_str'), '', ['class' => '', 'placeholder' => 'Search by name / email'], [], false) }}
                        </div>
                        <div class="form-group mt-0">
                            {{ Form::bsSelect('', 'role', request()->query('role'), '', ['class' => '', 'placeholder' => 'Select role'], $roles, false) }}
                        </div>
                        <div class="form-group mt-0">
                            {{ Form::bsSelect('', 'is_active', request()->query('is_active'), '', ['class' => '', 'placeholder' => 'Select status'], $status, false) }}
                        </div>
                        <div class="form-group">
                            <button type="submit" name="type" value="submit"
                                class="btn btn-primary waves-effect waves-light search-button-size">
                                Submit
                            </button>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('wireframe.usermanagements.index') }}"
                                class="btn btn-secondary waves-effect waves-light search-button-size">
                                Reset
                            </a>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="divtable">
                        @include('wireframe.admin.user.table')
                    </div>
                </div>
            </div>
        </div>
        <div class="divOffcanvas">

        </div>
    </div>
@endsection
@section('script-bottom')
    <script type="text/javascript" src="{{ asset('assets/vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/user.js') }}"></script>
@endsection

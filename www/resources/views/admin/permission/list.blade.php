@extends('admin.layouts.master')

@section('title')
    Permission list
@endsection
@section('css')
@endsection
@section('content')
    @component('components.breadcrumb', ['lists' => ['Dashboard' => route('root')]])
        @slot('title')
            Permission list
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-end ">
                        <div class="row row-cols-lg-auto g-3 align-items-center">
                            <div class="form-group">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-light dropdown-toggle form-control"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ri-table-line fs-10 m-0 me-1"></i> Columns
                                    </button>
                                    <div class="dropdown-menu p-3 z-index-1">
                                        <div class="dropdown-header noti-title" style="width: 300px">
                                            <h5 class="font-size-13 text-muted text-truncate mn-0">Choice important columns
                                            </h5>
                                        </div>
                                        <!-- item-->
                                        <select id="choices-multiple-columns"
                                            class="form-control form-select   dropdown-item" multiple
                                            placeholder="Select columns">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <!-- Dropdown for selecting rows per page -->
                                <select id="rows-per-page-dropdown" class="form-control form-select">
                                    <option value="5">5</option>
                                    <option value="10" selected>10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            @can('permission.create')
                                <a href="{{ route('permission.create') }}" onclick="showSaveModel(event)"
                                    class="btn btn-primary"><i class="mdi mdi-plus"></i>&nbsp;Add permission</a>
                            @endcan
                        </div>

                    </div>
                    <div class="float-start">
                        {{ html()->form('get', route('option.list.data'))->id('form-search')->class('row row-cols-lg-auto g-3 align-items-center')->open() }}
                        <div class="form-group">
                            {{ html()->input('text', '', '')->placeholder('Search records...')->id('search-input')->class('form-control ') }}
                        </div>
                        <div class="form-group">
                            <a href="{{ route('permission.index') }}"
                                class="btn btn-danger waves-effect waves-light search-button-size">
                                <i class="ri ri-refresh-line  fw-normal"></i>&nbsp; Reset
                            </a>
                            {{ html()->form()->close() }}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="divtable">
                        @include('admin.permission.table')
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
    <script type="text/javascript" src="{{ asset('assets/js/permission.js') }}"></script>
    <script>
        $(document).ready(function() {
            initializeDataTable({
                moduleNmae: 'permission',
                tableSelector: '#permission-table-data', // Table id
                ajaxUrl: "/get-permission", // AJAX endpoint
                // Table column configuration
                columnsConfig: [{
                        data: "title"
                    },
                    {
                        data: "name"
                    },
                    {
                        data: "permission_label"
                    },
                    {
                        data: "status",
                        orderable: false
                    },
                    {
                        data: "action",
                        orderable: false
                    }
                ],
                searchInputSelector: '#search-input', // Search input field
                rowsPerPageDropdownSelector: '#rows-per-page-dropdown', // Rows-per-page dropdown
                columnSelectElement: '#choices-multiple-columns', // Column visibility dropdown

                // Pass filters dynamically
                filters: [{
                    name: 'query_str',
                    selector: '#search-input'
                }],

                // Pass dropdowns dynamically
                dropdowns: [],

                // Always visible columns
                alwaysVisibleColumns: [3, 4],
                // Default visible columns
                defaultVisibleColumn: [0, 1],

                // Export table data 
                exportButtonSelector: null, //Export button ID/Class 
                exportEndPoint: null, // Export endpoint
            });
        });
    </script>
@endsection

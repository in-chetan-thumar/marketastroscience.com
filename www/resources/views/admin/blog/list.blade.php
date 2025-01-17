@extends('admin.layouts.master')

@section('title')
    Blog list
@endsection
@section('css')
    <link href=" {{ asset('assets/css/ckeditor5.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
    @component('components.breadcrumb', ['lists' => ['Dashboard' => route('root')]])
        @slot('title')
            Blog list
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

                            {{-- @can('option-list.create')s --}}
                            <a href="{{ route('blogs.create') }}" onclick="showSaveModel(event)"
                                class="btn btn-dark right-button ms-3"><i class="mdi mdi-plus"></i>&nbsp;Add new blog</a>
                            {{-- @endcan --}}
                        </div>

                    </div>
                    <div class="float-start">
                        {{ html()->form('get', route('blogs.data'))->id('form-search')->class('row row-cols-lg-auto g-3 align-items-center')->open() }}
                        <div class="form-group">
                            {{ html()->input('text', '', '')->placeholder('Search records...')->id('search-input')->class('form-control ') }}
                        </div>
                        <div class="form-group ">
                            {{ html()->select('is_active', $status, request()->query('is_active'))->placeholder('Select status')->id('status-dropdown')->class('form-control form-select') }}
                        </div>
                        <div class="form-group">
                            <a href="{{ route('blogs.index') }}"
                                class="btn btn-danger waves-effect waves-light search-button-size">
                                <i class="ri ri-refresh-line  fw-normal"></i>&nbsp; Reset
                            </a>
                            {{ html()->form()->close() }}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="divtable">
                        @include('admin.blog.table')
                    </div>
                </div>
            </div>
        </div>
        <div class="divOffcanvas">

        </div>
    </div>
@endsection
@section('script-bottom')
    <script type="importmap">
			{
				"imports": {
					"ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.0/ckeditor5.js",
					"ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.0/"
				}
			}
		</script>

    <script type="text/javascript" src="{{ asset('assets/vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/blog.js') }}"></script>
    <script>
        $(document).ready(function() {
            initializeDataTable({
                moduleNmae: 'blog',
                tableSelector: '#blog-table-data', // Table id
                ajaxUrl: "/get-blogs", // AJAX endpoint
                // Table column configuration
                columnsConfig: [{
                        data: "title"
                    },
                    {
                        data: "image",
                        orderable: false
                    },
                    {
                        data: "description"
                    },
                    {
                        data: "date"
                    },
                    {
                        data: "status",
                        orderable: false
                    },
                    {
                        data: 'action',
                        orderable: false
                    }
                ],
                searchInputSelector: '#search-input', // Search input field
                rowsPerPageDropdownSelector: '#rows-per-page-dropdown', // Rows-per-page dropdown
                columnSelectElement: '#choices-multiple-columns', // Column visibility dropdown

                // Pass filters dynamically
                filters: [{
                        name: 'list_type',
                        selector: '#option-type-dropdown'
                    },
                    {
                        name: 'is_active',
                        selector: '#status-dropdown'
                    },
                    {
                        name: 'query_str',
                        selector: '#search-input'
                    }
                ],

                // Pass dropdowns dynamically
                dropdowns: [{
                        selector: '#status-dropdown'
                    },
                    {
                        selector: '#option-type-dropdown'
                    }
                ],

                // Always visible columns
                alwaysVisibleColumns: [0, 4, 5],
                // Default visible columns
                defaultVisibleColumn: [1],

                // Export table data 
                exportButtonSelector: null, //Export button ID/Class 
                exportEndPoint: null, // Export endpoint
            });
        });
    </script>
@endsection

<div class="offcanvas offcanvas-end offcanvas-size-50" tabindex="-1" id="offcanvasCreate"
    aria-labelledby="offcanvasCreate">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasCreate">{{ isset($blog) ? 'Edit' : 'Create new' }} blog</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        @if (isset($blog))
            {{ html()->form('PATCH', route('blogs.update', $blog->id))->id('blog-form')->open() }}
        @else
            {{ html()->form('POST', route('blogs.store'))->id('blog-form')->open() }}
        @endif
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <div class="form-group">
                        {{ html()->label('Title') }}<span style="color: red;">*</span>
                        {{ html()->input('text', 'title', isset($blog) ? $blog->title : old('title'))->placeholder('Enter title')->class('form-control ' . ($errors->has('title') ? 'is-invalid' : '')) }}
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <div class="form-group">
                        {{ html()->label('Slug') }}<span style="color: red;">*</span>
                        {{ html()->input('text', 'slug', isset($blog) ? $blog->slug : old('slug'))->placeholder('Enter slug')->class('form-control ' . ($errors->has('slug') ? 'is-invalid' : '')) }}
                        @error('slug')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <div class="form-group">
                        {{ html()->label('Description') }}<span style="color: red;">*</span>
                        {{ html()->textarea('description', isset($blog) ? $blog->description : old('description'))->placeholder('Enter description')->rows(4)->class('form-control ' . ($errors->has('description') ? 'is-invalid' : '')) }}

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <div class="form-group">
                        {{ html()->label('Image') }}<span style="color: red;">*</span>
                        {{ html()->input('file', 'file', isset($blog) ? $blog->file : old('file'))->placeholder('Enter file')->class('form-control ' . ($errors->has('file') ? 'is-invalid' : '')) }}
                        @error('file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <div class="form-group">
                        @php
                            use Carbon\Carbon;

                            $blogDate = isset($blog)
                                ? Carbon::parse($blog->blog_date)->format('Y-m-d')
                                : old('blog_date');
                        @endphp

                        {{ html()->label('Blog date') }}<span style="color: red;">*</span>
                        {{ html()->input('date', 'blog_date', $blogDate)->placeholder('Enter blog date')->class('form-control ' . ($errors->has('blog_date') ? 'is-invalid' : '')) }}

                        @error('blog_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <input type="submit" value="Submit" class="btn btn-dark">
            </div>
        </div>
        {{ html()->form()->close() }}
    </div>
</div>
{!! JsValidator::formRequest('App\Http\Requests\BlogRequest', '#blog-form') !!}
<script>
    // Save OR UPDATE DATA
    $('#blog-form').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        var url = $(this).attr('action');
        var method = $(this).attr('method');
        $('#status').show();
        $('#preloader').show();

        // Get the current pagination state from DataTable
        var table = $('#blog-table-data').DataTable();
        var pageInfo = table.page.info();
        var start = pageInfo.start;
        var length = pageInfo.length;

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            processData: false,
            contentType: false,
            type: method,
            data: formData,
            success: function(data) {
                console.log(data);
                $('#status').hide();
                $('#preloader').hide();

                if (!data.error) {
                    // Get the form data as an object
                    var updatedData = Object.fromEntries(formData.entries());

                    // Find the row in the DataTable that matches the updated record ID
                    table.rows().every(function() {
                        var rowData = this.data();
                        if (rowData.id == updatedData.id) {
                            // Update the row data with the updated form data
                            this.data(updatedData);
                        }
                    });

                    table.draw(false); // Redraw the table without resetting pagination

                    toastr.success(data.message);
                    let closeCanvas = document.querySelector('[data-bs-dismiss="offcanvas"]');
                    closeCanvas.click();
                } else {
                    toastr.error(data.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#status').hide();
                $('#preloader').hide();
                toastr.error('Error occurred!');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('input[name="title"]').on('input', function() {
            let title = $(this).val();
            let slug = title
                .toLowerCase() // Convert to lowercase
                .trim() // Remove leading/trailing spaces
                .replace(/[^a-z0-9\s-]/g, '') // Remove special characters
                .replace(/\s+/g, '-') // Replace spaces with hyphens
                .replace(/-+/g, '-'); // Remove consecutive hyphens
            $('input[name="slug"]').val(slug); // Update slug field
        });
    });
</script>

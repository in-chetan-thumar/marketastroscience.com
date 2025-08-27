<div class="offcanvas offcanvas-end offcanvas-size-30" tabindex="-1" id="offcanvasCreate"
    aria-labelledby="offcanvasCreate">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasCreate">{{ isset($permission) ? 'Edit' : 'Create new' }} permission</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @if (isset($permission))
            {{ html()->form('PATCH', route('permission.update', $permission->id))->id('permission-form')->open() }}
        @else
            {{ html()->form('POST', route('permission.store'))->id('permission-form')->open() }}
        @endif
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <div class="form-group">
                        {{ html()->label('Title') }}<span class="required">*</span>
                        {{ html()->input('text', 'title', isset($permission) ? $permission->title : old('title'))->placeholder('Enter title')->class('form-control ' . ($errors->has('title') ? 'is-invalid' : '')) }}
                        @error('title')
                            <span style="color:red">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <div class="form-group">
                        {{ html()->label('Name') }}<span class="required">*</span>
                        {{ html()->input('text', 'name', isset($permission) ? $permission->name : old('name'))->placeholder('Enter name')->class('form-control ' . ($errors->has('name') ? 'is-invalid' : '')) }}
                        @error('name')
                            <span style="color:red">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <div class="form-group">
                        {{ html()->label('Permission label') }}<span class="required">*</span>
                        {{ html()->input('text', 'permission_label', isset($permission) ? $permission->permission_label : old('permission_label'))->placeholder('Enter permission label')->class('form-control ' . ($errors->has('permission_label') ? 'is-invalid' : '')) }}
                        @error('permission_label')
                            <span style="color:red">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    {{ html()->label('Is redirectablel') }}
                    <input type="checkbox" name="is_redirectable" value="Y" class="form-check-input"
                        {{ (isset($permission) and $permission->is_redirectable == 'Y') ? 'checked' : '' }}
                        id="">
                    {{-- {{ html()->checkbox('is_redirectable', 'Y', isset($permission) ? $permission->is_redirectable : old('is_redirectable'))->class('form-check-input ') }} --}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <input type="submit" value="Submit" class="btn btn-primary">
            </div>
        </div>
        {{ html()->form()->close() }}
    </div>
</div>
{!! JsValidator::formRequest('App\Http\Requests\PermissionRequest', '#permission-form') !!}
<script>
    // Save OR UPDATE DATA
    $('#permission-form').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        var url = $(this).attr('action');
        var method = $(this).attr('method');
        $('#status').show();
        $('#preloader').show();

        // Get the current pagination state from DataTable
        var table = $('#permission-table-data').DataTable();
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

<div class="offcanvas offcanvas-end offcanvas-size-30" tabindex="-1" id="offcanvasCreate"
    aria-labelledby="offcanvasCreate">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasCreate">{{ isset($option) ? 'Edit' : 'Create new' }} option</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        @if (isset($option))
            {{ html()->form('PATCH', route('option-list.update', $option->id))->id('option-form')->open() }}
        @else
            {{ html()->form('POST', route('option-list.store'))->id('option-form')->open() }}
        @endif
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <input type="hidden" name="role" value="3">
                    <div class="form-group">
                        {{ html()->label('List type') }}<span style="color: red;">*</span>
                        {{ html()->select('list_type', config('constants.OPTION_LIST_TYPE'), isset($option) ? $option->list_type : old('list_type'))->placeholder('Select list type')->class('form-control form-select' . ($errors->has('list_type') ? 'is-invalid' : '')) }}
                        @error('list_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <input type="hidden" name="role" value="3">
                    <div class="form-group">
                        {{ html()->label('Option value') }}<span style="color: red;">*</span>
                        {{ html()->input('text', 'option_value', isset($option) ? $option->option_value : old('option_value'))->placeholder('Enter value')->class('form-control ' . ($errors->has('option_value') ? 'is-invalid' : '')) }}
                        @error('option_value')
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
                        {{ html()->label('Option title') }}<span style="color: red;">*</span>
                        {{ html()->input('text', 'option_title', isset($option) ? $option->option_title : old('option_title'))->placeholder('Enter title')->class('form-control ' . ($errors->has('option_title') ? 'is-invalid' : '')) }}
                        @error('option_title')
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
                        {{ html()->label('Sort ID') }}<span style="color: red;">*</span>
                        {{ html()->input('text', 'sort_id', isset($option) ? $option->sort_id : old('sort_id'))->placeholder('Enter sort id')->attributes(['oninput' => 'this.value = this.value.replace(/[^0-9]/g, "")'])->class('form-control ' . ($errors->has('sort_id') ? 'is-invalid' : '')) }}
                        @error('sort_id')
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
{!! JsValidator::formRequest('App\Http\Requests\OptionListRequest', '#option-form') !!}
<script>
    // Save OR UPDATE DATA
    $('#option-form').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        var url = $(this).attr('action');
        var method = $(this).attr('method');
        $('#status').show();
        $('#preloader').show();

        // Get the current pagination state from DataTable
        var table = $('#option-table-data').DataTable();
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

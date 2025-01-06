<div class="offcanvas offcanvas-end offcanvas-size-30" tabindex="-1" id="offcanvasCreate"
    aria-labelledby="offcanvasCreate">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasCreate">{{ isset($user) ? 'Edit' : 'Create new' }} user</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        @if (isset($user))
            {{ html()->form('PATCH', route('usermanagements.update', $user->id))->id('user-form')->open() }}
        @else
            {{ html()->form('POST', route('usermanagements.store'))->id('user-form')->open() }}
        @endif
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <div class="form-group">
                        {{ html()->label('Name') }}<span style="color: red;">*</span>
                        {{ html()->input('text', 'name', isset($user) ? $user->name : old('name'))->placeholder('Enter name')->class('form-control ' . ($errors->has('name') ? 'is-invalid' : '')) }}
                        @error('name')
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
                        {{ html()->label('Mobile') }}<span style="color: red;">*</span>
                        {{ html()->input('text', 'mobile', isset($user) ? $user->mobile : old('mobile'))->placeholder('Enter mobile')->attributes(['oninput' => 'this.value = this.value.replace(/[^0-9]/g, "")', 'maxlength' => '10'])->class('form-control ' . ($errors->has('mobile') ? 'is-invalid' : '')) }}
                        @error('mobile')
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
                        {{ html()->label('Email') }}<span style="color: red;">*</span>
                        {{ html()->input('email', 'email', isset($user) ? $user->email : old('email'))->placeholder('Enter email')->class('form-control ' . ($errors->has('email') ? 'is-invalid' : '')) }}
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <div class="form-group">
                        {{ html()->label('Role') }}<span style="color: red;">*</span>
                        {{ html()->select(
                                'role',
                                $roles,
                                (isset($user) and !empty($user->roles()->first())) ? $user->roles()->first()->id : old('role'),
                            )->placeholder('Select role')->class('form-control form-select' . ($errors->has('role') ? 'is-invalid' : '')) }}
                        @error('role')
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
                <input type="submit" value="Submit" class="btn btn-primary">
            </div>
        </div>
        {{ html()->form()->close() }}
    </div>
</div>
{!! JsValidator::formRequest('App\Http\Requests\UserRequest', '#user-form') !!}
<script>
    // Save OR UPDATE DATA
    $('#user-form').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        var url = $(this).attr('action');
        var method = $(this).attr('method');
        $('#status').show();
        $('#preloader').show();

        // Get the current pagination state from DataTable
        var table = $('#user-data').DataTable();
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

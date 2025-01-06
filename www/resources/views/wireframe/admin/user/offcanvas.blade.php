<div class="offcanvas offcanvas-end offcanvas-size-30" tabindex="-1" id="offcanvasCreate"
    aria-labelledby="offcanvasCreate">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasCreate">{{ isset($user) ? 'Edit' : 'Create new' }} user</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        @if (isset($user))
            {!! Form::open([
                'url' => route('wireframe.usermanagements.update', 1),
                'method' => 'PATCH',
                'id' => 'user-form',
                'files' => true,
            ]) !!}
        @else
            {!! Form::open([
                'url' => route('wireframe.usermanagements.store'),
                'method' => 'POST',
                'id' => 'user-form',
                'files' => true,
            ]) !!}
        @endif

        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <div class="form-group">
                        {{ Form::bsText('Name', 'name', isset($user) ? $user['name'] : old('name'), '', ['class' => ''], [], true) }}
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <div class="form-group">
                        {{ Form::bsText('Mobile', 'mobile', isset($user) ? $user['mobile'] : old('mobile'), '', ['class' => ' only-number-allow', 'maxlength' => 10], [], true) }}
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <div class="form-group">
                        {{ Form::bsEmail('Email', 'email', isset($user) ? $user['email'] : old('email'), '', ['class' => ''], [], true) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <div class="form-group">
                        {{ Form::bsSelect('Role', 'role', isset($user) ? $user['role'] : old('role'), '', ['class' => '', 'placeholder' => 'Select'], $roles, true) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
        </form>
    </div>
</div>
{{-- {!! JsValidator::formRequest('App\Http\Requests\UserRequest', '#user-form') !!} --}}
<script>
    // Save OR UPDATE DATA
    $('#user-form').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData($('#user-form')[0]);
        var url = $(this).attr('action');
        var method = $(this).attr('method');

        if ($(this).valid()) {
            $('#status').show();
            $('#preloader').show();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                processData: false,
                contentType: false,
                type: method,
                data: formData,
                success: function(data, textStatus, jqXHR) {
                    if (!data.error) {
                        $('#status').hide();
                        $('#preloader').hide();
                        $(".divtable").html(data.view);
                        toastr.success(data.message);
                        let closeCanvas = document.querySelector('[data-bs-dismiss="offcanvas"]');
                        closeCanvas.click();
                        //location.reload();
                    } else {
                        $('#status').hide();
                        $('#preloader').hide();
                        toastr.error(data.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#status').hide();
                    $('#preloader').hide();
                    toastr.error('Error occurred!');
                }
            });
        }
    })
</script>

@extends('admin.layouts.master')

@section('title')
Email template
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.css" />
@endsection

@section('content')

@component('components.breadcrumb', ['lists' => ['Dashboard' => route('root')]])
@slot('title')
Email template
@endslot
@endcomponent


<div class="row">
    <div class="col-md-3">
        <!-- Left sidebar -->
        <div class="card">
            @if (!empty($emailtemplates->first()))
            <div class="mail-list card-body mt-2">
                @foreach ($emailtemplates as $row)
                <a href="{{ route('email.templates') }}?id={{ $row->id }}"
                    class="{{ $emailtemplate->template_name == $row->template_name ? 'active' : '' }}"><i
                        class="mdi mdi-email-outline"></i>&nbsp;{{ $row->template_name }}</a>
                @endforeach
            </div>
            @endif
        </div>
        <!-- End Left sidebar -->
    </div>
    <div class="col-md-9">
        <!-- Right Sidebar -->
        <div class="mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end">
                        <a href="#" class="btn btn-primary btn-create"><i class="mdi mdi-account-plus"></i>&nbsp;Add
                            email template</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- @can('emailtemplates.create') --}}
                        {{-- {!! Form::open([
                                'url' => route('email.templates.store'),
                                'method' => 'POST',
                                'id' => 'email-template-form',
                                'class' => 'col-md-12',
                                'enctype' => 'multipart/form-data',
                            ]) !!} --}}
                        {{ html()->form('POST', route('email.templates.store'))->id('email-template-form')->class('col-md-12')->attributes(['enctype' => 'multipart/form-data'])->open() }}
                        <input type="hidden" name="id" value="{{ !empty($emailtemplates) ? $emailtemplate->id : '' }}"
                            id="email_template_id">
                        <input type="hidden" name="template_type"
                            value="{{ !empty($emailtemplates) ? $emailtemplate->template_type : '' }}">
                        {{-- @endcan --}}
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="mb-3">
                                <div class="form-group">
                                    {{-- {{ Form::label('Template name') }}<span class="required">*</span>
                                    {!! Form::text('template_name', $emailtemplate->template_name, [
                                    'class' => 'form-control',
                                    'id' => 'template_name',
                                    'placeholder' => 'Template name',
                                    ]) !!} --}}

                                    {{ html()->label('Template name') }}<span class="required">*</span>
                                    {{ html()->input('text', 'template_name', $emailtemplate->template_name)->placeholder('Enter template name')->class('form-control ' . ($errors->has('template_name') ? 'is-invalid' : '')) }}
                                    @error('template_name')
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
                                    {{-- {{ Form::label('Template code') }}<span class="required">*</span>
                                    {!! Form::text('template_code', $emailtemplate->template_code, [
                                    'class' => 'form-control',
                                    'id' => 'template_code',
                                    'placeholder' => 'Template code',
                                    ]) !!} --}}

                                    {{ html()->label('Template code') }}<span class="required">*</span>
                                    {{ html()->input('text', 'template_code', $emailtemplate->template_code)->placeholder('Enter template code')->class('form-control ' . ($errors->has('template_code') ? 'is-invalid' : '')) }}
                                    @error('template_code')
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
                                    {{-- {{ Form::label('Mailable class') }}<span class="required">*</span>
                                    {!! Form::text('mailable', $emailtemplate->mailable, [
                                    'class' => 'form-control',
                                    'id' => 'mailable',
                                    'placeholder' => 'Mailable class',
                                    ]) !!} --}}

                                    {{ html()->label('Mailable class') }}<span class="required">*</span>
                                    {{ html()->input('text', 'mailable', $emailtemplate->mailable)->placeholder('Enter mailable class')->class('form-control ' . ($errors->has('mailable') ? 'is-invalid' : '')) }}
                                    @error('mailable')
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
                                    {{-- {{ Form::label('Subject') }}<span class="required">*</span>
                                    {!! Form::text('subject', $emailtemplate->subject, [
                                    'class' => 'form-control',
                                    'id' => 'subject',
                                    'placeholder' => 'Subject',
                                    ]) !!} --}}

                                    {{ html()->label('Subject') }}<span class="required">*</span>
                                    {{ html()->input('text', 'subject', $emailtemplate->subject)->placeholder('Enter subject')->class('form-control ' . ($errors->has('subject') ? 'is-invalid' : '')) }}
                                    @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- <textarea id="editor"></textarea> -->
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="mb-3">
                                <div class="form-group">

                                    {{ html()->label('Content') }}<span class="required">*</span>
                                    {{ html()->input('textarea', 'email_template_content', $emailtemplate->html_template)->id('email_template_content')->placeholder('Enter content')->class('form-control ' . ($errors->has('email_template_content') ? 'is-invalid' : '')) }}
                                    @error('email_template_content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- @can('emailtemplates.create') --}}
                    <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                        <input type="submit" value="Save" class="btn btn-primary btnSubmit waves-effect waves-light">
                    </div>
                    {{-- @endcan --}}
                    {{ html()->form()->close() }}
                </div>
            </div>

        </div>

    </div>
</div>

</div>
<!-- End row -->
@endsection

@section('script')
{{-- CKEditor CDN --}}

<script src="https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.umd.js"></script>
<script>
const {
    ClassicEditor,
    Essentials,
    Bold,
    Italic,
    Font,
    Paragraph,
    List,
    HorizontalLine,
    SpecialCharacters,
    SpecialCharactersEssentials,
    BlockQuote,
    Link,
    SourceEditing
} = CKEDITOR;

ClassicEditor
    .create(document.querySelector('#email_template_content'), {
        plugins: [Essentials, Bold, Italic, Font, Paragraph, List, HorizontalLine, SpecialCharacters,
            SpecialCharactersEssentials, BlockQuote, Link, SourceEditing
        ],
        toolbar: [
            'undo', 'redo', '|', 'bold', 'italic', '|',
            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
            'bulletedList', 'numberedList', '|',
            'horizontalLine', 'blockQuote', 'link', '|',
            'specialCharacters', 'sourceEditing'
        ]
    })
    .then(editor => {
        editorInstance = editor;
        const existingContent = {
            !!json_encode($emailtemplate - > html_template ?? '') !!
        };
        editor.setData(existingContent);
    })
    .catch(error => {
        console.error(error);
    });
</script>

<script type="text/javascript" src="{{ asset('assets/vendor/jsvalidation/js/jsvalidation.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\EmailTemplateRequest', '#email-template-form') !!}
<script type="text/javascript">
$(".btnSubmit").on('click', function(e) {
    e.preventDefault();
    const editorData = editorInstance.getData();
    document.querySelector('#email_template_content').value = editorData;

    if ($("#email-template-form").valid()) {
        $('#status').show();
        $('#preloader').show();
        $(".btnSubmit").prop('disabled', true);
        $("#email-template-form").submit();
    }
});

$(".btn-create").on('click', function(e) {
    e.preventDefault();

    $('#email_template_id, #subject, #mailable, #template_code, #template_name, #html_template, #email_template_content')
        .val('');

    if (editorInstance) {
        editorInstance.setData('');
    }

});
</script>

@endsection
@extends('admin.layouts.master')
@section('title')
    Form custom field
@endsection
@section('content')
    @component('components.breadcrumb', ['lists' => ['Form custom field' => '']])
        @slot('title')
            Form custom field
        @endslot
    @endcomponent

    <div class="row">
        <div class="mb-3">
            <x-forms.date :name="''" :label="'Date picker'" :value="''" :moreInfo="[]" :errors="$errors"
                :required="false" />
        </div>
        <div class="mb-3">
            <x-forms.input :name="''" :label="'Text box'" :value="''" :moreInfo="[
                'placeholder' => 'Enter here',
            ]" :errors="$errors"
                :required="false" />
        </div>
        <div class="mb-3">
            <x-forms.email :name="''" :label="'Email text box'" :value="''" :moreInfo="[
                'placeholder' => 'Enter here',
            ]" :errors="$errors"
                :required="false" />
        </div>
        <div class="mb-3">
            <x-forms.input :name="''" :label="'Number'" :value="''" :moreInfo="[
                'class' => 'only-number-allow',
                'placeholder' => 'Enter here',
                'maxlength' => '10',
            ]" :errors="$errors"
                :required="false" />
        </div>
        <div class="mb-3">
            <x-forms.file :name="''" :label="'File'" :value="''" :moreInfo="[]" :errors="$errors"
                :required="false" />
        </div>
        <div class="mb-3">
            <x-forms.textarea :name="''" :label="'Text area'" :value="''" :moreInfo="[
                'placeholder' => 'Enter here',
                'rows' => 2,
            ]" :errors="$errors"
                :required="false" />
        </div>
        <div class="mb-3">
            {{ Form::bsCheckBox('Check Box', '', 1, '', ['class' => ''], ['1' => 'One', '2' => 'Two', '3' => 'Three'], false) }}
        </div>
        <div class="mb-3">
            {{ Form::bsRadio('Radio button', 'radio', 1, '', ['class' => ''], ['1' => 'One', '2' => 'Two', '3' => 'Three'], false) }}
        </div>
        <div class="mb-3">
            <x-forms.select :name="''" :label="'Select'" :value="'1'" :moreInfo="[
                'placeholder' => 'Select here',
            ]" :options="['1' => 'One', '2' => 'Two', '3' => 'Three'],"
                :errors="$errors" :required="false" />
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection

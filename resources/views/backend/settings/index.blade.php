@extends('backend.layout.backend')

@section('content')
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend') }}">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item active" aria-current="settings">{{ __('Settings') }}</li>
            </ol>
        </nav>
    </div>
    <div class="row">

        <div class="col-md-12">
            <form class="panel-body" action="/backend/options/store" method="POST">
                @csrf
                @method('post')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="settingTitle">{{ __('Title') }}</label>
                            <input type="text" class="form-control"
                                value="{{ isset($options['setting_title_opt']) ? $options['setting_title_opt'] : '' }}"
                                name="setting_title_opt" id="settingTitle">
                        </div>
                        <div class="form-group">
                            <label for="settingEmail">{{ __('Email') }}</label>
                            <input type="email" class="form-control"
                                value="{{ isset($options['setting_email_opt']) ? $options['setting_email_opt'] : '' }}"
                                name="setting_email_opt" id="settingEmail">
                        </div>
                        <div class="form-group">
                            <label for="settingPhone">{{ __('Phone') }}</label>
                            <input type="text" class="form-control"
                                value="{{ isset($options['setting_phone_opt']) ? $options['setting_phone_opt'] : '' }}"
                                name="setting_phone_opt" id="settingPhone">
                        </div>
                        <div class="form-group">
                            <label for="settingAddress">{{ __('Address') }}</label>
                            <input type="text" class="form-control"
                                value="{{ isset($options['setting_address_opt']) ? $options['setting_address_opt'] : '' }}"
                                name="setting_address_opt" id="settingAddress">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="settingThemeActive">{{ __('Active Theme') }}</label>
                            <input type="text" class="form-control"
                                value="{{ isset($options['setting_theme_active_opt']) ? $options['setting_theme_active_opt'] : '' }}"
                                name="setting_theme_active_opt" id="settingThemeActive">
                        </div>
                        <div class="form-group">
                            <label for="settingHeaderSpinningText">{{ __('Header Spinning Text') }}</label>
                            <textarea class="form-control" name="setting_header_spinning_text_opt" id="settingHeaderSpinningText" cols="5"
                                rows="5">{{ isset($options['setting_header_spinning_text_opt']) ? $options['setting_header_spinning_text_opt'] : '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4>{{ __('Checkout') }}</h4>
                        <div class="form-group">
                            <label for="settingCheckoutInfo">{{ __('Info Title') }}</label>
                            <textarea class="form-control" name="setting_checkout_info_title_opt" id="settingCheckoutInfo" cols="5"
                                rows="5">{{ isset($options['setting_checkout_info_title_opt']) ? $options['setting_checkout_info_title_opt'] : '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4>{{ __('Seo') }}</h4>
                        <div class="form-group">
                            <label for="settingSeoTitle">{{ __('Title') }}</label>
                            <input type="text" class="form-control"
                                value="{{ isset($options['setting_seo_title_opt']) ? $options['setting_seo_title_opt'] : '' }}"
                                name="setting_seo_title_opt" id="settingSeoTitle">
                        </div>
                        <div class="form-group">
                            <label for="settingSeoDescription">{{ __('Description') }}</label>
                            <textarea class="form-control" name="setting_seo_description_opt" id="settingSeoDescription" cols="5"
                                rows="3">{{ isset($options['setting_seo_description_opt']) ? $options['setting_seo_description_opt'] : '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="settingSeoKeywords">{{ __('Keywords') }}</label>
                            <textarea class="form-control" name="setting_seo_keywords_opt" id="settingSeoKeywords" cols="5" rows="3">{{ isset($options['setting_seo_keywords_opt']) ? $options['setting_seo_keywords_opt'] : '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3 text-end">
                        <button class="btn btn-primary">{{ __('Update') }}</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

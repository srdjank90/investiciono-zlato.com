@extends('frontend.themes.mooncart.layout.layout')
@section('title', isset($setting['setting_seo_title_opt']) ? $setting['setting_seo_title_opt'] : 'MinuteSHOP')
@section('description', isset($setting['setting_seo_description_opt']) ? $setting['setting_seo_description_opt'] : '')
@section('keywords', isset($setting['setting_seo_keywords_opt']) ? $setting['setting_seo_keywords_opt'] : '')
@section('content')
    <div class="checkout-area">
        <div class="container" style="min-height: 600px">
            <div class="row" style="min-height: 600px">
                <div class="col-sm-2"></div>
                <div class="col-sm-8 mt-5 mb-5" style="text-align: center">
                    <h3 class="text-center p-5" style="margin-top:80px">Vaša porudžbina je uspešno primljena i biće obrađena
                        u najkraćem mogućem roku</h3>
                    <a href="{{ route('frontend.index') }}" class="check-button">Vrati se na naslovnu stranu</a>
                </div>
            </div>
        </div>
    </div>
@endsection

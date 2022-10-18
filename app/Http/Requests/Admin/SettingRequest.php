<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'site_name_ar' => 'required|string|max:191',
            'site_name_en' => 'required|string|max:191',
            'phone' => 'required|max:191|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
            'email' => 'required|string|email|max:191',
            'logo' => 'nullable|mimes:jpeg,jpg,png',
            'login_pg' => 'nullable|mimes:jpeg,jpg,png',
            'logo_login' => 'nullable|mimes:jpeg,jpg,png',
            'location' => 'nullable|url|max:800',
            'facebook' => 'nullable|url|max:191',
            'twitter' => 'nullable|url|max:191',
            'instagram' => 'nullable|url|max:191',
            'snapchat' => 'nullable|url|max:191',
            'pinterest' => 'nullable|url|max:191',
            'youtube' => 'nullable|url|max:191',
            'telegram' => 'nullable|url|max:191',
            'address_ar' => 'nullable|string|max:191',
            'address_en' => 'nullable|string|max:191',
            'terms_ar'=>'nullable|max:1000',
            'terms_en'=>'nullable|max:1000',
            'privacy_ar'=>'nullable|max:1000',
            'privacy_en'=>'nullable|max:1000',
            'usage_ar'=>'nullable|max:1000',
            'usage_en'=>'nullable|max:1000',
            'about_ar'=>'nullable|max:1000',
            'about_en'=>'nullable|max:1000',
        ];
    }
}

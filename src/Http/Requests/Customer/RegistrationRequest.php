<?php

namespace Webkul\GolobaTheme\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Webkul\Customer\Facades\Captcha;

class RegistrationRequest extends FormRequest
{
    /**
     * Define your rules.
     *
     * @var array
     */
    private $rules = [
        'first_name'      => 'string|required',
        'last_name'       => 'string|required',
        'email'           => 'email|required|unique:customers,email',
        'password'        => 'confirmed|min:6|required',
        'phone'           => 'required|string|max:20|unique:customers,phone',
        'instagram_url'   => 'nullable|string|url|max:255',
        'accept_policy'   => 'accepted',
        'is_adult'        => 'accepted',
    ];

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
        return Captcha::getValidations($this->rules);
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        $captchaMessages = Captcha::getValidationMessages();
        
        $customMessages = [
            'phone.required'          => trans('shop::app.customers.signup-form.phone-required'),
            'phone.max'               => trans('shop::app.customers.signup-form.phone-max'),
            'phone.unique'            => trans('shop::app.customers.signup-form.phone-unique'),
            'instagram_url.url'       => trans('shop::app.customers.signup-form.instagram-url-invalid'),
            'instagram_url.max'       => trans('shop::app.customers.signup-form.instagram-url-max'),
            'accept_policy.accepted'  => trans('shop::app.customers.signup-form.accept-policy-required'),
            'is_adult.accepted'       => trans('shop::app.customers.signup-form.is-adult-required'),
        ];

        return array_merge($captchaMessages, $customMessages);
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        // Log para debug
        \Log::info('VALIDACIÓN FALLÓ en GolobaTheme RegistrationRequest', [
            'errors' => $validator->errors()->toArray(),
            'input_data' => $this->all()
        ]);
        
        // Usar el comportamiento por defecto de Laravel que preserva los datos del formulario
        parent::failedValidation($validator);
    }
}

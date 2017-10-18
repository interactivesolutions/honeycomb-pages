<?php namespace interactivesolutions\honeycombpages\app\validators;


use InteractiveSolutions\HoneycombCore\Http\Controllers\HCCoreFormValidator;

class HCPagesValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            "type" => "required",
        ];
    }
}
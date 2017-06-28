<?php namespace interactivesolutions\honeycombpages\app\validators;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

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
            "categories" => "required",
            "publish_at" => "required",
        ];
    }
}
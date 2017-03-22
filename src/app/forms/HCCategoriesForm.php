<?php

namespace interactivesolutions\honeycombpages\app\forms;

class HCCategoriesForm
{
    // name of the form
    protected $formID = 'categories';

    // is form multi language
    protected $multiLanguage = 1;

    /**
     * Creating form
     *
     * @param bool $edit
     * @return array
     */
    public function createForm(bool $edit = false)
    {
        $form = [
            'storageURL' => route('admin.api.categories'),
            'buttons'    => [
                [
                    "class" => "col-centered",
                    "label" => trans('HCCoreUI::core.button.submit'),
                    "type"  => "submit",
                ],
            ],
            'structure'  => [
                [
    "type"            => "singleLine",
    "fieldID"         => "parent_id",
    "label"           => trans("HCPages::categories.parent_id"),
    "required"        => 0,
    "requiredVisible" => 0,
],[
    "type"            => "singleLine",
    "fieldID"         => "cover_photo_id",
    "label"           => trans("HCPages::categories.cover_photo_id"),
    "required"        => 0,
    "requiredVisible" => 0,
],[
    "type"            => "singleLine",
    "fieldID"         => "title",
    "label"           => trans("HCPages::categories.title"),
    "required"        => 1,
    "requiredVisible" => 1,
    "multiLanguage"   => 1,
],[
    "type"            => "singleLine",
    "fieldID"         => "slug",
    "label"           => trans("HCPages::categories.slug"),
    "required"        => 1,
    "requiredVisible" => 1,
    "multiLanguage"   => 1,
],[
    "type"            => "singleLine",
    "fieldID"         => "content",
    "label"           => trans("HCPages::categories.content"),
    "required"        => 0,
    "requiredVisible" => 0,
    "multiLanguage"   => 1,
],[
    "type"            => "singleLine",
    "fieldID"         => "cover_photo_id",
    "label"           => trans("HCPages::categories.cover_photo_id"),
    "required"        => 0,
    "requiredVisible" => 0,
    "multiLanguage"   => 1,
],
            ],
        ];

        if ($this->multiLanguage)
            $form['availableLanguages'] = getHCContentLanguages()->pluck('id');

        if (!$edit)
            return $form;

        //Make changes to edit form if needed
        // $form['structure'][] = [];

        return $form;
    }
}
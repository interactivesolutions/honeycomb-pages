<?php

namespace interactivesolutions\honeycombpages\app\forms;

class HCPagesForm
{
    // name of the form
    protected $formID = 'pages';

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
            'storageURL' => route('admin.api.pages'),
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
    "fieldID"         => "author_id",
    "label"           => trans("HCPages::pages.author_id"),
    "required"        => 1,
    "requiredVisible" => 1,
],[
    "type"            => "singleLine",
    "fieldID"         => "publish_at",
    "label"           => trans("HCPages::pages.publish_at"),
    "required"        => 1,
    "requiredVisible" => 1,
],[
    "type"            => "singleLine",
    "fieldID"         => "expires_at",
    "label"           => trans("HCPages::pages.expires_at"),
    "required"        => 0,
    "requiredVisible" => 0,
],[
    "type"            => "singleLine",
    "fieldID"         => "cover_photo_id",
    "label"           => trans("HCPages::pages.cover_photo_id"),
    "required"        => 0,
    "requiredVisible" => 0,
],[
    "type"            => "singleLine",
    "fieldID"         => "title",
    "label"           => trans("HCPages::pages.title"),
    "required"        => 1,
    "requiredVisible" => 1,
    "multiLanguage"   => 1,
],[
    "type"            => "singleLine",
    "fieldID"         => "slug",
    "label"           => trans("HCPages::pages.slug"),
    "required"        => 1,
    "requiredVisible" => 1,
    "multiLanguage"   => 1,
],[
    "type"            => "singleLine",
    "fieldID"         => "summary",
    "label"           => trans("HCPages::pages.summary"),
    "required"        => 0,
    "requiredVisible" => 0,
    "multiLanguage"   => 1,
],[
    "type"            => "singleLine",
    "fieldID"         => "content",
    "label"           => trans("HCPages::pages.content"),
    "required"        => 0,
    "requiredVisible" => 0,
    "multiLanguage"   => 1,
],[
    "type"            => "singleLine",
    "fieldID"         => "cover_photo_id",
    "label"           => trans("HCPages::pages.cover_photo_id"),
    "required"        => 0,
    "requiredVisible" => 0,
    "multiLanguage"   => 1,
],[
    "type"            => "singleLine",
    "fieldID"         => "author_id",
    "label"           => trans("HCPages::pages.author_id"),
    "required"        => 0,
    "requiredVisible" => 0,
    "multiLanguage"   => 1,
],[
    "type"            => "singleLine",
    "fieldID"         => "publish_at",
    "label"           => trans("HCPages::pages.publish_at"),
    "required"        => 1,
    "requiredVisible" => 1,
    "multiLanguage"   => 1,
],[
    "type"            => "singleLine",
    "fieldID"         => "expires_at",
    "label"           => trans("HCPages::pages.expires_at"),
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
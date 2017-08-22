<?php

namespace interactivesolutions\honeycombpages\app\forms;

class HCCategoriesForm
{
    // name of the form
    protected $formID = 'pages-categories';

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
                    "label" => trans('HCTranslations::core.buttons.submit'),
                    "type"  => "submit",
                ],
            ],
            'structure'  => [
                [
                    "type"            => "resource",
                    "fieldID"         => "cover_photo_id",
                    "tabID"           => trans("HCTranslations::core.general"),
                    "label"           => trans("HCPages::categories.cover_photo_id"),
                    "uploadURL"       => route("admin.api.resources"),
                    "viewURL"         => route("resource.get", ['/']),
                    "fileCount"       => 1,
                ], [
                    "type"            => "dropDownList",
                    "fieldID"         => "parent_id",
                    "tabID"           => trans("HCTranslations::core.general"),
                    "label"           => trans("HCPages::categories.parent_id"),
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "url"                    => route ('admin.api.categories.list'),
                        "showNodes"              => ["translations.{lang}.title"]
                    ],
                ],  [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.title",
                    "tabID"           => trans("HCTranslations::core.translations"),
                    "label"           => trans("HCPages::categories.title"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "richTextArea",
                    "fieldID"         => "translations.content",
                    "tabID"           => trans("HCTranslations::core.translations"),
                    "label"           => trans("HCPages::categories.content"),
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "resource",
                    "fieldID"         => "translations.cover_photo_id",
                    "tabID"           => trans("HCTranslations::core.translations"),
                    "label"           => trans("HCPages::categories.cover_photo_id"),
                    "uploadURL"       => route("admin.api.resources"),
                    "viewURL"         => route("resource.get", ['/']),
                    "fileCount"       => 1,
                    "multiLanguage"   => 1,
                ],
            ],
        ];

        if ($this->multiLanguage)
            $form['availableLanguages'] = getHCContentLanguages();

        formManagerSeo($form, $this->multiLanguage);

        if (!$edit)
            return $form;

        //Make changes to edit form if needed
        $form['structure'][] = [
            "type"          => "singleLine",
            "fieldID"       => "translations.slug",
            "tabID"         => trans("HCTranslations::core.translations"),
            "label"         => trans("HCPages::categories.slug"),
            "readonly"      => 1,
            "multiLanguage" => 1,
        ];

        return $form;
    }
}
<?php

namespace interactivesolutions\honeycombpages\app\forms;

use interactivesolutions\honeycombacl\app\models\HCUsers;
use interactivesolutions\honeycombacl\app\models\users\HCGroups;
use interactivesolutions\honeycombpages\app\models\HCPagesCategories;

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
                    "label" => trans('HCTranslations::core.buttons.submit'),
                    "type"  => "submit",
                ],
            ],
            'structure'  => [
                [
                    "type"            => "resource",
                    "fieldID"         => "cover_photo_id",
                    "tabID"           => trans("Page"),
                    "uploadURL"       => route("admin.api.resources"),
                    "viewURL"         => route("resource.get", ['/']),
                    "label"           => trans("HCPages::pages.cover_photo_id"),
                    "fileCount"       => 1,
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],[
                    "type"            => "dropDownList",
                    "fieldID"         => "category_id",
                    "tabID"           => trans("Page"),
                    "label"           => trans("HCPages::pages.category"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "options"         => HCPagesCategories::with('translations')->get(),
                    "showNodes"       => ['translations.{lang}.title']
                ], [
                    "type"            => "dateTimePicker",
                    "properties"      => [
                        "format" => "Y-MM-D HH:mm:ss",
                    ],
                    "fieldID"         => "publish_at",
                    "tabID"           => trans("Page"),
                    "label"           => trans("HCPages::pages.publish_at"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                ], [
                    "type"            => "dateTimePicker",
                    "properties"      => [
                        "format" => "Y-MM-D HH:mm:ss",
                    ],
                    "fieldID"         => "expires_at",
                    "tabID"           => trans("Page"),
                    "label"           => trans("HCPages::pages.expires_at"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "resource",
                    "fieldID"         => "translations.cover_photo_id",
                    "tabID"           => trans("HCTranslations::core.translations"),
                    "uploadURL"       => route("admin.api.resources"),
                    "viewURL"         => route("resource.get", ['/']),
                    "label"           => trans("HCPages::pages.cover_photo_id"),
                    "fileCount"       => 1,
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.title",
                    "tabID"           => trans("HCTranslations::core.translations"),
                    "label"           => trans("HCPages::pages.title"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.summary",
                    "tabID"           => trans("HCTranslations::core.translations"),
                    "label"           => trans("HCPages::pages.summary"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "richTextArea",
                    "fieldID"         => "translations.content",
                    "tabID"           => trans("HCTranslations::core.translations"),
                    "label"           => trans("HCPages::pages.content"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "dateTimePicker",
                    "properties"      => [
                        "format" => "Y-MM-D HH:mm:ss",
                    ],
                    "fieldID"         => "translations.publish_at",
                    "tabID"           => trans("HCTranslations::core.translations"),
                    "label"           => trans("HCPages::pages.publish_at"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "dateTimePicker",
                    "properties"      => [
                        "format" => "Y-MM-D HH:mm:ss",
                    ],
                    "fieldID"         => "translations.expires_at",
                    "tabID"           => trans("HCTranslations::core.translations"),
                    "label"           => trans("HCPages::pages.expires_at"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ],
            ],
        ];

        $form['structure'][] = [
            "type"            => "dropDownList",
            "fieldID"         => "userGroups",
            "tabID"           => trans("HCTranslations::core.ownership"),
            "label"           => trans ("HCTranslations::core.groups"),
            "options"         => HCGroups::get(),
            "search"          => [
                "showNodes" => ['label']
            ]
        ];

        $form['structure'][] = [
            "type"            => "dropDownList",
            "fieldID"         => "users",
            "tabID"           => trans("HCTranslations::core.ownership"),
            "label"           => trans ("HCTranslations::core.users"),
            "options"         => HCUsers::get(),
            "search"          => [
                "showNodes" => ['email'],
                "tabs"      => true
            ]
        ];

        if ($this->multiLanguage)
            $form['availableLanguages'] = getHCContentLanguages();

        if (!$edit)
            return $form;

        //Make changes to edit form if needed

        $form['structure'][] = [
            "type"          => "singleLine",
            "fieldID"       => "translations.slug",
            "tabID"         => trans("HCTranslations::core.translations"),
            "label"         => trans("HCPages::pages.slug"),
            "readonly"      => 1,
            "multiLanguage" => 1,
        ];

        return $form;
    }
}
<?php

use LaraSpell\SchemaResolver as BaseSchemaResolver;

class SchemaResolver extends BaseSchemaResolver
{

    protected $availableInputTypes = [
        'text', 
        'textarea',
        'file',
        'image',
        'number',
        'email',
        'select',
        'select-multiple',
        'checkbox',
        'radio',
        'ckeditor',
        'mask',
        'datepicker',
        'datetimepicker',
        'timepicker',
    ];

    protected function resolveFieldInputCkeditor($colName, array $fieldSchema, $tableName)
    {
        data_fill($fieldSchema, 'display', 'html');
        return $fieldSchema;
    }

}

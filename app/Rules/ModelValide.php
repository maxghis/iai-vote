<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ModelValide implements Rule
{
    public $model, $field, $attr;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    
    public function __construct($model, $field, $attr='username')
    {
        $this->model = $model;
        $this->field = $field;
        $this->attr = $attr;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $use = ('\App\Models\\'.$this->model)::where($this->attr, $value)->first();
       
        return $use != null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This '.$this->field.' does not exist.';
    }
}

<?php

namespace App\Rules;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Rule;

class FileValidate implements Rule
{
    public $request, $acceptMime, $status, $maxSize, $name_attr;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Request $request, Array $acceptMime, int $maxSize, string $name_attr)
    {
        $this->request = $request;
        $this->name_attr = $name_attr;
        $this->maxSize = $maxSize;
        $this->acceptMime = $acceptMime;
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
        if ($this->request->hasFile($this->name_attr)) {

                
                       
                 if(!in_array($this->request->file($this->name_attr)->getMimeType(), $this->acceptMime)){
                    $this->status = 'typemime';
                    return in_array($this->request->file($this->name_attr)->getMimeType(), $this->acceptMime);
                 }

                 if($this->request->file($this->name_attr)->getSize() > $this->maxSize){
                    $this->status = 'size';
                    return $this->request->file($this->name_attr)->getSize() < $this->maxSize;
                 }


                
               
                
              
             }

             return is_array($this->acceptMime);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        
        if ($this->status == 'typemime') {
            return 'The Type Of one of your File is not correct';
        }

        if ($this->status == 'size') {
            return 'The size Of one of your File is more than '.$this->maxSize.' ko';
        }
    }
}

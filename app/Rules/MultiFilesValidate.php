<?php

namespace App\Rules;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Rule;

class MultiFilesValidate implements Rule
{
    public $request, $acceptMime, $status, $maxSize, $maxFile;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Request $request, Array $acceptMime, int $maxFile, int $maxSize)
    {
         $this->request = $request;
         $this->maxFile = $maxFile;
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
        
       
        if ($this->request->hasFile('files')) {
    
            if(count($this->request->file('files')) > $this->maxFile){
                $this->status = 'number';
                return count($this->request->file('files')) < $this->maxFile;
             }

                foreach($this->request->file('files') as $key => $file)
                {
                            
                 if(!in_array($file->getMimeType(), $this->acceptMime)){
                    $this->status = 'typemime';
                    return in_array($file->getMimeType(), $this->acceptMime);
                 }

                 if($file->getSize() > $this->maxSize){
                    $this->status = 'size';
                    return $file->getSize() < $this->maxSize;
                 }


                
               
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
        if ($this->status == 'number') {
            return 'The Number Of your Uploaded File is more than '.$this->maxFile;
        }

        if ($this->status == 'typemime') {
            return 'The Type Of one of your File is not correct';
        }

        if ($this->status == 'size') {
            return 'The size Of one of your File is more than '.$this->maxSize.' ko';
        }
    }
}

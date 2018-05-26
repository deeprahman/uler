<?php
namespace classes;
/**
 * Class FileUpload
 * @package classes
 */
class FileUpload
{
    protected $temp_name;
    protected $base_name;
    protected $assign_uniq_name="0";

    // takes the $_FILES['file']
    public function __construct($uploaded_file,bool $uniq_name=false)
    {
        $this->temp_name = $uploaded_file['tmp_name'];
        $this->base_name = $uploaded_file['name'];
        if ($uniq_name){
            $file_extension = pathinfo($this->base_name,PATHINFO_EXTENSION);
            $this->assign_uniq_name = bin2hex(random_bytes(4)).".".$file_extension;
        }
    }

    /**
     * @return string
     */
    public function chkMime():string
    {
        return mime_content_type($this->temp_name);
    }

    /**
     * @param string $dir_path
     * @return bool
     */
    public function moveFile(string $dir_path):bool
    {
        if (!$this->assign_uniq_name){
            $target_location = $dir_path."/".$this->base_name;
            return move_uploaded_file($this->temp_name,$target_location);
        }
        $target_location = $dir_path."/".$this->assign_uniq_name;
        return move_uploaded_file($this->temp_name,$target_location);
    }
}
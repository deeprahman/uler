<?php

namespace classes;
/**
 * Class FileUpload
 * @package classes
 */
class FileUpload
{
    protected $temporaryName;
    protected $baseName;
    protected $presentName = "0";

    /**
     * FileUpload constructor.
     * @param array $uploaded_file
     * @param bool $uniq_name : assign unique name before completion of upload
     * @throws \Exception
     */
    public function __construct(array &$uploaded_file, bool $uniq_name = false)
    {
        $this->temporaryName =& $uploaded_file['tmp_name'];
        $this->baseName =& $uploaded_file['name'];
        if ($uniq_name) {
            $file_extension = pathinfo($this->baseName, PATHINFO_EXTENSION);
            $this->presentName = $_SESSION['id'] . "_" . bin2hex(random_bytes(12)) . "." . $file_extension;
        }
    }


    /**
     * @param string $dir_path
     * @return bool
     */
    public function moveFile(string $dir_path): bool
    {
        if (!$this->presentName) {
            $target_location = $dir_path . "/" . $this->baseName;
            return move_uploaded_file($this->temporaryName, $target_location);
        }
        $target_location = $dir_path . "/" . $this->presentName;
        return move_uploaded_file($this->temporaryName, $target_location);
    }

    /**
     * Get the names of the uploaded file
     * @return array
     */
    public function getNames(): array
    {
        return array(
            "base" => $this->baseName,
            "presentName" => $this->presentName);
    }

}
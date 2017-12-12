<?php
namespace MVC\Lib;


class FileUpload
{
    private $name;
    private $type;
    private $size;
    private $error;
    private $tmpPath;

    private $fileExtension;

    private $allowedExtensions = [
        'jpg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls'
    ];

    public function __construct(array $file)
    {
        $this->name = $this->name($file['name']);
        $this->type = $file['type'];
        $this->size = $file['size'];
        $this->error = $file['error'];
        $this->tmpPath = $file['tmp_name'];
    }

    private function name($name)
    {

        preg_match_all('/([a-z]{1,4})$/i', $name, $m);
        $this->fileExtension = strtolower($m[0][0]);

        $name=substr(strtolower(base64_encode($name . APP_SALT)), 0, 30);
        $name= preg_replace('/(\w{6})/i', '$1_', $name);
        $name = rtrim($name,'_');


        return $name;

    }

    private function isAllowedType()
    {
        return in_array($this->fileExtension, $this->allowedExtensions);
    }

    private function isSizeNotAcceptable()
    {
        preg_match_all('/(\d+)([MG])$/i', MAX_FILE_SIZE_ALLOWED, $matches);
        $maxFileSizeToUpload = $matches[1][0];
        $sizeUnit = $matches[2][0];
        $currentFileSize = ($sizeUnit == 'M') ? ($this->size / 1024 / 1024) : ($this->size / 1024 / 1024 / 1024);
        $currentFileSize = ceil($currentFileSize);


        return(int) $currentFileSize > (int) $maxFileSizeToUpload;
    }

    private function isImage()
    {
        return preg_match('/image/i', $this->type);
    }

    public function getFileName()
    {
        return $this->name . '.' . $this->fileExtension;
    }

    public function upload($nameFolder)
    {
        if($this->error != 0) {
            throw new \Exception ('Sorry file didn\'t upload successfully', E_USER_WARNING);
        } elseif(!$this->isAllowedType()) {
            throw new \Exception('Sorry files of type ' . $this->fileExtension .  ' are not allowed', E_USER_WARNING);
        } elseif ($this->isSizeNotAcceptable()) {
            throw new \Exception ('Sorry the file size exceeds the maximum allowed size', E_USER_WARNING);
        } else {
            $storageFolder = $this->isImage() ? $nameFolder : DOCUMENTS_UPLOAD_STORAGE;

            if(is_writable($storageFolder)) {

               move_uploaded_file($this->tmpPath, $storageFolder . DS . $this->getFileName());

            } else {

                throw new \Exception ('Sorry the destination filder is not writable');
            }


        }
        return $this;

    }




}
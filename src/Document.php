<?php
    class Document {
        private $file_name;
        private $file_size;
        private $file_type;
        private $file_tmp;
        private $postTitle;
        private $eduLevel;
        private $subject;
        
        public $userName;

        public function __construct($filename,$filesize,$filetype,$filetmp,$user){
            $this->file_name = $filename;
            $this->file_size = $filesize;
            $this->file_type = $filetype;
            $this->file_tmp = $filetmp;
            $this->userName = $user;
        }

        public function getFileTmp(){
            return $this->file_tmp;
        }

        public function getFileName(){
            return $this->file_name;
        }

        public function getDocumentOwner(){
            return $this->userName;
        }
    }
       
?>
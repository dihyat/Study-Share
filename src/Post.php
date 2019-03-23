<?php
    class Post{
        private $postID;
        private $ownerID;
        private $title;
        private $subject;
        private $educationLevel;

        public function __construct($postid,$ownerid){
            $this->postID = $postid;
            $this->ownerID = $ownerid;
        }

        public function setTitle($value){
            $this->title = $value;
        }

        public function getPostID(){
            return $this->postID;
        }

        public function setSubject($value){
            $this->subject = $value;
        }

        public function setEducationLevel($value){
            $this->educationLevel = $value;
        }

    }
?>
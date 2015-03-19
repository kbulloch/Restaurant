<?php

    class Review
    {
        private $user;
        private $stars;
        private $text;
        private $rest_id;
        private $id;

        function __construct($user, $stars, $text, $rest_id, $id = null)
        {
            $this->user = $user;
            $this->stars = $stars;
            $this->text = $text;
            $this->rest_id = $rest_id;
            $this->id = $id;
        }

        function setUser()
        {
            $this->user = (string) $user;
        }

        function getUser()
        {
            return $this->user;
        }

        function setStars()
        {
            $this->stars = (string) $stars;//string or int or whaaa?
        }

        function getStars()
        {
            return $this->stars;
        }

        function setText()
        {
            $this->text = (string) $text;
        }

        function getText()
        {
            return $this->text;
        }

        function setRestId()
        {
            $this->rest_id = (int) $rest_id;
        }

        function getRestId()
        {
            return $this->rest_id;
        }
        function setId()
        {
            $this->id = (int) $id;
        }

        function getId()
        {
            return $this->id;
        }

        




    }

?>

<?php

    class Review
    {
        private $user;
        private $stars;
        private $body;
        private $rest_id;
        private $id;

        function __construct($user, $stars, $body, $rest_id, $id = null)
        {
            $this->user = $user;
            $this->stars = $stars;
            $this->body = $body;
            $this->rest_id = $rest_id;
            $this->id = $id;
        }

        function setUser($new_user)
        {
            $this->user = (string) $new_user;
        }

        function getUser()
        {
            return $this->user;
        }

        function setStars()
        {
            $this->stars = (int) $stars;//string or int or whaaa?
        }
        function getStars()
        {
            return $this->stars;
        }

        function setBody($new_body)
        {
            $this->body = (string) $new_body;
        }
        function getBody()
        {
            return $this->body;
        }

        function setRestId($new_rest_id)
        {
            $this->rest_id = (int) $new_rest_id;
        }
        function getRestId()
        {
            return $this->rest_id;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }
        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO reviews (user, stars, body, rest_id) VALUES ('{$this->getUser()}', {$this->getStars()}, '{$this->getBody}', {$this->getRestId()});");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }




    }

?>

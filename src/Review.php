<?php

    class Review
    {
        private $username;
        private $stars;
        private $body;
        private $rest_id;
        private $cuisine_id;
        private $id;

        function __construct($username, $stars, $body, $rest_id, $cuisine_id, $id = null)
        {
            $this->username = $username;
            $this->stars = $stars;
            $this->body = $body;
            $this->rest_id = $rest_id;
            $this->cuisine_id = $cuisine_id;
            $this->id = $id;
        }

        function setUsername($new_username)
        {
            $this->username = (string) $new_username;
        }

        function getUsername()
        {
            return $this->username;
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

        function setCuisineId($new_cuisine_id)
        {
            $this->cuisine_id = (int) $new_cuisine_id;
        }
        function getCuisineId()
        {
            return $this->cuisine_id;
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
            $statement = $GLOBALS['DB']->query("INSERT INTO reviews (username, stars, body, rest_id, cuisine_id) VALUES ('{$this->getUsername()}', {$this->getStars()}, '{$this->getBody()}', {$this->getRestId()}, {$this->getCuisineId()}) RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function getAll()
        {
            $returned_reviews = $GLOBALS['DB']->query("SELECT * FROM reviews;");
            $reviews = array();
            foreach($returned_reviews as $review) {
                $username = $review['username'];
                $stars = $review['stars'];
                $body = $review['body'];
                $rest_id = $review['rest_id'];
                $cuisine_id = $review['cuisine_id'];
                $id = $review['id'];
                $new_review = new Review($username, $stars, $body, $rest_id, $cuisine_id, $id);
                array_push($reviews, $new_review);
            }
            return $reviews;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM reviews *;");
        }

        // INSERT INTO reviews (username, stars, body, rest_id, cuisine_id) VALUES ('BOB', 5, 'GREAT', 434, 587) RETURNING id;

    }

?>

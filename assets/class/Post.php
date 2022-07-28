<?php

class Post
{
    protected $id_post;
    protected $fk_id_user;
    protected $title_post;
    protected $description_post;
    protected $views_post;
    protected $image_post;
    protected $body_post;
    protected $is_post_published;
    protected $created_at;
    protected $updated_at;

    public function __construct($id,$fk_id,$title,$desc,$views,$image,$body,$postedYesNo,$creatAt)
    {
        $this->id_post = $id;
        $this->fk_id_user = $fk_id;
        $this->title_post = $title;
        $this->description_post = $desc;
        $this->views_post = $views;
        $this->image_post = $image;
        $this->body_post = $body;
        $this->is_post_published = $postedYesNo;
        $this->created_at = $creatAt;
    }

    public function getid_post()
    {
        return $this->id_post;
    }

    public function setid_post($arg)
    {
        $this->id_post = $arg;
    }
    public function getfk_id_user()
    {
        return $this->fk_id_user;
    }

    public function setfk_id_user($arg)
    {
        $this->fk_id_user = $arg;
    }

    public function gettitle_post()
    {
        return $this->title_post;
    }

    public function settitle_post($arg)
    {
        $this->title_post = $arg;
    }
    public function getdescription_post()
    {
        return $this->description_post;
    }

    public function setdescription_post($arg)
    {
        $this->description_post = $arg;
    }
    public function getviews_post()
    {
        return $this->views_post;
    }

    public function setviews_post($arg)
    {
        $this->views_post = $arg;
    }
    public function getimage_post()
    {
        return $this->image_post;
    }

    public function setimage_post($arg)
    {
        $this->image_post = $arg;
    }
    public function getbody_post()
    {
        return $this->body_post;
    }

    public function setbody_post($arg)
    {
        $this->body_post = $arg;
    }

    public function getis_post_published()
    {
        return $this->is_post_published;
    }

    public function setis_post_published($arg)
    {
        $this->is_post_published = $arg;
    }

    public function getcreated_at()
    {
        return $this->created_at;
    }
    public function setcreated_at($arg)
    {
        $this->created_at = $arg;
    }

    public function getupdated_at()
    {
        return $this->updated_at;
    }

    public function setupdated_at($arg)
    {
        $this->updated_at = $arg;
    }

    public function showDescriptionPost($prenomAuteur, $nomAuteur)
    {
        require __DIR__ . '/../template/post_card_description.php';
    }

    public function showDetailsPost($prenomAuteur, $nomAuteur)
    {
        require __DIR__ . '/../template/post_all_details.php';
    }
}
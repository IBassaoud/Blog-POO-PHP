<?php

class Post
{
    protected $id_post;
    protected $fk_id_user;
    protected $title_post;
    protected $views_post;
    protected $image_post;
    protected $body_post;
    protected $is_post_published;
    protected $created_at;
    protected $updated_at;

    public function __construct($id,$fk_id,$title,$views,$image,$body,$postedYesNo,$creatAt,$updtAt)
    {
        $this->id_post = $id;
        $this->fk_id_user = $fk_id;
        $this->title_post = $title;
        $this->views_post = $views;
        $this->image_post = $image;
        $this->body_post = $body;
        $this->is_post_published = $postedYesNo;
        $this->created_at = $creatAt;
        $this->updated_at = $updtAt;
    }

    
}
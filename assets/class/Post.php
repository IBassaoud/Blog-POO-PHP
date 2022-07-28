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
        echo '      <!-- card -->
        <div v-for="card in cards" class="flex flex-col md:flex-row overflow-hidden bg-white rounded-lg shadow-xl  mt-4 w-100 mx-2">
          <!-- media -->
          <div class="h-64 w-auto md:w-1/2">
            <img class="inset-0 h-full w-full object-cover object-center" src="'.$this->getimage_post().'" />
          </div>
          <!-- content -->
          <div class="w-full py-4 px-6 text-gray-800 flex flex-col justify-between">
            <form method="post" action="assets/php/detail_post.php" id="form-title-click">
            <button id="title-click" name="id_post" value="'.$this->getid_post().'" class="font-semibold text-lg leading-tight truncate">'.$this->gettitle_post().'</button>
            </form>
            <p class="mt-2">
              '.$this->getdescription_post().'
            </p>
            <p class="text-sm text-gray-700 uppercase tracking-wide font-semibold mt-2">
            Postée le '.$this->getcreated_at().' par '.$prenomAuteur.' '.$nomAuteur.'          
            </p>
          </div>
        </div>
        ';

    }

    public function showDetailsPost($prenomAuteur, $nomAuteur)
    {
        echo '<div class="pt-6 pb-6 bg-gray-300">  
        <h2 class="text-center font-serif  uppercase text-4xl xl:text-5xl">'.$this->title_post.'</h2>
        </div>
        <!-- container-->
        <div class="container w-100 lg:w-4/5 mx-auto flex">
          <div class="py-16 bg-white">  
            <div class="container m-auto px-6 text-gray-600 md:px-12 xl:px-6">
                <div class="space-y-6 md:space-y-0 md:flex md:gap-6 lg:items-center lg:gap-12">
                  <div class="md:5/12 lg:w-5/12">
                    <img src="'.$this->image_post.'" alt="image" loading="lazy" width="" height="">
                  </div>
                  <div class="md:7/12 lg:w-6/12">
                    <h2 class="text-1xl text-gray-900 font-bold md:text-1xl">
                       Postée par : '. $prenomAuteur .' '. $nomAuteur.'
                      <br>Le '. $this->created_at .'
                      
                    </h2>
                    <p class="mt-6 text-gray-600">'.
                       $this->description_post.' 
                    </p>
                    <p class="mt-4 text-gray-600">'.
                     '<u class="text-1xl font-bold">Synopsis</u>  : <br>' .
                    $this->body_post.' 
                  </p>
                  </div>
                </div>
            </div>
          </div>
        </div>';
    }
}
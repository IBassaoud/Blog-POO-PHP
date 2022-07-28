<?php

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

?>
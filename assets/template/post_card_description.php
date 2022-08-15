<?php

echo '      <!-- card -->
<div v-for="card in cards" class="flex flex-col md:flex-row overflow-hidden bg-white rounded-lg shadow-xl  mt-4 w-100 mx-2">
  <!-- media -->
  <div class="h-64 w-auto md:w-1/2">
    <img class="inset-0 h-full w-full object-cover object-center" src="'.$this->getimage_post().'" />
  </div>
  <!-- content -->
  <div class="w-full py-4 px-6 text-gray-800 flex flex-col justify-between">
    <form method="post" action="http://localhost:8006/assets/php/detail_post.php" id="form-title-click">
    <button id="title-click" name="id_post" value="'.$this->getid_post().'" class="font-semibold text-lg leading-tight truncate">'.$this->gettitle_post().'</button>
    </form>
    <p class="mt-2">
      '.$this->getdescription_post().'
    </p>
    <p class="text-sm text-gray-700 uppercase tracking-wide font-semibold mt-2">
    Publié le '.$this->getcreated_at().' par '.$prenomAuteur.' '.$nomAuteur.'          
    </p>
  </div>
</div>
';

?>
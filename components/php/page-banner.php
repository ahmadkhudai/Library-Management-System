<?php
function createPageBanner($bannerTitle)
{
  return
    '
  <div id="page-banner">
  <div class="col-12 col-lg-8 p-3 text-center mx-auto">
    
    <h1 class="">' . $bannerTitle . '</h1>
  </div>
</div>

  ';
}

<?php $this->load->view("partial/header"); ?>

    <style type="text/css">

        .fb_iframe_widget, .fb_iframe_widget span, .fb_iframe_widget span iframe[style] {
        width: 100% !important;
        }
        #likebox-wrapper * {
           width: 100% !important;
        }

        #likebox-wrapper * {
              width: 100% !important;
              background: url('../images/block.png') repeat 0 0;
              color: #fbfbfb;
             -webkit-border-radius: 7px;
              -moz-border-radius: 7px;
               -o-border-radius: 7px;
              border-radius: 7px;
               border: 1px solid #DDD;
        }
    </style>





<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<div class="fb-page" data-href="https://www.facebook.com/facebook/?fref=ts" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/facebook/?fref=ts" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook/?fref=ts">Facebook</a></blockquote></div>










<div class="col-md-12 col-sm-12 col-xs-12">

    <div id="likebox-wrapper">
        <!-- <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Ffacebook%2F%3Ffref%3Dts&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe> -->
        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Ffacebook%2F%3Ffref%3Dts&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" 
        scrolling="no" frameborder="0" 
        style="border:none; overflow:hidden; width:100%; overflow: auto" allowTransparency="true">
</iframe>
    </div>

</div>


<?php $this->load->view('partial/footer'); ?>
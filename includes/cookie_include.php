<script>

// Function to check if a cookie exists
    function checkCookie(cookieName) {
      var cookies = document.cookie.split(';');
      for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].trim();
        if (cookie.indexOf(cookieName + '=') === 0) {
          return true;
        }
      }
      return false;
    }

 

    // Check if 'simple-cookie' is present
    if (checkCookie('simple-cookie')) {
    }else{
    document.write(`
<div class="modal fade show" id="CookieModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="padding-right: 17px; display: block; align-items: center; justify-content: center;" data-backdrop="static" aria-modal="true">
<div role="document" class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Your Cookie Settings</h5>
</div>
<div class="modal-body">
                By using our site you consent to cookies. Please choose whether you would like to accept or decline our additional cookies. To find out more, view our
<a href="https://3bdatasecurity.com/cookiepolicy.php" target="_blank">Our Cookie Policy</a>
<div id="simple-cookies" class="simple-cookies bottom light active" style="display:none;">
<div class="simple-cookies-wrapper">
<div class="simple-cookie-content">
</div>
</div>
</div>
</div>
<div class="modal-footer">
<div class="simple-cookie-buttons">        
<button type="button" class="btn btn-secondary tap decline js-close" data-dismiss="modal" style="background-color: #d5cece;border-color: #d5cece;">Decline</button>
<button type="button" class="btn btn-primary tap allow js-close" style="background-color: #6DDD20;border-color: #6DDD20;">Accept</button>
</div>
</div>
</div>
</div>
</div>
      `);
    }

</script>
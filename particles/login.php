<?php
echo '

<!-- Modal -->
<div class="modal fade" id="loginModel" tabindex="-1" aria-labelledby="loginModelLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="loginModelLabel">Login to MindQuest|Forum</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <form method="post" action="/MindQuest/particles/handleLogin.php">

        <div class="mb-3">
          <label for="inputEmail" class="form-label">Email address</label>
          <input type="email" name="inputEmail" class="form-control" id="in" aria-describedby="emailHelp" >
          <div id="emailHelp" class="form-text">We\'ll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
          <label for="inputPassword" class="form-label">Password</label>
          <input type="password" name="inputPassword" class="form-control" id="inputPassword">
        </div>
        
        <button type="submit" class="btn btn-primary">Login</button>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    ';

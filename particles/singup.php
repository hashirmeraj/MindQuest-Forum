<?php
echo '

<!-- Modal -->
<div class="modal fade" id="singupModel" tabindex="-1" aria-labelledby="singupModelLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="singupModelLabel">Singup to MindQuest|Forum</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form method="post" action="/MindQuest/particles/handleSingup.php">
              <div class="mb-3">
                <label for="userName" class="form-label">User Name</label>
                <input type="text" name="userName" class="form-control" id="userName" aria-describedby="userName">
              </div>
              <div class="mb-3">
                <label for="singupEmail" class="form-label">Email address</label>
                <input type="email" name="singupEmail" class="form-control" id="singupEmail" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="singupPassword" class="form-label">Password</label>
                <input type="password" name="singupPassword" class="form-control" id="singupPassword">
              </div>
              <div class="mb-3">
                <label for="confirmedPassword" class="form-label">Confirm Password</label>
                <input type="password" name="confirmedPassword" class="form-control" id="confirmedPassword">
              </div>
              <button type="submit" class="btn btn-primary">Singup</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    ';

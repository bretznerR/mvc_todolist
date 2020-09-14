<div class="card">
  <div class="card-header">
    <h1>User Login</h1>
    <p class="card-text">Register if you don't have account already.</p>
    <a class="btn btn-outline-dark" href="<?php echo ROOT_PATH; ?>users/register">Register</a>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col">
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">

      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email" aria-describedby="" placeholder="Email" value="<?php echo Helper::get('email'); ?>">
        <p class="text-danger"><?php if(isset($data['errors']['email'])){ echo $data['errors']['email']; } ?></p>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" aria-describedby="" placeholder="Password">
        <p class="text-danger"><?php if(isset($data['errors']['password '])){ echo $data['errors']['password ']; } ?></p>
      </div>
      
      <input type="submit" class="btn btn-primary" name="login" value="Login">
    </form>
    </div>
  </div>
</div>
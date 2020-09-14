<div class="card">
  <div class="card-header">
    <h1>Inscription</h1>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col">
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">

      <div class="form-group">
        <label for="firstname">Prénom</label>
        <input type="text" class="form-control" id="firstname" name="firstname" aria-describedby="" placeholder="Votre prénom" value="<?php echo Helper::get('firstname'); ?>">
        <p class="text-danger"><?php if(isset($data['errors']['firstname'])){ echo $data['errors']['firstname']; } ?></p>
      </div>

      <div class="form-group">
        <label for="lastname">Nom de famille</label>
        <input type="text" class="form-control" id="lastname" name="lastname" aria-describedby="" placeholder="Votre nom de famille" value="<?php echo Helper::get('lastname'); ?>">
        <p class="text-danger"><?php if(isset($data['errors']['lastname'])){ echo $data['errors']['lastname']; } ?></p>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email" aria-describedby="" placeholder="Email" value="<?php echo Helper::get('email'); ?>">
        <p class="text-danger"><?php if(isset($data['errors']['email'])){ echo $data['errors']['email']; } ?></p>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" aria-describedby="" placeholder="Mot de passe">
        <p class="text-danger"><?php if(isset($data['errors']['password'])){ echo $data['errors']['password']; } ?></p>
      </div>
      
      <input type="submit" class="btn btn-primary" name="register" value="S'inscrire">
    </form>
    </div>
  </div>
</div>
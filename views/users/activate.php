
<div class="container-fluid jumbotron">          
    <p>Poslali smo vam link za aktivaciju racuna na vasu email adresu ili unesite kod u polje za aktivaciju.</p> 
</div>         
<div class="container">
  <div class="row">
   <h2>Aktiviraj se</h2> 
  </div>    
	<div class="row">    		
      <form method="post">
        <fieldset class="form-group">
          <label for="active">Kod za aktivaciju</label>
          <input type="text" class="form-control" id="active" name="activation-code" placeholder="Unesi kod za aktivaciju">
        </fieldset>
        <input type="" name="id" value="<?php echo $_SESSION['id']; ?>" >
        <input class="btn btn-primary" type="submit" name="activate" value="Aktiviraj se" >
      </form>
	</div>
</div>
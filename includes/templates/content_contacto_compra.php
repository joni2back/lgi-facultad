<div class="container ">
    <div class="well">

        <ul class="breadcrumb well">
            <li><a href="index.php">Principal</a> <span class="divider">/</span></li>
            <li class="active">Contacto por compra</li>
        </ul>

        <h1>Contacto por compra</h1>
		<div class="row">
			<div class="span5">
				<img src="http://t31m02.labs.escuelaurquiza.edu.ar/images/piso-mini.jpg" alt="" style="width:100%"/>
			</div>
			<div class="span5">
				<form>
				  <fieldset>
					<legend>Item: <?php echo htmlentities($_GET['articulo']); ?></legend>
					<label>Nombre</label>
					<input type="text" placeholder="Ingrese su nombre...">
					<label>Email</label>
					<input type="text" placeholder="Ingrese su email...">
					<label>Telefono</label>
					<input type="text" placeholder="Ingrese su telefono...">
					<label>Mensaje</label>
					<textarea rows="3"></textarea>

					<label class="radio">
					  <input type="radio" name="contact_type" checked="checked" disabled="disabled"> Contacto por compra
					</label>
					<button type="submit" class="btn">Enviar consulta</button>
				  </fieldset>
				</form>
			</div>
		</div>

    </div><!-- /.row -->
</div><!-- /.container -->


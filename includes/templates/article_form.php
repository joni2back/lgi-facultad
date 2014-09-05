<fieldset>
  <div>
      <label>Titulo</label>
      <input type="text" name="title" placeholder="Ingrese el titulo..." class="span12" value="<?php echo $title; ?>" />
      <div class="alert alert-error hide"></div>
  </div>

  <div>
      <label>Descripcion</label>
      <textarea rows="3" cols="10" name="description" placeholder="Ingrese el contenido..." class="span12"><?php echo $description; ?></textarea>
      <div class="alert alert-error hide"></div>
  </div>

  <div class="row-fluid">
      <div class="span6">
          <label>Categoria</label>
          <select name="id_article_category" class="span12">
              <option value="">Seleccione la categoria...</option>
              <?php foreach($app->getArticleCategories() as $category) { ?>
                  <option <?php echo $category->id == $id_article_category ? 'selected="selected"':''; ?> value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
              <?php } ?>
          </select>
          <div class="alert alert-error hide"></div>
      </div>

      <div class="span6">
          <label>Tipo</label>
          <select name="id_article_type" class="span12">
              <option value="">Seleccione el tipo...</option>
              <?php foreach($app->getArticleTypes() as $type) { ?>
                  <option <?php echo $type->id == $id_article_type ? 'selected="selected"':''; ?> value="<?php echo $type->id; ?>"><?php echo $type->name; ?></option>
              <?php } ?>
          </select>
          <div class="alert alert-error hide"></div>
      </div>
  </div>

  <div class="row-fluid">
      <div class="span4">
          <label>Localidad</label>
          <input type="text" name="location" placeholder="Ingrese la localidad..." class="span12" value="<?php echo $location; ?>"/>
          <div class="alert alert-error hide"></div>
      </div>

      <div class="span4">
          <label>Direccion</label>
          <input type="text" name="address" placeholder="Ingrese el telefono..." class="span12" value="<?php echo $address; ?>"/>
          <div class="alert alert-error hide"></div>
      </div>

      <div class="span4">
          <label>Precio</label>
          <input type="text" name="price" placeholder="Ingrese el precio..." class="span12" value="<?php echo $price; ?>"/>
          <div class="alert alert-error hide"></div>
      </div>
  </div>
</fieldset>
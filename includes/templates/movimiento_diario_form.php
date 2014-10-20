<fieldset>
  <div class="row-fluid">
      <div class="span4">
          <label>Usuario</label>
          <select name="id_user" class="span12">
              <option value="">Seleccione el usuario...</option>
              <?php foreach($app->getUsers() as $user) { ?>
                  <option <?php echo $user->id_user == $id_user ? 'selected="selected"':''; ?> value="<?php echo $user->id_user; ?>"><?php echo $user->first_name; ?> <?php echo $user->last_name; ?></option>
              <?php } ?>
          </select>
          <div class="alert alert-error hide"></div>
      </div>
      <div class="span4">
          <label>Concepto</label>
          <select name="id_concepto" class="span12">
              <option value="">Seleccione el concepto...</option>
              <?php foreach($app->getConceptos() as $concepto) { ?>
                  <option <?php echo $concepto->id_concepto == $id_concepto ? 'selected="selected"':''; ?> value="<?php echo $concepto->id_concepto; ?>"><?php echo $concepto->tipos_movimientos; ?> - <?php echo $concepto->detalle; ?></option>
              <?php } ?>
          </select>
          <div class="alert alert-error hide"></div>
      </div>

      <div class="span4">
          <label>Forma de pago</label>
          <select name="id_forma_pago" class="span12">
              <option value="">Seleccione la forma de pago...</option>
              <?php foreach($app->getFormasPago() as $formaPago) { ?>
                  <option <?php echo $formaPago->id_forma_pago == $id_forma_pago ? 'selected="selected"':''; ?> value="<?php echo $formaPago->id_forma_pago; ?>"><?php echo $formaPago->detalle; ?></option>
              <?php } ?>
          </select>
          <div class="alert alert-error hide"></div>
      </div>
  </div>

  <div class="row-fluid">
      <div class="span4">
          <label>Fecha</label>
          <input type="date" name="fecha" placeholder="Ingrese la fecha..." class="span12" value="<?php echo $fecha; ?>"/>
          <div class="alert alert-error hide"></div>
      </div>

      <div class="span4">
          <label>Tipo de movimiento</label>
          <label class="radio inline"><input type="radio" name="type" class="" value="debe"/> Debe (resta)</label>
          <label class="radio inline"><input type="radio" name="type" class="" value="haber"/> Haber (suma)</label>
          <label class="checkbox "><input type="checkbox" name="iva" value="<?php echo APP_MOVIMIENTOS_IVA; ?>"/> Aplica IVA (Monto +<?php echo APP_MOVIMIENTOS_IVA; ?>%)</label>
          <div class="alert alert-error hide"></div>
      </div>

      <div class="span4">
          <div id="debe">
            <label>Debe (decimales separados por puntos)</label>
            <input type="number" step="any" name="debe" placeholder="Ingrese la deuda..." class="span12" value="<?php echo $debe; ?>"/>
            <div class="alert alert-error hide"></div>
          </div>
          <div id="haber">
            <label>Haber (decimales separados por puntos)</label>
            <input type="text" name="haber" placeholder="Ingrese el haber..." class="span12" value="<?php echo $haber; ?>"/>
            <div class="alert alert-error hide"></div>
          </div>
      </div>
  </div>

  <div class="row-fluid">
      <div class="span12">
          <label>Descripcion</label>
          <textarea name="descripcion" placeholder="Ingrese la descripcion..." class="span12"><?php echo $descripcion; ?></textarea>
          <div class="alert alert-error hide"></div>
      </div>


  </div>

    <div class="pull-right">
        <h3>Total: $<span id="total-final">0</span></h3>
    </div>
</fieldset>

<script>
    $(document).ready(function() {
        $('#debe, #haber').hide(0);
        $('input[name="type"]').on('change', function() {
            $('#total-final').html(0);
            if ($(this).val() === 'debe') {
                $('#haber').hide().find('input').val(0);
                $('#debe').show();
            } else {
                $('#debe').hide().find('input').val(0);
                $('#haber').show();
            }
        });

        var callback = function() {
            var total = 0 + parseInt($('input[name="debe"]').val()) + parseInt($('input[name="haber"]').val());
            if ($('input[name="iva"]').is(':checked')) {
                total = (total * <?php echo APP_MOVIMIENTOS_IVA; ?> /100) + total;
            }
            $('#total-final').html(total || 0);
        };

        $('input[name="debe"], input[name="haber"]').on('keyup', function() {
            typeof callback === 'function' && callback();
        });
        $('input[name="iva"]').on('change', function() {
            typeof callback === 'function' && callback();
        });
    });
</script>
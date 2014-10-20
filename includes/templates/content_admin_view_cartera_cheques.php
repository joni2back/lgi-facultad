<?php

if (! $app->isAdmin()) {
    include_once 'content_404.php';
    exit;
}

?>

<div class="container">
    <div class="well">

        <ul class="breadcrumb well">
            <li><a href="index.php?page=home">Principal</a> <span class="divider">/</span></li>
            <li><a href="index.php?page=admin">Administrador</a> <span class="divider">/</span></li>
            <li class="active">Cartera de cheques</li>
        </ul>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Fecha Emision</th>
                    <th>Fecha Cobro</th>
                    <th>Fecha Vencimiento</th>
                    <th>Banco</th>
                    <th>Tipo</th>
                    <th>Numero</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($app->getCheques() as $cheque) { ?>
                    <tr>
                        <td><?php echo $cheque->fecha_emision; ?></td>
                        <td><?php echo $cheque->fecha_cobro; ?></td>
                        <td><?php echo $cheque->fecha_vencimiento; ?></td>
                        <td><?php echo $cheque->banco; ?></td>
                        <td><?php echo $cheque->tipo_cheque; ?></td>
                        <td><?php echo $cheque->numero; ?></td>
                        <td><?php echo $cheque->importe; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="clearfix">
            <h3 class="pull-right">Saldo total cartera: $<?php echo $app->getSaldoCarteraCheques(); ?></h3>
        </div>
    </div>
</div>


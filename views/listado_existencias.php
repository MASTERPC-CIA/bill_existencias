<?php
/* Boton Imprimir */
echo tagcontent('button', '<span class="glyphicon glyphicon-print"></span> Imprimir', array('id' => 'printbtn', 'data-target' => 'div_solicitudes_list', 'class' => 'btn btn-default pull-left'));
/* METODO PARA EXPORTA A EXCEL */
/* echo tagcontent('a', '<span class="glyphicon glyphicon-export"></span> Exportar a Excel', 
  array('href' => base_url('laboratorio/index/export_solicitudes_to_excel/'. $id_servicio. '/' . $id_tipo_form .'/'.$paciente_tipo.'/' . $fecha_emision_desde . '/' . $fecha_emision_hasta. '/' . $fecha_realiz_desde. '/' . $fecha_realiz_hasta. '/' . $id_prof_solicita. '/' . $id_paciente),
  'method' => 'post', 'target' => '_blank', 'class' => 'btn btn-success btn-sm')); */

echo Open('div', array('class' => 'col-md-12'));
$caja_texto = '<input type="text" id="search_sol" placeholder="Ingrese el valor a buscar">';
echo Open('div', array('class' => 'panel panel-primary'));
echo '<span class="pull-left"><strong>LISTADO DE SOLICITUDES --- NUMERO DE REGISTROS ENCONTRADOS: ' . $num_reg . '</strong></span>';
echo '<span class="pull-right">' . $caja_texto . '</span>';
echo Close('div');

echo Open('div', array('id' => 'div_solicitudes_list', 'class' => 'col-md-12'));
//Div para mostrar el logo en la cabecera para imprimir
echo Open('div', array('id' => 'div_header', 'style' => ''));
//$this->load->view('common/hmc_head/encabezado_cuenca');
echo Close('div');
echo LineBreak(1);

echo Open('table', array('id' => 'table_sol', 'class' => "table table-fixed-header"));
echo '<thead>';
echo '<th>CODIGO</th>';
echo '<th>Nombre Producto</th>';
echo '<th>Stock</th>';
echo '<th>Precio</th>';
// echo '<th class="actions">Acciones</th>';
echo '</thead>';
echo '<tbody>';
if (!empty($data)):
    foreach ($data as $val) {
        echo Open('tr');
        echo tagcontent('td class="actions"', $val->codigo);
        echo tagcontent('td', $val->nombreUnico);
        //echo tagcontent('td', $val->stock);
        if ($val->stock == "Disponible") {
            echo tagcontent('td', tagcontent('span', 'DISPONIBLE', array('class' => 'label label-success', 'style' => 'font-size:16px')));
        } else {
            echo tagcontent('td', tagcontent('span', 'NO DISPONIBLE', array('class' => 'label label-warning', 'style' => 'font-size:16px')));
        } 
        echo tagcontent('td', "$ ". $val->costopromediokardex);
        /* echo tagcontent('td', $val->stock, array('style' => 'max-width: 30em')); */
        echo '<td class="actions">';
        ?>
        <!--<button type="button"  title = "Imprimir" data-target="print_solicitud" class="btn btn-success fa fa-print" id="ajaxpanelbtn" data-url="<?php echo base_url('laboratorio/index/mostrar_solicitud/' . $val->sol_id) ?>"></button>-->
        <!--<button type="button"  title = "Editar" data-target="opcion_elegida" class="btn btn-primary fa fa-edit" id="ajaxpanelbtn" data-url="<?php echo base_url('laboratorio/laboratorio/modificar_solicitud/' . $val->sol_id) ?>"></button>-->
        <!--<button type="button" name="btnreportes" title = "Anular" data-target="print_solicitud" class="btn btn-danger fa fa-trash-o" id="ajaxpanelbtn" data-url="<?php echo base_url('laboratorio/index/anular_solicitud_view/' . $val->sol_id) ?>"></button>-->
        <?php
        echo '</td>';
        echo Close('tr');
    }
endif;
echo '</tbody>';
echo '</table>';
echo '</div>';
echo Close('div');
?>
<script>
    var $rows = $('#table_sol tr');
    $('#search_sol').keyup(function () {
        var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

        $rows.show().filter(function () {
            var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
            return !~text.indexOf(val);
        }).hide();
    });

    if (typeof ocultar_btn == 'function') {
//    $('textarea').tinymce();
        ocultar_btn();
    } else {
//    alert('funcion no existe');
    }
</script>


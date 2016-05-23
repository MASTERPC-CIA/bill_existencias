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
echo '<span class="pull-left"><strong>Ver: </strong></span>';
echo LineBreak(1);
?>
<select id="limit" name="limit" >
    <option value="10">10</option>
    <option value="25">25</option>
    <option value="50">50</option>
    <option value="100">100</option>
</select><div></div>
<?php
echo Open('table', array('id' => "paginated", 'name' => "paginated", 'class' => "paginated table table-fixed-header", 'cellspacing' => "0", 'width' => "100%")); // 
echo '<thead>';
echo '<tr>';
echo '<th>CODIGO</th>';
echo '<th>Nombre Producto</th>';
echo '<th>Stock</th>';
echo '<th>Precio</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
if (!empty($data)):
    foreach ($data as $val) {
        echo Open('tr');
        echo tagcontent('td', $val->codigo);
        echo tagcontent('td', $val->nombreUnico);
        //echo tagcontent('td', $val->stock);
        if ($val->stock == "Disponible") {
            echo tagcontent('td', tagcontent('span', 'DISPONIBLE', array('class' => 'label label-success', 'style' => 'font-size:16px')));
        } else {
            echo tagcontent('td', tagcontent('span', 'NO DISPONIBLE', array('class' => 'label label-warning', 'style' => 'font-size:16px')));
        }
        echo tagcontent('td', "$ " . $val->costopromediokardex);
        /* echo tagcontent('td', $val->stock, array('style' => 'max-width: 30em')); */
        echo Close('tr');
    }
endif;
echo '</tbody>';
echo '</table>';
echo '</div>';
echo Close('div');
?>
<script>
    var $rows = $('#paginated tr');
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
    var str = 10;
    $('table.paginated').each(function () {
        var currentPage = 0;
        var numPerPage = str;
        var $table = $(this);
        $table.bind('repaginate', function () {
            $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
        });
        $table.trigger('repaginate');
        var numRows = $table.find('tbody tr').length;
        var numPages = Math.ceil(numRows / numPerPage);
        var $pager = $('<div class="pager"></div>');
        for (var page = 0; page < numPages; page++) {
            $('<span class="page-number"></span>').text(page + 1).bind('click', {
                newPage: page
            }, function (event) {
                currentPage = event.data['newPage'];
                $table.trigger('repaginate');
                $(this).addClass('active').siblings().removeClass('active');
            }).appendTo($pager).addClass('clickable');
        }
        $pager.insertBefore($table).find('span.page-number:first').addClass('active');
    });

    function show(min, max) {
        var $table = $('#paginated'), $rows = $table.find('tbody tr');
        min = min ? min - 1 : 0;
        max = max ? max : $rows.length;
        $rows.hide().slice(min, max).show();
        return false;
    }

    $('#limit').bind('change', function () {
        show(0, this.value);
    });
</script>


<style>
    div.pager {
        text-align: center;
        margin: 1em 0;
    }

    div.pager span {
        display: inline-block;
        width: 1.8em;
        height: 1.8em;
        line-height: 1.8;
        text-align: center;
        cursor: pointer;
        background: #000;
        color: #fff;
        margin-right: 0.5em;
    }

    div.pager span.active {
        background: #c00;
    }

</style>


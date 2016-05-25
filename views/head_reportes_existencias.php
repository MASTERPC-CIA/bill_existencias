<?php
echo tagcontent('div', '', array('id' => 'print_solicitud', 'class' => 'col-md-12'));

echo Open('div', array('class' => 'panel panel-heading'));
echo '<strong><center>' . get_settings('RAZON_SOCIAL') . '</center></strong>';
echo Close('div');

echo Open('div', array('class' => 'panel panel-info'));
echo Open('div', array('class' => 'panel panel-heading'));
echo '<strong>OPCIONES DE BUSQUEDA</strong>';
echo Close('div');

echo Open('form', array('action' => base_url('existencias/index/get_existencias'), 'method' => 'post'));
echo input(array('type' => 'hidden', 'name' => 'product_id', 'id' => 'product_id', 'value' => '0'));
echo Open('div', array('class' => 'panel panel-body'));

echo Open('div', array('class' => 'col-md-3'));
echo input(array('id' => 'kardex_product_autosug', 'data-url' => base_url('common/autosuggest/get_product_by_name/%QUERY'), 'class' => 'form-control input-sm typeahead', 'Placeholder' => 'Busca Productos y servicios'));
echo Close('div');

/* echo Open('div', array('class' => 'col-md-2'));
  echo input(array('id' => 'kardex_product_by_cod_autosug', 'data-url' => base_url('common/autosuggest/get_product_by_cod/%QUERY'), 'class' => 'form-control input-sm typeahead', 'Placeholder' => 'Codigo Del Producto'));
  echo Close('div'); */

echo tagcontent('div', 'Seleccione un producto para consultar', array('id' => 'nombre_producto', 'class' => 'col-md-7'));

echo lineBreak2();
//Filtro por Tipo de Formulario
echo Open('div', array('class' => 'col-md-6 form-group'));
echo Open('div', array('class' => 'input-group'));
echo tagcontent('span', 'Grupo producto: ', array('class' => 'input-group-addon'));
echo combobox($productogrupo, array('label' => 'nombre', 'value' => 'codigo'), array('id' => 'lista_form_grupo', 'name' => 'lista_form_grupo', 'class' => 'form-control input-sm custom-select'), true); //combobox
echo Close('div');
echo Close('div');

echo Open('div', array('class' => 'col-md-3 form-group'));
echo tagcontent('button', '<span class="glyphicon glyphicon-search"></span> BUSCAR', array('id' => 'ajaxformbtn', 'data-target' => 'result_solicitudes_out', 'class' => 'btn btn-primary'));
echo Close('div');
echo Close('div');
echo Close('div');

echo Close('form');

echo Open('div', array('class' => 'panel panel-success'));
echo Open('div', array('class' => 'panel panel-heading'));
echo '<strong>RESULTADOS DE BUSQUEDA</strong>';
echo Close('div');

echo Open('div', array('class' => 'panel panel-body'));
echo Open('div', array('class' => 'input-group'));
echo tagcontent('div', '', array('id' => 'result_solicitudes_out'));
echo Close('div');
echo Close('div');
echo Close('div');
?>
<script>
    $('#product_id').val('');
    var load_product = function (datum) {
        $('#nombre_producto').html(datum.value);
        $('#nombre_producto').removeAttr('style');
        $('#nombre_producto').attr('style', 'background:#d7ebf9; font-weight: bold;color:#000; font-size:12px');
        $('#product_id').val(datum.ci);
    };

//    $(function() {
    $.load_autosugest('#kardex_product_autosug', load_product, 4, 10, 'id');
    //$.load_autosugest('#kardex_product_by_cod_autosug', load_product, 2, 10, 'id');
//    });

    $('#kardex_product_autosug').on('click', function () {
        console.log("here");
        $('#product_id').attr('value', '');
        $('#nombre_producto').attr('value', '');
        $('#nombre_producto').html('');
        $('#kardex_product_autosug').attr('value', '');
        $('#kardex_product_autosug').val('');
    });

    $(function () {
        $(".custom-select").customselect();
    });
</script>
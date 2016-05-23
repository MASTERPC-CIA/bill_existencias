<?php

class Existencias_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_existencias($product_id, $lista_form_grupo) {
        $lista_form_grupo = $lista_form_grupo == '-1' ? '' : $lista_form_grupo;

        $where_data = array();

        if (!empty($product_id)) {
            $where_data['pro.codigo'] = $product_id;
        }
        if (!empty($lista_form_grupo)) {
            $where_data['pro.productogrupo_codigo'] = $lista_form_grupo;
        }

        $join_cluase = array(
            '0' => array('table' => 'billing_stockbodega st', 'condition' => 'st.producto_codigo = pro.codigo'),
            '1' => array('table' => 'billing_productogrupo pg', 'condition' => 'pg.codigo = pro.productogrupo_codigo')
        );
        $fields = 'pro.codigo,pro.nombreUnico,CASE WHEN st.stock > 0 THEN "Disponible" ELSE "No disponible" END AS stock, pro.costopromediokardex';
        $json_res = $this->generic_model->get_join('billing_producto pro', $where_data, $join_cluase, $fields, '');
//print_r($json_res);
        $res['data'] = $json_res;
        $resultado = count($json_res);
        $res['num_reg'] = $resultado;
        json_encode($json_res);
        
        /* Campos para enviar a exportacion excel */
        $res['product_id'] = $product_id;
        $res['lista_form_grupo'] = $lista_form_grupo;
        /*$res['fecha_realiz_desde'] = $fecha_realiz_desde;
        $res['fecha_realiz_hasta'] = $fecha_realiz_hasta;
        $res['id_paciente'] = $id_paciente;
        $res['id_prof_solicita'] = $id_prof_solicita;
        $res['id_tipo_form'] = $id_tipo_form;
        $res['id_servicio'] = $id_servicio;
        $res['paciente_tipo'] = $paciente_tipo;*/
        return $res;
//        $this->ci->load->view('listado_solicitudes', $res);
    }

}

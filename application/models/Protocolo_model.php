<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Protocolo_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }


    function get($table, $fields, $where = '', $perpage = 0, $start = 0, $one = false, $array = 'array')
    {

        $this->db->select($fields);
        $this->db->from($table);
        $this->db->order_by('id', 'desc');
        $this->db->limit($perpage, $start);
        if ($where) {
            $this->db->where($where);
        }

        $query = $this->db->get();

        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getById($id)
    {
        $this->db->where('id', $id);
        $this->db->limit(1);
        return $this->db->get('protocolo')->row();
    }

    function add($table, $data)
    {
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() == '1') {
            return true;
        }

        return false;
    }

    function edit($table, $data, $fieldID, $ID)
    {
        $this->db->where($fieldID, $ID);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() >= 0) {
            return true;
        }

        return false;
    }

    function delete($table, $fieldID, $ID)
    {
        $this->db->where($fieldID, $ID);
        $this->db->delete($table);
        if ($this->db->affected_rows() == '1') {
            return true;
        }

        return false;
    }

    function count($table)
    {
        return $this->db->count_all($table);
    }

    function listarProcolo($one = false){
        $this->db->select('
                     p.id,  p.protocolo, p.tipo , p.data, p.setor_id , s.descricao as setor_atual,
                     p.estado_conservacao, p.valor_atual, p.historico, p.bem_id,
                     p.setor_anterior_id , se.descricao as setor_anterior
                    ');
        $this->db->from('protocolo p');
        $this->db->join('setores s', 's.id = p.setor_id', 'left');
        $this->db->join('setores se', 'se.id = p.setor_anterior_id', 'left');
        $this->db->order_by('p.protocolo', 'desc');
        $this->db->order_by('p.data', 'desc');
        $this->db->order_by('p.id', 'desc');

        $query = $this->db->get();

        $result =  !$one  ? $query->result() : $query->row();
        return $result;

    }

    function ultimoProtocoloBem($bem_id='', $one = false){
        $this->db->select('protocolo');
        $this->db->from('protocolo');
        $this->db->where('bem_id', $bem_id);

        $query = $this->db->get();

        $result =  !$one  ? $query->result() : $query->row();
        return $result;

    }

    function ultimoProtocolo($one = false){
        $this->db->select('protocolo');
        $this->db->from('protocolo');
        $this->db->order_by('protocolo', 'desc');
        $this->db->limit(1);
        $query = $this->db->get();

        $result =  !$one  ? $query->result() : $query->row();
        return $result;

    }
    function ultimoProtocoloPorCodProtocolo($cod_protocolo,$one = false){
        $this->db->select('
                     p.id,  p.protocolo, p.tipo , p.data, p.setor_id , s.descricao as setor_atual,
                     p.estado_conservacao, p.valor_atual, p.historico, p.bem_id,
                     p.setor_anterior_id , se.descricao as setor_anterior,p.numero_serie
                    ');
        $this->db->from('protocolo p');
        $this->db->join('setores s', 's.id = p.setor_id', 'left');
        $this->db->join('setores se', 'se.id = p.setor_anterior_id', 'left');

        $this->db->where('p.protocolo', $cod_protocolo);
        $this->db->order_by('p.id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get();

        $result =  !$one  ? $query->result() : $query->row();
        return $result;

    }

    function ProtocoloAgrupadoByBemID($bem_id = null,$one = false){
        $this->db->select('
                     p.id,  p.protocolo, p.tipo , p.data, p.setor_id , s.descricao as setor_atual,
                     p.estado_conservacao, p.valor_atual, p.historico, p.bem_id,
                     p.setor_anterior_id , se.descricao as setor_anterior, p.numero_serie
                    ');
        $this->db->from('protocolo p');
        $this->db->join('setores s', 's.id = p.setor_id', 'left');
        $this->db->join('setores se', 'se.id = p.setor_anterior_id', 'left');
        $this->db->order_by('p.protocolo', 'desc');
        // $this->db->order_by('p.data', 'desc');
        // $this->db->order_by('p.id', 'desc');

        if ($bem_id != null) {
            $this->db->where('p.id = (select
                                    id
                                from
                                    protocolo
                                where
                                    protocolo =  p.protocolo
                                    and
                                    bem_id = '.$bem_id.'
                                order by
                                    id desc limit 0,1)');
        }

        $query = $this->db->get();

        $result =  !$one  ? $query->result() : $query->row();
        return $result;

    }


    function allProtocoloByBemID($bem_id = null,$one = false){
        $this->db->select('
                     p.id,  p.protocolo, p.tipo , p.data, p.setor_id , s.descricao as setor_atual,
                     p.estado_conservacao, p.valor_atual, p.historico, p.bem_id,
                     p.setor_anterior_id , se.descricao as setor_anterior
                    ');
        $this->db->from('protocolo p');
        $this->db->join('setores s', 's.id = p.setor_id', 'left');
        $this->db->join('setores se', 'se.id = p.setor_anterior_id', 'left');
        $this->db->order_by('p.protocolo', 'desc');
        $this->db->order_by('p.data', 'desc');
        $this->db->order_by('p.id', 'desc');

        if ($bem_id != null) {
            $this->db->where('bem_id', $bem_id);
        }

        $query = $this->db->get();

        $result =  !$one  ? $query->result() : $query->row();
        return $result;

    }

    function listarProcoloPorID($id=null,$one = false){
        $this->db->select('
                     p.id,  p.protocolo, p.tipo , p.data, p.setor_id , s.descricao as setor_atual,
                     p.estado_conservacao, p.valor_atual, p.historico, p.bem_id,
                     p.setor_anterior_id , se.descricao as setor_anterior,p.numero_serie
                    ');
        $this->db->from('protocolo p');
        $this->db->join('setores s', 's.id = p.setor_id', 'left');
        $this->db->join('setores se', 'se.id = p.setor_anterior_id', 'left');
        $this->db->order_by('p.protocolo', 'desc');
        $this->db->order_by('p.data', 'desc');
        $this->db->order_by('p.id', 'desc');
        if ($id != null) {
            $this->db->where('p.id', $id);
        }

        $query = $this->db->get();

        $result =  !$one  ? $query->result() : $query->row();
        return $result;

    }

    function listarProcoloPorCod($codigo=null,$one = false){
        $this->db->select('
                     p.id,  p.protocolo, p.tipo , p.data, p.setor_id , s.descricao as setor_atual,
                     p.estado_conservacao, p.valor_atual, p.historico, p.bem_id,
                     p.setor_anterior_id , se.descricao as setor_anterior
                    ');
        $this->db->from('protocolo p');
        $this->db->join('setores s', 's.id = p.setor_id', 'left');
        $this->db->join('setores se', 'se.id = p.setor_anterior_id', 'left');
        $this->db->order_by('p.data', 'desc');
        $this->db->order_by('p.id', 'desc');
        if ($codigo != null) {
            $this->db->where('p.protocolo', $codigo);
        }

        $query = $this->db->get();

        $result =  !$one  ? $query->result() : $query->row();
        return $result;

    }

}

/* End of file Protocolo_model.php */
/* Location: ./application/models/Protocolo_model.php */

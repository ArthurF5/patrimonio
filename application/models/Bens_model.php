<?php
class Bens_model extends CI_Model
{

    var $tabela = 'bens';

    function __construct()
    {
        parent::__construct();
    }

    function ultimoRegistro()
    {
        $this->db->insert_id();
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
    function bensComProtocolo($descricao_pesquisa,$cod_protocolo ,$perpage = 0, $start = 0, $one = false, $array = 'array')
    {

        $this->db->select('b.id,b.descricao,  p.protocolo');
        $this->db->from('bens b');
        $this->db->join('protocolo p', 'p.bem_id = b.id', 'inner');
        $this->db->group_by('p.protocolo');
        // $this->db->limit($perpage, $start);
        $this->db->like('p.protocolo', $cod_protocolo, 'BOTH');
        $this->db->or_like('b.descricao', $descricao_pesquisa, 'BOTH');


        $query = $this->db->get();

        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }


    function getById($id)
    {
        $this->db->where('id', $id);
        $this->db->limit(1);
        return $this->db->get('bens')->row();
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




}

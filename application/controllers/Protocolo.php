<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Protocolo extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('patrimonio/login');
        }

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('protocolo_model', '', true);
        $this->data['menuBens'] = 'Bens';
    }

    public function index()
    {

    }

    public function movimentacao()
    {
        $post = $this->input->post();
        if ($post != null ) {
            $codigoProtocolo = (int) $this->input->post('cod_protocolo');
            $setorSelecionado = $this->input->post('setor_id');
            $ultimoProtocolo = $this->protocolo_model->ultimoProtocoloPorCodProtocolo($codigoProtocolo,true);
            // debugEx($ultimoProtocolo);

            if ($setorSelecionado == $ultimoProtocolo->setor_id) {
                $retorno['sucesso'] = false;
                $retorno['mensagem'] = "Você não pode transferir para o mesmo setor de origem. Selecione outro setor e tente novamente!" ;
            } else if ($this->input->post('data') == ''){
                $retorno['sucesso'] = false;
                $retorno['mensagem'] = "Por favor, insira uma data." ;
            } else {
                $data = array(
                    'bem_id' => set_value('bem_id'),
                    'protocolo' => $codigoProtocolo,
                    'tipo' => set_value('tipo'),
                    'data' => data_en(set_value('data')),
                    'setor_id' => (set_value('setor_id')),
                    'setor_anterior_id' => $ultimoProtocolo->setor_id,
                    'valor_atual' => set_value('valor_atual'),
                    'estado_conservacao' => (set_value('estado_conservacao')),
                    'historico' => set_value('historico'),
                );

                // Vamos adicionar
                if ($this->protocolo_model->add('protocolo', $data) == true) {
                    $retorno['sucesso'] = true;
                    $retorno['mensagem'] = 'Protocolado com sucesso';
                    $retorno['objProtocolo'] = $this->protocolo_model->ultimoProtocoloPorCodProtocolo($codigoProtocolo,true);

                    $retorno['objProtocolo']->protocolo = zerosAEsquerda($retorno['objProtocolo']->protocolo,5);
                    $retorno['objProtocolo']->data = data_pt($retorno['objProtocolo']->data);
                } else {
                    $retorno['sucesso'] = false;
                    $retorno['mensagem'] = 'Erro no sistema, não foi possível protocolar, tente novamente mais tarde!';
                }

            }
            echo json_encode($retorno);
        }
    }
    public function historico()
    {
        $post = $this->input->post();
        if ($post != null ) {
            $codigoProtocolo = (int) $this->input->post('CodProtocolo');
            $historico = $this->protocolo_model->listarProcoloPorCod($codigoProtocolo,false);

            foreach ($historico as $key => $value) {
                $value->data = data_pt($value->data);
                $value->protocolo = zerosAEsquerda($value->protocolo,5);

                if ($value->setor_anterior == null) {
                    $value->setor_anterior = '';
                }
            }


            echo json_encode($historico);
        }
    }
    public function salvar()
    {

        $post = $this->input->post();

        if ($post != null ) {

            $idProtocolo  = (($this->uri->segment(3) != null)) ? $this->uri->segment(3) : '' ;
            if ($idProtocolo != null) {
                $num_protocolo = (int) set_value('cod_protocolo');
            } else {
                $valor = $this->protocolo_model->ultimoProtocolo(true) ;
                $num_protocolo = (int) $valor->protocolo + 1;
            }

            $data = array(
                'bem_id' => set_value('bem_id'),
                'protocolo' => $num_protocolo,
                'tipo' => set_value('tipo'),
                'data' => data_en(set_value('data')),
                'setor_id' => (set_value('setor_id')),
                'valor_atual' => set_value('valor_atual'),
                'estado_conservacao' => (set_value('estado_conservacao')),
                'historico' => set_value('historico'),
            );

            if ($idProtocolo != null) {
                // Vamos editar
                if ($this->protocolo_model->edit('protocolo', $data,'id',$idProtocolo) == true) {
                    $retorno['sucesso'] = true;
                    $retorno['mensagem'] = 'Registro editado com sucesso';
                    $retorno['id_protocolo'] = $idProtocolo;
                } else {
                    $retorno['sucesso'] = false;
                    $retorno['mensagem'] = 'Erro no sistema, não foi possível editar, tente novamente mais tarde!';
                }
                echo json_encode($retorno);
            } else {
                // Vamos adicionar
                if ($this->protocolo_model->add('protocolo', $data) == true) {
                    $retorno['sucesso'] = true;
                    $retorno['mensagem'] = 'Registro adicionado com sucesso';
                    $retorno['objProtocolo'] = $this->protocolo_model->ultimoProtocoloPorCodProtocolo($num_protocolo,true);
                    $retorno['objProtocolo']->protocolo = zerosAEsquerda($retorno['objProtocolo']->protocolo,5);
                    $retorno['objProtocolo']->data = data_pt($retorno['objProtocolo']->data);

                    if ($retorno['objProtocolo']->setor_anterior == null) {
                        $retorno['objProtocolo']->setor_anterior = '';
                    }

                } else {
                    $retorno['sucesso'] = false;
                    $retorno['mensagem'] = 'Erro no sistema, não foi possível adicionar, tente novamente mais tarde!';
                }
                echo json_encode($retorno);
            }
            // colocar o while aqui

        }
    }

}

/* End of file Protocolo.php */
/* Location: ./application/controllers/Protocolo.php */

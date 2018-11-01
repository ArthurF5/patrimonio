<?php

class Bens extends CI_Controller
{

    /**
     * author: Prisco Cleyton
     *
     */

    function __construct()
    {
        parent::__construct();
        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('patrimonio/login');
        }

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('bens_model', '', true);
        $this->load->model('protocolo_model', '', true);
        $this->load->model('setores_model', '', true);
        $this->load->model('ClassificacaoBens_model', '', true);
        $this->data['menuBens'] = 'Bens';
    }

    function index()
    {
        $this->gerenciar();


    }
    function adicionar(){

        // $this->data['results'] = $this->protocolo_model->listarProcolo();
        $this->data['results'] = false;

        $this->data['setores'] = $this->setores_model->get('setores', 'id,descricao,instituicao_id','','', $this->uri->segment(3));
        $this->data['ClassificacaoBens'] = $this->ClassificacaoBens_model->get('classificacao_bem', 'id,descricao','','', $this->uri->segment(3));

        $selectSetores = '';
        foreach ($this->data['setores'] as  $setores) {
            $selectSetores .= "<option value='$setores->id' >$setores->descricao</option>";
        }

        $selectClassificacaoBens = '';
        foreach ($this->data['ClassificacaoBens'] as  $classificacao_bens) {
            $selectClassificacaoBens .= "<option value='$classificacao_bens->id' >$classificacao_bens->descricao</option>";
        }
        $this->data['selectSetores'] = $selectSetores;
        $this->data['selectClassificacaoBens'] = $selectClassificacaoBens;
        $this->data['custom_error'] = '';
        $this->data['view'] = 'bens/adicionarBens';
        $this->load->view('tema/topo', $this->data);


    }

    function pesquisar()
    {

        $descricaoPesquisa = $this->input->post('pesquisa');
        $codProtocolo = (int) $this->input->post('pesquisa');


        $this->load->library('table');
        $this->load->library('pagination');

        $config['base_url'] = base_url().'index.php/bens/pesquisar/';
        $config['total_rows'] = $this->bens_model->count('bens');
        $config['per_page'] = 10;
        $config['next_link'] = 'Próxima';
        $config['prev_link'] = 'Anterior';
        $config['full_tag_open'] = '<div class="pagination alternate"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a style="color: #2D335B"><b>';
        $config['cur_tag_close'] = '</b></a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = 'Primeira';
        $config['last_link'] = 'Última';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $this->data['results'] = $this->bens_model->bensComProtocolo( $descricaoPesquisa, $codProtocolo, $config['per_page'], $this->uri->segment(3));
        $this->data['pesquisar'] = true;

        $this->data['view'] = 'bens/bens';
        $this->load->view('tema/topo', $this->data);


    }
    function gerenciar()
    {

        // if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vProduto')) {
        //     $this->session->set_flashdata('error', 'Você não tem permissão para visualizar produtos.');
        //     redirect(base_url());
        // }

        $this->load->library('table');
        $this->load->library('pagination');

        $config['base_url'] = base_url().'index.php/bens/gerenciar/';
        $config['total_rows'] = $this->bens_model->count('bens');
        $config['per_page'] = 10;
        $config['next_link'] = 'Próxima';
        $config['prev_link'] = 'Anterior';
        $config['full_tag_open'] = '<div class="pagination alternate"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a style="color: #2D335B"><b>';
        $config['cur_tag_close'] = '</b></a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = 'Primeira';
        $config['last_link'] = 'Última';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $this->data['results'] = $this->bens_model->get('bens', 'id,descricao,nota_fiscal,valor_unitario,origem_fornecedor', '', $config['per_page'], $this->uri->segment(3));

        $this->data['view'] = 'bens/bens';
        $this->load->view('tema/topo', $this->data);


    }
    function salvar(){
        $post = $this->input->post();
        if ($post != null ) {
            $objCadastro = new stdClass();
            $objCadastro->descricao = $post['descricao'];
            $objCadastro->registro_documento = $post['documento'];
            $objCadastro->nota_fiscal = $post['nf'];
            $objCadastro->valor_unitario = (float) $post['valor_unitario'];
            $objCadastro->classificacao_bem = $post['classificacao_bem'];
            $objCadastro->origem_fornecedor = $post['fornecedor'];
            $objCadastro->tipo_bem = $post['tipo_bem'];

            if ($this->bens_model->add('bens', $objCadastro) == true) {

                $retorno['sucesso'] = true;
                $retorno['mensagem'] = 'Bem adicionado com sucesso.';
                $retorno['codigo'] = $this->db->insert_id();

                echo json_encode($retorno);

                // redirect(base_url() . 'index.php/setores/adicionar/');
            } else {
                $retorno['sucesso'] = false;
                $retorno['mensagem'] = 'Erro ao tentar inserir o Bem, tente novamente mais tarde';

                // $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
                echo json_encode($retorno);
            }
        }
    }

    function teste(){
        $conecta = mysqli_connect("localhost","root","","banco");
        if ( mysqli_connect_errno()  ) {
            die("Conexao falhou: " . mysqli_connect_errno());
            // debugEx('deu');
        }

        if(isset($_POST["descricao"])) {
            $nome       = utf8_decode($_POST["descricao"]);
            $inserir    = "INSERT INTO teste ";
            $inserir    .= "(descricao) ";
            $inserir    .= "VALUES ";
            $inserir    .= "('$nome')";

            $retorno = array();
            $operacao_insercao = mysqli_query($conecta,$inserir);

            if ($operacao_insercao) {
                $retorno['sucesso'] = true;
                $retorno['mensagem'] = "Salvo com sucesso.";

            } else {
                $retorno['sucesso'] = false;
                $retorno['mensagem'] = "Falha na inserção, tente mais tarde.";

            }

            echo json_encode($retorno);
        }
            // $retorno['sucesso'] = true;
            // echo json_encode($retorno);

    }

    function adicionar2()
    {

        // if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aProduto')) {
        //     $this->session->set_flashdata('error', 'Você não tem permissão para adicionar produtos.');
        //     redirect(base_url());
        // }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        // if ($this->form_validation->run('setores') == false) {
        //     $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        $post = $this->input->post();
        // debugEx($post);
        if ($post != null ) {
            $objCadastro = new stdClass();
            $objCadastro->descricao = $post['descricao'];
            $objCadastro->instituicao_id = $post['instituicao_id'];
            $data = array(
                'descricao' => set_value('descricao'),
                'instituicao_id' => set_value('instituicao_id'),

            );

            if ($this->setores_model->add('setores', $data) == true) {

                $retorno['sucesso'] = 'deu certo';
                echo json_encode($retorno);

                $this->session->set_flashdata('success', 'Setor adicionado com sucesso!');
                redirect(base_url() . 'index.php/setores/adicionar/');
            } else {
                $retorno['sucesso'] = 'deu certo';
                echo json_encode($retorno);

                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
            }
        }
        $this->data['view'] = 'setores/adicionarSetor';
        $this->load->view('tema/topo', $this->data);

    }

    function editar()
    {

        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('patrimonio');
        }

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar produtos.');
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';



        $this->data['result'] = $this->bens_model->getById($this->uri->segment(3));
        $this->data['protocolo'] = $this->protocolo_model->ProtocoloAgrupadoByBemID($this->uri->segment(3),false);


        $this->data['setores'] = $this->setores_model->get('setores', 'id,descricao,instituicao_id','','', '');
        $this->data['ClassificacaoBens'] = $this->ClassificacaoBens_model->get('classificacao_bem', 'id,descricao','','', '');

        $selectSetores = '';
        $selectClassificacaoBens = '';

        $classificacao_bem_id = $this->data['result']->classificacao_bem;
        $setor_id = $this->data['protocolo'][0]->setor_id;

        foreach ($this->data['setores'] as  $setores) {
            if ($setor_id == $setores->id) {
                $selectSetores .= "<option value='$setores->id' selected>$setores->descricao</option>";
            } else {
                $selectSetores .= "<option value='$setores->id' >$setores->descricao</option>";
            }
        }
        foreach ($this->data['ClassificacaoBens'] as  $classificacao_bens) {
            if ($classificacao_bem_id == $classificacao_bens->id) {
                $selectClassificacaoBens .= "<option value='$classificacao_bens->id' selected>$classificacao_bens->descricao</option>";
            } else {
                $selectClassificacaoBens .= "<option value='$classificacao_bens->id' >$classificacao_bens->descricao</option>";
            }
        }


        $this->data['selectSetores'] = $selectSetores;
        $this->data['selectClassificacaoBens'] = $selectClassificacaoBens;
        $this->data['view'] = 'bens/editarBens';
        $this->load->view('tema/topo', $this->data);

    }


    function visualizar()
    {

        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('patrimonio');
        }

        // if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vProduto')) {
        //     $this->session->set_flashdata('error', 'Você não tem permissão para visualizar produtos.');
        //     redirect(base_url());
        // }

        $this->data['result'] = $this->setores_model->getById($this->uri->segment(3));

        if ($this->data['result'] == null) {
            $this->session->set_flashdata('error', 'Setor não encontrado.');
            redirect(base_url() . 'index.php/setores/editar/'.$this->input->post('id'));
        }

        $this->data['view'] = 'setores/visualizarSetor';
        $this->load->view('tema/topo', $this->data);

    }

    function excluir()
    {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'dProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir produtos.');
            redirect(base_url());
        }


        $id =  $this->input->post('id');
        if ($id == null) {

            $this->session->set_flashdata('error', 'Erro ao tentar excluir bem.');
            redirect(base_url().'index.php/bens/gerenciar/');
        }

        // $this->db->where('produtos_id', $id);
        // $this->db->delete('produtos_os');


        // $this->db->where('produtos_id', $id);
        // $this->db->delete('itens_de_vendas');

        $this->bens_model->delete('bens', 'id', $id);


        $this->session->set_flashdata('success', 'Produto excluido com sucesso!');
        redirect(base_url().'index.php/bens/gerenciar/');
    }

    function carregar(){
        $post = $this->input->post();
        if ($post != null ) {
            $protocoloID = $post['protocoloID'];
            $obj = $this->protocolo_model->listarProcoloPorID($protocoloID,true);
            $obj->protocolo = str_pad((string) $obj->protocolo, 5 , '0' ,STR_PAD_LEFT);
            $obj->data = data_pt($obj->data);

            echo json_encode($obj);

        }
    }



}

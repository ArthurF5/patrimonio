use patrimonio;


create table instituicao (
    id int primary key auto_increment,
    razao_social varchar(150) not null,
    cnpj varchar(15),
    endereco varchar(50),
    numero int,
    logradouro varchar(50),
    uf varchar(2)

)


create table setores (
    id int primary key auto_increment,
    descricao varchar(50) not null,
    instituicao_id int not null

)
alter table setores add foreign key (instituicao_id) references instituicao(id)
-- alter table setores add foreign key (instituicao_id)
-- instituicao(id)


create table bens (
    id int primary key auto_increment,
    descricao varchar(100) not null,
    tipo_inscricao varchar(20) not null,
    registro_documento varchar(50),
    nota_fiscal varchar(30),
    data_inscricao date,
    valor_unitario float,
    numero_empenho varchar(30),
    data_emprenho date,
    natureza_bem varchar(30),
    classificacao_bem varchar(30),
    origem_fornecedor varchar(50),
    bem_imovel varchar(50)

)
-- alter table bens add foreign key (protocolo_id) references protocolo(id)


create table protocolo (
    id int primary key auto_increment,
    tipo varchar(15) not null,
    data date not null,
    setor_id int not null,
    estado_conservacao varchar(10) not null,
    valor_atual float ,
    historico varchar(100)

)

alter table protocolo add foreign key (setor_id) references setores(id)

alter table bens drop column classificacao_bem
alter table bens add column classificacao_bem int
alter table bens add foreign key (classificacao_bem) references classificacao_bem(id)


create table classificacao_bem (
    id int primary key auto_increment,
    descricao varchar(100)
)



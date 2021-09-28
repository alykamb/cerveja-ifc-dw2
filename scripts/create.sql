
CREATE TABLE endereco (
    id SERIAL PRIMARY KEY,
    logradouro varchar(254) NOT NULL,
    estado varchar(100) NOT NULL,
    cidade varchar(100) NOT NULL,
    cep varchar(9) NOT NULL
);

CREATE TABLE cervejaria (
    id SERIAL PRIMARY KEY,
    nome varchar(100) NOT NULL,
    endereco_id int NOT NULL,
    CONSTRAINT cervejaria_endereco_id_fkey FOREIGN KEY (endereco_id) REFERENCES endereco(id) ON UPDATE cascade
);

CREATE TABLE cerveja (
    id serial PRIMARY KEY,
    nome varchar(100) NOT NULL,
    cervejaria_id int NOT NULL,
    CONSTRAINT cerveja_cervejaria_id_fkey FOREIGN KEY (cervejaria_id) REFERENCES cervejaria(id) ON UPDATE cascade
);

CREATE TABLE cozinha (
    id serial PRIMARY KEY,
    nome varchar(100) NOT NULL,
    descricao text
);

CREATE TABLE cozinha_cerveja (
    id SERIAL PRIMARY KEY,
    cerveja_id int NOT NULL,
    cozinha_id int NOT NULL,
    CONSTRAINT cozinha_cerveja_cerveja_id_fkey FOREIGN KEY (cerveja_id) REFERENCES cerveja(id) ON UPDATE cascade,
    CONSTRAINT cozinha_cerveja_cozinha_id_fkey FOREIGN KEY (cozinha_id) REFERENCES cozinha(id) ON UPDATE cascade
);
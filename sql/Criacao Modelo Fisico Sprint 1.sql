CREATE TABLE Lojista (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    CNPJ CHAR(14) UNIQUE,
    email VARCHAR(50)UNIQUE,
    Nome VARCHAR(100),
	senha CHAR(32),
    fk_Cadastro_Tipo_ID INT
);

CREATE TABLE Produto (
    SKU CHAR(5),
    fk_Lojista_ID INT,
    fk_Categoria_Produto_ID INT,
    Nome VARCHAR(100),
    Preco FLOAT,
    Quantidade INT,
    Peso FLOAT,
    Foto BLOB,
    Descricao VARCHAR(1000),
    PRIMARY KEY (fk_Lojista_ID, SKU)
);

CREATE TABLE Categoria_Produto (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nome VARCHAR(30)
);


CREATE TABLE Cadastro_Tipo (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nome VARCHAR(30)
);
 
ALTER TABLE Lojista ADD CONSTRAINT FK_Lojista_2
    FOREIGN KEY (fk_Cadastro_Tipo_ID)
    REFERENCES Cadastro_Tipo (ID)
    ON DELETE CASCADE;
 
ALTER TABLE Produto ADD CONSTRAINT FK_Produto_2
    FOREIGN KEY (fk_Categoria_Produto_ID)
    REFERENCES Categoria_Produto (ID)
    ON DELETE CASCADE;
 
ALTER TABLE Produto ADD CONSTRAINT FK_Produto_3
    FOREIGN KEY (fk_Lojista_ID)
    REFERENCES Lojista (ID)
    ON DELETE CASCADE;
    
insert into Cadastro_tipo (nome) values 
("Lojista"), ("Consumidor"), ("Administrador");


insert into Categoria_Produto(nome) values 
("Termogênicos"), ("Aminoácidos"), ("Acessórios");

# senha : teste123

insert into lojista (nome, email, cnpj, senha, fk_Cadastro_Tipo_ID) values 
("Fernando Souza", "fernando@gmail.com", "15625548000147", "aa1bf4646de67fd9086cf6c79007026c", 1),
("Flavia lopes", "flavia@gmail.com", "85425548000102", "aa1bf4646de67fd9086cf6c79007026c", 1),
("Maria oliveira", "maria.com", "65487458000165", "aa1bf4646de67fd9086cf6c79007026c", 1),
("Pedro alcantara", "pedro@gmail.com", "15632236000178", "aa1bf4646de67fd9086cf6c79007026c", 1),
("Julio lins", "julio@gmail.com", "89157530001578", "aa1bf4646de67fd9086cf6c79007026c", 1);


insert into produto(sku, fk_Lojista_ID, nome, preco, quantidade, peso, fk_Categoria_Produto_ID) values
("25fa", 1, "Creatina", 150.00, 85, 500.00, 2),
("38fd", 2, "Glutamina", 75.00, 50, 250.00, 2),
("df10", 3, "Cafeína em Pó", 50.00, 100, 80.00, 1),
("e23f", 4, "Coqueteleira", 70.00, 150, NULL, 3),
("85d63", 5, "Strep", 30.00, 200, NULL, 3);
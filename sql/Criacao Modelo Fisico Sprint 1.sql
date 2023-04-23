/* Modelo Fisico Sprint 1: Criação das tabelas e Povoamento*/
CREATE TABLE Lojista (
    ID INTEGER PRIMARY KEY,
    CNPJ CHAR(14) UNIQUE,
    email VARCHAR(30),
    Nome VARCHAR(100)
);

CREATE TABLE Produto (
    SKU CHAR(5),
    fk_Lojista_ID INTEGER,
    fk_Categoria_Produto_ID INTEGER,
    Nome VARCHAR(100),
    Preco FLOAT,
    Quantidade INTEGER,
    Peso FLOAT,
    Foto BLOB,
    Descricao VARCHAR(1000),
    PRIMARY KEY (SKU, fk_Lojista_ID)
);

CREATE TABLE Categoria_Produto (
    ID INTEGER PRIMARY KEY,
    Nome VARCHAR(30)
);
 
ALTER TABLE Produto ADD CONSTRAINT FK_Produto_1
    FOREIGN KEY (fk_Categoria_Produto_ID)
    REFERENCES Categoria_Produto (ID)
    ON DELETE CASCADE;
 
ALTER TABLE Produto ADD CONSTRAINT FK_Produto_2
    FOREIGN KEY (fk_Lojista_ID)
    REFERENCES Lojista (ID)
    ON DELETE CASCADE;
    
    
insert into lojista (id, nome, email, cnpj) values (1, "Fernando Souza", "fernando@gmail.com", "15625548000147");
insert into lojista (id, nome, email, cnpj) values (2, "Flavia lopes", "flavia@gmail.com", "85425548000102");
insert into lojista (id, nome, email, cnpj) values (3, "Maria oliveira", "maria.com", "65487458000165");
insert into lojista (id, nome, email, cnpj) values (4, "Pedro alcantara", "pedro@gmail.com", "15632236000178");
insert into lojista (id, nome, email, cnpj) values (5, "Julio lins", "julio@gmail.com", "8915753000157");


 insert into Categoria_Produto(id, nome) values (1, "Termogênicos");
 insert into Categoria_Produto(id, nome) values (2, "Aminoácidos");
 insert into Categoria_Produto(id, nome) values (3, "Acessórios");
 
 
insert into produto(sku, fk_Lojista_ID, nome, preco, quantidade, peso, fk_Categoria_Produto_ID) values("25fa", 1, "Creatina", 150.00, 85, 500.00, 2);
insert into produto(sku, fk_Lojista_ID, nome, preco, quantidade, peso, fk_Categoria_Produto_ID) values("38fd", 2, "Glutamina", 75.00, 50, 250.00, 2);
insert into produto(sku, fk_Lojista_ID, nome, preco, quantidade, peso, fk_Categoria_Produto_ID) values("df10", 3, "Cafeína em Pó", 50.00, 100, 80.00, 1);
insert into produto(sku, fk_Lojista_ID, nome, preco, quantidade, peso, fk_Categoria_Produto_ID) values("e23f", 4, "Coqueteleira", 70.00, 150, NULL, 3);
insert into produto(sku, fk_Lojista_ID, nome, preco, quantidade, peso, fk_Categoria_Produto_ID) values("85d63", 5, "Strep", 30.00, 200, NULL, 3);

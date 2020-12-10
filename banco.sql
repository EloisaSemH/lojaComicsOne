
--
-- Database: `logincoment`
--
drop database if exists lojinhacomics;
CREATE DATABASE `lojinhacomics` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `lojinhacomics`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `us_cod` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `us_nome` varchar(127) NOT NULL,
  `us_email` varchar(255) NOT NULL UNIQUE,
  `us_cpf` bigint(11) NOT NULL UNIQUE,
  `us_genero` varchar(1) NOT NULL,
  `us_dataNasc` date NOT NULL,
  `us_telefone` varchar(15) NOT NULL,
  `us_dataHoraCriacao` DATETIME NOT NULL,
  `us_dataHoraEdicao` DATETIME NOT NULL,
  `us_dataHoraLogin` DATETIME NOT NULL,
  `us_ipLogin` varchar(15) NOT NULL,
  `us_tipo` int(1) NOT NULL default(1),
  KEY `fk_us_nome` (`us_nome`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `senhas`
--

CREATE TABLE `senhas` (
  `se_us_cod` int(11) NOT NULL PRIMARY KEY,
  `se_senha` varchar(255) NOT NULL,
  CONSTRAINT `fk_senhas_usuarios` FOREIGN KEY (`se_us_cod`) REFERENCES `usuarios` (`us_cod`) ON DELETE CASCADE ON UPDATE NO ACTION,
  KEY `fk_senhas_usuarios_idx` (`se_us_cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fotos`
--

CREATE TABLE `fotos_cliente` (
  `ftc_us_cod` int(11) NOT NULL UNIQUE PRIMARY KEY,
  `ftc_img` varchar(63) NOT NULL,
  `ftc_desc` varchar(255) DEFAULT NULL,
  CONSTRAINT `fk_foto_us_cod` FOREIGN KEY (`ftc_us_cod`) REFERENCES `usuarios` (`us_cod`) ON DELETE CASCADE ON UPDATE NO ACTION,
  KEY `fk_foto_us_cod` (`ftc_us_cod`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecos`
--

CREATE TABLE `enderecos` (
  `end_cod` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `end_us_cod` int(11) DEFAULT(NULL),
  `end_cep` VARCHAR(9) NOT NULL,
  `end_rua` VARCHAR(127) NOT NULL,
  `end_numero` smallint NOT NULL,
  `end_complemento` VARCHAR(127) DEFAULT(NULL),
  `end_bairro` VARCHAR(127) NOT NULL,
  `end_cidade` VARCHAR(127) NOT NULL,
  `end_uf` VARCHAR(2) NOT NULL,
  `end_dataHoraCriacao` DATETIME NOT NULL,
  `end_dataHoraEdicao` datetime NOT NULL,
  CONSTRAINT `fk_end_us_cod` FOREIGN KEY (`end_us_cod`) REFERENCES `usuarios` (`us_cod`) ON DELETE CASCADE ON UPDATE NO ACTION,
  KEY `fk_end_us_cod` (`end_us_cod`) USING BTREE,
  KEY `end_cod` (`end_cod`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;  


-- --------------------------------------------------------

--
-- Estrutura da tabela `editoras`
--

CREATE TABLE `editoras` (
  `edi_cod` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `edi_nome` varchar(127) NOT NULL,
  `edi_sobre` text DEFAULT(NULL),
  `edi_pais` varchar(47) DEFAULT(NULL),
  `edi_site` varchar(255) DEFAULT(NULL),
  `edi_dataHoraCriacao` DATETIME NOT NULL,
  `edi_dataHoraEdicao` DATETIME NOT NULL,
  KEY `fk_edi_cod` (`edi_cod`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `autores`
--

CREATE TABLE `autores` (
  `aut_cod` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `aut_nomeArtistico` varchar(127) NOT NULL,
  `aut_nomeVerdadeiro` varchar(127) DEFAULT(NULL),
  `aut_genero` varchar(1) DEFAULT(NULL),
  `aut_sobre` text DEFAULT(NULL),
  `aut_pais` varchar(47) DEFAULT(NULL),
  `aut_site` varchar(255) DEFAULT(NULL),
  `aut_dataHoraCriacao` DATETIME NOT NULL,
  `aut_dataHoraEdicao` DATETIME NOT NULL,
  KEY `fk_aut_cod` (`aut_cod`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `cat_cod` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cat_nome` varchar(63) NOT NULL,
  KEY `fk_edi_cod` (`cat_cod`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo`
--

CREATE TABLE `tipos` (
  `tipo_cod` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `tipo_nome` varchar(63) NOT NULL,
  KEY `fk_tipo_cod` (`tipo_cod`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `ped_cod` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ped_us_cod` int(11) DEFAULT(NULL),
  `ped_end_cod` int(11) DEFAULT(NULL),
  `ped_status` varchar(15) NOT NULL,
  `ped_dataHoraCriacao` DATETIME NOT NULL,
  CONSTRAINT `fk_ped_us_cod` FOREIGN KEY (`ped_us_cod`) REFERENCES `usuarios` (`us_cod`) ON DELETE CASCADE ON UPDATE NO ACTION,
  KEY `fk_ped_us_cod` (`ped_us_cod`) USING BTREE,
  CONSTRAINT `fk_ped_end_cod` FOREIGN KEY (`ped_end_cod`) REFERENCES `enderecos` (`end_cod`) ON DELETE CASCADE ON UPDATE NO ACTION,
  KEY `fk_ped_end_cod` (`ped_end_cod`) USING BTREE,
  KEY `fk_ped_cod` (`ped_cod`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `quadrinhos`
--

CREATE TABLE `quadrinhos` (
  `hq_cod` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `hq_titulo` varchar(255) NOT NULL,
  `hq_edicao` tinyint DEFAULT(NULL),
  `hq_volume` tinyint DEFAULT(NULL),
  `hq_serie` VARCHAR(31) DEFAULT(NULL),
  `hq_tipo` VARCHAR(31) DEFAULT(NULL),
  `hq_editora_cod` int(1) NOT NULL,
  `hq_lancamento` smallint DEFAULT(NULL),
  `hq_numPaginas` tinyint DEFAULT(NULL),
  `hq_impressao` VARCHAR(31) DEFAULT(NULL),
  `hq_faixaEtaria` tinyint DEFAULT(NULL),
  `hq_sinopse` text DEFAULT(NULL),
  `hq_valor` float NOT NULL,
  `hq_porcentagemPromocao` TINYINT DEFAULT(NULL),
  `hq_estoque` smallint NOT NULL,
  `hq_emEstoque` bool NOT NULL DEFAULT(false),
  `hq_dataHoraCriacao` DATETIME NOT NULL,
  `hq_dataHoraEdicao` DATETIME NOT NULL,
  KEY `fk_hq_cod` (`hq_cod`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rel_quadrinhos_pedidos`
--

CREATE TABLE `rel_quadrinhos_pedidos` (
  `ped_cod` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `hq_cod` int(11) NOT NULL,
  CONSTRAINT `fk_rel_qp_us_cod` FOREIGN KEY (`ped_cod`) REFERENCES `usuarios` (`us_cod`) ON DELETE CASCADE ON UPDATE NO ACTION,
  KEY `fk_rel_qp_us_cod` (`ped_cod`) USING BTREE,
  CONSTRAINT `fk_rel_qp_hq_cod` FOREIGN KEY (`hq_cod`) REFERENCES `quadrinhos` (`hq_cod`) ON DELETE CASCADE ON UPDATE NO ACTION,
  KEY `fk_rel_qp_hq_cod` (`hq_cod`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------

--
-- Estrutura da tabela `rel_quadrinhos_editoras`
--

-- CREATE TABLE `rel_quadrinhos_editoras` (
--   `hq_cod` int(11) NOT NULL,
--   `edi_cod` int(11) NOT NULL,
--   CONSTRAINT `fk_rel_qe_hq_cod` FOREIGN KEY (`hq_cod`) REFERENCES `quadrinhos` (`hq_cod`) ON DELETE CASCADE ON UPDATE NO ACTION,
--   KEY `fk_rel_qe_hq_cod` (`hq_cod`) USING BTREE,
--   CONSTRAINT `fk_qe_rel_edi_cod` FOREIGN KEY (`edi_cod`) REFERENCES `editoras` (`edi_cod`) ON DELETE CASCADE ON UPDATE NO ACTION,
--   KEY `fk_rel_qe_edi_cod` (`edi_cod`) USING BTREE
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -- --------------------------------------------------------

--
-- Estrutura da tabela `rel_quadrinhos_autores`
--

CREATE TABLE `rel_quadrinhos_autores` (
  `hq_cod` int(11) NOT NULL,
  `aut_cod` int(11) NOT NULL,
  CONSTRAINT `fk_rel_qa_hq_cod` FOREIGN KEY (`hq_cod`) REFERENCES `quadrinhos` (`hq_cod`) ON DELETE CASCADE ON UPDATE NO ACTION,
  KEY `fk_rel_qa_hq_cod` (`hq_cod`) USING BTREE,
  CONSTRAINT `fk_rel_qa_aut_cod` FOREIGN KEY (`aut_cod`) REFERENCES `autores` (`aut_cod`) ON DELETE CASCADE ON UPDATE NO ACTION,
  KEY `fk_rel_qa_aut_cod` (`aut_cod`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rel_quadrinhos_categorias`
--

CREATE TABLE `rel_quadrinhos_categorias` (
  `hq_cod` int(11) NOT NULL,
  `cat_cod` int(11) NOT NULL,
  CONSTRAINT `fk_rel_qc_hq_cod` FOREIGN KEY (`hq_cod`) REFERENCES `quadrinhos` (`hq_cod`) ON DELETE CASCADE ON UPDATE NO ACTION,
  KEY `fk_rel_qc_hq_cod` (`hq_cod`) USING BTREE,
  CONSTRAINT `fk_rel_qc_cat_cod` FOREIGN KEY (`cat_cod`) REFERENCES `categorias` (`cat_cod`) ON DELETE CASCADE ON UPDATE NO ACTION,
  KEY `fk_rel_qc_cat_cod` (`cat_cod`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rel_quadrinhos_tipos`
--

-- CREATE TABLE `rel_quadrinhos_tipos` (
--   `hq_cod` int(11) NOT NULL,
--   `tipo_cod` int(11) NOT NULL,
--   CONSTRAINT `fk_rel_qt_hq_cod` FOREIGN KEY (`hq_cod`) REFERENCES `quadrinhos` (`hq_cod`) ON DELETE CASCADE ON UPDATE NO ACTION,
--   KEY `fk_rel_qt_hq_cod` (`hq_cod`) USING BTREE,
--   CONSTRAINT `fk_rel_qt_tipo_cod` FOREIGN KEY (`tipo_cod`) REFERENCES `tipos` (`tipo_cod`) ON DELETE CASCADE ON UPDATE NO ACTION,
--   KEY `fk_rel_qt_tipo_cod` (`tipo_cod`) USING BTREE
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fotos_quadrinhos`
--

CREATE TABLE `fotos_quadrinhos` (
  `ftq_cod` int(11) NOT NULL PRIMARY KEY,
  `ftq_hq_cod` int(11) NOT NULL,
  `ftq_img` varchar(63) NOT NULL,
  `ftq_desc` varchar(255) DEFAULT NULL,
  CONSTRAINT `fk_ftq_hq_cod` FOREIGN KEY (`ftq_hq_cod`) REFERENCES `quadrinhos` (`hq_cod`) ON DELETE CASCADE ON UPDATE NO ACTION,
  KEY `fk_ftq_hq_cod` (`ftq_hq_cod`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `com_cod` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `com_hq_cod` int(11) NOT NULL,
  `com_us_cod` int(11) DEFAULT(NULL),
  `com_texto` text NOT NULL,
  `com_dataHoraCriacao` DATETIME NOT NULL,
  `com_dataHoraEdicao` datetime NOT NULL,
  CONSTRAINT `fk_com_hq_cod` FOREIGN KEY (`com_hq_cod`) REFERENCES `quadrinhos` (`hq_cod`) ON DELETE CASCADE ON UPDATE NO ACTION,
  KEY `fk_com_hq_cod` (`com_hq_cod`) USING BTREE,
  CONSTRAINT `fk_com_us_cod` FOREIGN KEY (`com_us_cod`) REFERENCES `usuarios` (`us_cod`) ON DELETE CASCADE ON UPDATE NO ACTION,
  KEY `fk_com_us_cod` (`com_us_cod`) USING BTREE,
  KEY `fk_com_cod` (`com_cod`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- update usuarios set us_tipo = 3 where us_cod = 1;
-- INSERT INTO quadrinhos VALUES (null, 'teste', null, null, null, '', 1, '', '',
--            '', '', '', 2.5, '', 222, true, '2020-12-05 21:36:00', '2020-12-05 21:36:00');
-- INSERT INTO quadrinhos (hq_titulo, hq_volume, hq_editora_cod, hq_valor, hq_estoque, hq_dataHoraCriacao, hq_dataHoraEdicao) VALUES ('teste', 1, 1,
--          2.5, 222, '2020-12-05 21:36:00', '2020-12-05 21:36:00');
--          select * from quadrinhos;
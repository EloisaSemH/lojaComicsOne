<?php
require_once("conexao.php");
class QuadrinhoDAO
{

    function __construct()
    {
        $this->con = new Conexao();
        $this->pdo = $this->con->Connect();
    }

    function cadastrar(Quadrinho $entQuadrinho)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO quadrinhos (
                `hq_titulo`,
                `hq_edicao`,
                `hq_volume`,
                `hq_serie`,
                `hq_tipo`,
                `hq_editora_cod`,
                `hq_lancamento`,
                `hq_numPaginas`,
                `hq_impressao`,
                `hq_faixaEtaria`,
                `hq_sinopse`,
                `hq_valor`,
                `hq_porcentagemPromocao`,
                `hq_estoque`,
                `hq_emEstoque`,
                `hq_dataHoraCriacao`,
                `hq_dataHoraEdicao`
            ) VALUES (
                :hq_titulo,
                :hq_edicao,
                :hq_volume,
                :hq_serie,
                :hq_tipo,
                :hq_editora_cod,
                :hq_lancamento,
                :hq_numPaginas,
                :hq_impressao,
                :hq_faixaEtaria,
                :hq_sinopse,
                :hq_valor,
                :hq_porcentagemPromocao,
                :hq_estoque,
                :hq_emEstoque,
                :hq_dataHoraCriacao,
                :hq_dataHoraEdicao
            )");
            $param = [
                ":hq_titulo" => $entQuadrinho->getHq_titulo(),
                ":hq_edicao" => $entQuadrinho->getHq_edicao(),
                ":hq_volume" => $entQuadrinho->getHq_volume(),
                ":hq_serie" => $entQuadrinho->getHq_serie(),
                ":hq_tipo" => $entQuadrinho->getHq_tipo(),
                ":hq_editora_cod" => $entQuadrinho->getHq_editora_cod(),
                ":hq_lancamento" => $entQuadrinho->getHq_lancamento(),
                ":hq_numPaginas" => $entQuadrinho->getHq_numPaginas(),
                ":hq_impressao" => $entQuadrinho->getHq_impressao(),
                ":hq_sinopse" => $entQuadrinho->getHq_sinopse(),
                ":hq_faixaEtaria" => $entQuadrinho->getHq_faixaEtaria(),
                ":hq_valor" => $entQuadrinho->getHq_valor(),
                ":hq_porcentagemPromocao" => $entQuadrinho->getHq_porcentagemPromocao(),
                ":hq_estoque" => $entQuadrinho->getHq_estoque(),
                ":hq_emEstoque" => $entQuadrinho->getHq_emEstoque(),
                ":hq_dataHoraCriacao" => date("Y-m-d H:i:s"),
                ":hq_dataHoraEdicao" => date("Y-m-d H:i:s"),
            ];
            if ($stmt->execute($param)) {
                $stmtid = $this->pdo->prepare("SELECT hq_cod FROM quadrinhos ORDER BY hq_cod DESC LIMIT 1");
                if ($stmtid->execute()) {
                    $id = $stmtid->fetch(PDO::FETCH_ASSOC);
                    return $id['hq_cod'];
                }
            }
        } catch (PDOException $ex) {
            echo "ERRO 201: {$ex->getMessage()}";
        }
    }

    function atualizarQuadrinho(Quadrinho $entQuadrinho)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE quadrinhos SET
            hq_titulo = :hq_titulo,
            hq_edicao = :hq_edicao,
            hq_volume = :hq_volume,
            hq_serie = :hq_serie,
            hq_tipo = :hq_tipo,
            hq_editora_cod = :hq_editora_cod,
            hq_lancamento = :hq_lancamento,
            hq_numPaginas = :hq_numPaginas,
            hq_impressao = :hq_impressao,
            hq_faixaEtaria = :hq_faixaEtaria,
            hq_sinopse = :hq_sinopse,
            hq_valor = :hq_valor,
            hq_porcentagemPromocao = :hq_porcentagemPromocao,
            hq_estoque = :hq_estoque,
            hq_emEstoque = :hq_emEstoque,
            hq_dataHoraEdicao = :hq_dataHoraEdicao
            WHERE hq_cod = :hq_cod");
            $param = array(
                ":hq_titulo" => $entQuadrinho->getHq_titulo(),
                ":hq_edicao" => $entQuadrinho->getHq_edicao(),
                ":hq_volume" => $entQuadrinho->getHq_volume(),
                ":hq_serie" => $entQuadrinho->getHq_serie(),
                ":hq_tipo" => $entQuadrinho->getHq_tipo(),
                ":hq_editora_cod" => $entQuadrinho->getHq_editora_cod(),
                ":hq_lancamento" => $entQuadrinho->getHq_lancamento(),
                ":hq_numPaginas" => $entQuadrinho->getHq_numPaginas(),
                ":hq_impressao" => $entQuadrinho->getHq_impressao(),
                ":hq_sinopse" => $entQuadrinho->getHq_sinopse(),
                ":hq_faixaEtaria" => $entQuadrinho->getHq_faixaEtaria(),
                ":hq_valor" => $entQuadrinho->getHq_valor(),
                ":hq_porcentagemPromocao" => $entQuadrinho->getHq_porcentagemPromocao(),
                ":hq_estoque" => $entQuadrinho->getHq_estoque(),
                ":hq_emEstoque" => $entQuadrinho->getHq_emEstoque(),
                ":hq_dataHoraEdicao" => date("Y-m-d H:i:s"),
                ":hq_cod" => $entQuadrinho->getHq_cod()
            );
            return $stmt->execute($param);
        } catch (PDOException $ex) {
            echo "ERRO HQ2: {$ex->getMessage()}";
        }
    }

    function excluirQuadrinho(Quadrinho $entQuadrinho)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM quadrinhos WHERE hq_cod = :hq_cod");
            $param = array(
                ":hq_cod" => $entQuadrinho->getHq_cod()
            );
            return $stmt->execute($param);
        } catch (PDOException $ex) {
            echo "ERRO 205: {$ex->getMessage()}";
        }
    }

    function desativarQuadrinho(Quadrinho $entQuadrinho)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE quadrinhos SET hq_ativo = 0 WHERE hq_cod = :hq_cod");
            $param = array(
                ":hq_cod" => $entQuadrinho->getHq_cod()
            );
            return $stmt->execute($param);
        } catch (PDOException $ex) {
            echo "ERRO 205: {$ex->getMessage()}";
        }
    }

    function contarProdutos()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(hq_cod) FROM quadrinhos");
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->rowCount();
            } else {
                return 0;
            }
        } catch (PDOException $ex) {
            echo "ERRO 202: {$ex->getMessage()}";
        }
    }

    function contarProdutosCategoria($cat_cod)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM rel_quadrinhos_categorias WHERE cat_cod = :cat_cod");
            $param = array(':cat_cod' => $cat_cod);
            $stmt->execute($param);

            if ($stmt->rowCount() > 0) {
                return $stmt->rowCount();
            } else {
                return 0;
            }
        } catch (PDOException $ex) {
            echo "ERRO 202: {$ex->getMessage()}";
        }
    }

    function pegarInfos($hq_cod)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM quadrinhos WHERE hq_cod = :hq_cod");
            $param = array(":hq_cod" => $hq_cod);
            $stmt->execute($param);

            if ($stmt->rowCount() > 0) {
                $consulta = $stmt->fetch(PDO::FETCH_ASSOC);
                $consulta['categorias'] = $this->pegarInfosRelQuadrinhoCategorias($hq_cod);
                $consulta['autores'] = $this->pegarInfosRelQuadrinhoAutores($hq_cod);
                return $consulta;
            } else {
                return '';
            }
        } catch (PDOException $ex) {
            echo "ERRO 203: {$ex->getMessage()}";
        }
    }

    function pegarInfosRelQuadrinhoCategorias($hq_cod)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT categorias.cat_cod, cat_nome FROM categorias INNER JOIN rel_quadrinhos_categorias ON categorias.cat_cod = rel_quadrinhos_categorias.cat_cod
            WHERE rel_quadrinhos_categorias.hq_cod = :hq_cod
            ORDER BY categorias.cat_nome ASC");
            $param = array(":hq_cod" => $hq_cod);
            $stmt->execute($param);
            $categorias = [];
            while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $categorias[] = $dados;
            }
            return $categorias;
        } catch (PDOException $ex) {
            echo "ERRO 203: {$ex->getMessage()}";
        }
    }

    function pegarInfosRelQuadrinhoAutores($hq_cod)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT autores.aut_cod, aut_nomeArtistico FROM autores INNER JOIN rel_quadrinhos_autores ON autores.aut_cod = rel_quadrinhos_autores.aut_cod
            WHERE rel_quadrinhos_autores.hq_cod = :hq_cod
            ORDER BY autores.aut_nomeArtistico ASC");
            $param = array(":hq_cod" => $hq_cod);
            $stmt->execute($param);
            $autores = [];
            while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $autores[] = $dados;
            }
            return $autores;
        } catch (PDOException $ex) {
            echo "ERRO 203: {$ex->getMessage()}";
        }
    }

    function tabelaProdutos($limite, $quantPag, $cat_cod)
    {
        try {
            if (is_null($cat_cod)) {
                $stmt = $this->pdo->prepare("SELECT * FROM quadrinhos
                ORDER BY hq_cod DESC LIMIT :limite, :quantPag");
                $param = [":limite" => $limite, ":quantPag" => $quantPag];
            } else {
                $stmt = $this->pdo->prepare("SELECT * FROM rel_quadrinhos_categorias INNER JOIN quadrinhos ON rel_quadrinhos_categorias.hq_cod = quadrinhos.hq_cod
                WHERE rel_quadrinhos_categorias.cat_cod = :cat_cod
                ORDER BY quadrinhos.hq_cod DESC LIMIT :limite, :quantPag");
                $param = [":cat_cod" => $cat_cod, ":limite" => $limite, ":quantPag" => $quantPag];
            }
            $stmt->execute($param);

            if ($stmt->rowCount() > 0) {
                $cel = $stmt->rowCount();
                $col = 1;
                $qtdcol = $quantPag;
                $celconstruida = 0;
                $colConstruida = 0;
                echo '<table class="table table-striped text-center" required><thead class="thead text-white bg-vermelho-claro"><tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Valor</th>
                <th>Promoção</th>
                <th>Estoque</th>
                <th>Em Estoque</th>
                <th></th>
                </tr></thead><tbody>';
                for ($a = 0; $a < $qtdcol; $a++) {
                    if ($col == 1) {
                        echo '<tr>';
                        $celconstruida++;
                    }
                    if ($celconstruida <= $cel) {
                        while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<td>' . $dados['hq_cod'] . '</td>';
                            echo '<td class="text-left">' . $dados['hq_titulo'] . '</td>';
                            echo '<td>R$' . $dados['hq_valor'] . '</td>';
                            if ($dados['hq_porcentagemPromocao']) {
                                $porcentagem = round((($dados['hq_valor'] - ($dados['hq_valor'] * $dados['hq_porcentagemPromocao']) / 100)), 2);
                                echo '<td class="text-sucess">R$' . $porcentagem . ' (' . $dados['hq_porcentagemPromocao'] . '%)</td>';
                            } else {
                                echo '<td class="text-danger"></td>';
                            }
                            echo '<td>' . $dados['hq_estoque'] . '</td>';
                            if ($dados['hq_emEstoque']) {
                                echo '<td class="text-sucess">Disponível</td>';
                            } else {
                                echo '<td class="text-danger">Indisponível</td>';
                            }
                            echo '<td><a class="text-uppercase font-weight-bold" href="' . URL::getBase() . 'editar-quadrinho/' . $dados['hq_cod'] . '">Editar</a></td>';
                            echo '</tr>';

                            $colConstruida++;
                            if ($colConstruida == $qtdcol) {
                                $colConstruida = 0;
                            }
                        }
                    }
                }
                echo '</tbody></table>';
            } else {
                echo '<a class="btn btn-outline-vermelho-claro" href="' . URL::getBase() . 'cadastrar-quadrinho">Cadastrar quadrinhos</a>';
            }
        } catch (PDOException $ex) {
            echo "ERRO 206: {$ex->getMessage()}";
        }
    }

    function pegarProdutosCategoria($hq_cat, $numCat)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM quadrinhos WHERE hq_cat = :hq_cat AND hq_ativo = 1 ORDER BY hq_nome");
            $param = array(":hq_cat" => $hq_cat);
            $stmt->execute($param);

            if ($stmt->rowCount() > 0) {
                $cont = 0;
                echo '<h2 class="text-center my-2 text-uppercase">' . $hq_cat . '</h2>';
                while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="form-check"><input type="checkbox" class="form-check-input" name="' . $numCat . '[' . $dados['hq_cod'] . ']" value="' . $dados['hq_nome'] . '" id="' . $numCat . '[' . $dados['hq_cod'] . ']" value="' . $dados['hq_nome'] . '" oninput="totalCompra(' . $numCat . ', ' . $dados['hq_cod'] . ', `' . $hq_cat . '`)">
                        <input type="number" class="qtd" name="' . $numCat . 'Qnt[' . $dados['hq_cod'] . ']" id="' . $numCat . 'Qnt[' . $dados['hq_cod'] . ']" style="width: 40px; text-align: center;" value="1" >
                        <label for="' . $numCat . '[' . $dados['hq_cod'] . ']">' . $dados['hq_nome'] . '</label> - 
                        <label for="' . $numCat . '[' . $dados['hq_cod'] . ']">R$</label>
                        <input type="number" class="preco" name="' . $numCat . 'Vlr[' . $dados['hq_cod'] . ']" value="' . str_replace(',', '.', $dados['hq_valor']) . '" id="' . $numCat . 'Vlr[' . $dados['hq_cod'] . ']" step="0.01" readonly>
                        <p class="text-muted font-italic">' . $dados['hq_desc'] . '</p>
                        <input type="hidden" id="' . $numCat . 'Id[' . $dados['hq_cod'] . ']" value="' . $dados['hq_cod'] . '">
                        </div>';
                    $cont++;
                }
            }
        } catch (PDOException $ex) {
            echo "ERRO 206: {$ex->getMessage()}";
        }
    }
}

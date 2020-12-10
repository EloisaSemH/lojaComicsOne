<?php
require_once("conexao.php");
class CategoriaDAO
{

    function __construct()
    {
        $this->con = new Conexao();
        $this->pdo = $this->con->Connect();
    }

    function cadastrar(Categoria $entCat)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO categorias VALUES (null, :cat_nome)");
            $param = array(
                ":cat_nome" => $entCat->getCat_nome(),
            );
            return $stmt->execute($param);
        } catch (PDOException $ex) {
            echo "ERRO 201: {$ex->getMessage()}";
        }
    }

    function atualizarCategoria(Categoria $entCat)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE categorias SET cat_nome = :cat_nome WHERE cat_cod = :cat_cod");
            $param = array(
                ":cat_nome" => $entCat->getCat_nome(),
                ":cat_cod" => $entCat->getCat_cod()
            );
            return $stmt->execute($param);
        } catch (PDOException $ex) {
            echo "ERRO 204: {$ex->getMessage()}";
        }
    }

    function excluirCategoria(Categoria $entCat)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM categorias WHERE cat_cod = :cat_cod");
            $param = array(
                ":cat_cod" => $entCat->getCat_cod()
            );
            return $stmt->execute($param);
        } catch (PDOException $ex) {
            echo "ERRO 205: {$ex->getMessage()}";
        }
    }

    function cadastrarRelacaoQuadrinho(Categoria $entCat)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO rel_quadrinhos_categorias VALUES (:hq_cod, :cat_cod)");
            $param = array(
                ":hq_cod" => $entCat->getHq_cod(),
                ":cat_cod" => $entCat->getCat_cod(),
            );
            return $stmt->execute($param);
        } catch (PDOException $ex) {
            echo "ERRO 201: {$ex->getMessage()}";
        }
    }

    function verificarRelacaoQuadrinho($hq_cod, $cat_cod)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT FROM rel_quadrinhos_categorias WHERE hq_cod = :hq_cod AND cat_cod = :cat_cod");
            $param = array(
                ":hq_cod" => $hq_cod,
                ":cat_cod" => $cat_cod,
            );
            return $stmt->execute($param);
        } catch (PDOException $ex) {
            echo "ERRO 201: {$ex->getMessage()}";
        }
    }

    function excluirRelacaoQuadrinho($hq_cod, $cat_cod)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM rel_quadrinhos_categorias WHERE hq_cod = :hq_cod AND cat_cod = :cat_cod)");
            $param = array(
                ":hq_cod" => $hq_cod,
                ":cat_cod" => $cat_cod,
            );
            return $stmt->execute($param);
        } catch (PDOException $ex) {
            echo "ERRO 201: {$ex->getMessage()}";
        }
    }

    function contarCategorias()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(cat_cod) FROM categorias");
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

    function todasCategorias()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM categorias");
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $retorno[] = $dados;
                }
                return $retorno;
            } else {
                return '';
            }
        } catch (PDOException $ex) {
            echo "ERRO 203: {$ex->getMessage()}";
        }
    }

    function pegarInfos($cat_cod)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM categorias WHERE cat_cod = :cat_cod");
            $param = array(":cat_cod" => $cat_cod);
            $stmt->execute($param);

            if ($stmt->rowCount() > 0) {
                $consulta = $stmt->fetch(PDO::FETCH_ASSOC);
                return $consulta;
            } else {
                return '';
            }
        } catch (PDOException $ex) {
            echo "ERRO 203: {$ex->getMessage()}";
        }
    }

    function pegar1Categoria()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM categorias LIMIT 1");
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return '';
            }
        } catch (PDOException $ex) {
            echo "ERRO 203: {$ex->getMessage()}";
        }
    }

    function tabelaCategorias($limite, $quantPag, $orderby)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM categorias ORDER BY :orderby LIMIT :limite, :quantPag");
            $param = array(":limite" => $limite, ":quantPag" => $quantPag, ":orderby" => $orderby);
            $stmt->execute($param);

            if ($stmt->rowCount() > 0) {
                $cel = $stmt->rowCount();
                $col = 1;
                $qtdcol = $quantPag;
                $celconstruida = 0;
                $colConstruida = 0;
                echo '<table class="table table-striped text-center"><thead class="thead text-white bg-vermelho-claro">
                <th>ID</th><th>Título da categoria</th><th></th></thead><tbody>';
                for ($a = 0; $a < $qtdcol; $a++) {
                    if ($col == 1) {
                        echo '<tr>';
                        $celconstruida++;
                    }
                    if ($celconstruida <= $cel) {
                        while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {

                            echo '<td>' . $dados['cat_cod'] . '</td>';
                            echo '<td class="text-left">' . $dados['cat_nome'] . '</td>';
                            echo '<td><a class="text-uppercase font-weight-bold" href="' . URL::getBase() . 'editarcategoria&id=' . $dados['cat_cod'] . '">Editar</a></td>';
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
                echo '<a class="btn btn-outline-vermelho-claro" href="' . URL::getBase() . 'cadastrar-categoria">Cadastrar categoria</a>';
            }
        } catch (PDOException $ex) {
            echo "ERRO 206: {$ex->getMessage()}";
        }
    }

    function selectCategoria($antigaCat = '')
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM categorias ORDER BY cat_nome");
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($dados['cat_cod'] != $antigaCat) {
                        echo '<option value="' . $dados['cat_cod'] . '">' . $dados['cat_nome'] . '</option>';
                    } else {
                        echo '<option value="' . $antigaCat . '" selected>' . $dados['cat_nome'] . '</option>';
                    }
                }
            } else {
                echo '<script type="text/javascript">
                alert("Cadastre categorias primeiro!");
                document.location.href = "' . URL::getBase() . 'cadastrar-categoria";
                </script>';
            }
        } catch (PDOException $ex) {
            echo "ERRO 206: {$ex->getMessage()}";
        }
    }
}

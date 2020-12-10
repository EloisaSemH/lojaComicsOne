<?php
require_once("conexao.php");
class EditoraDAO
{

    function __construct()
    {
        $this->con = new Conexao();
        $this->pdo = $this->con->Connect();
    }

    function cadastrar(Editora $entEdi)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO editoras VALUES (null, :edi_nome, :edi_sobre, :edi_pais, :edi_site, :edi_dataHoraCriacao, :edi_dataHoraEdicao)");
            $param = array(
                ":edi_nome" => $entEdi->getEdi_nome(),
                ":edi_sobre" => $entEdi->getEdi_sobre(),
                ":edi_pais" => $entEdi->getEdi_pais(),
                ":edi_site" => $entEdi->getEdi_site(),
                ":edi_dataHoraCriacao" => date("Y-m-d H:i:s"),
                ":edi_dataHoraEdicao" => date("Y-m-d H:i:s"),
            );
            return $stmt->execute($param);
        } catch (PDOException $ex) {
            echo "ERRO 201: {$ex->getMessage()}";
        }
    }

    function atualizarEditora(Editora $entEdi)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE editoras SET edi_nome = :edi_nome, edi_sobre = :edi_sobre, edi_pais = :edi_pais,
            edi_site = :edi_site, edi_dataHoraEdicao = :edi_dataHoraEdicao WHERE edi_cod = :edi_cod");
            $param = array(
                ":edi_nome" => $entEdi->getEdi_nome(),
                ":edi_sobre" => $entEdi->getEdi_sobre(),
                ":edi_pais" => $entEdi->getEdi_pais(),
                ":edi_site" => $entEdi->getEdi_site(),
                ":edi_cod" => $entEdi->getEdi_cod(),
                ":edi_dataHoraEdicao" => date("Y-m-d H:i:s"),
            );
            return $stmt->execute($param);
        } catch (PDOException $ex) {
            echo "ERRO 204: {$ex->getMessage()}";
        }
    }

    function excluirEditora(Editora $entEdi)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM editoras WHERE edi_cod = :edi_cod");
            $param = array(
                ":edi_cod" => $entEdi->getEdi_cod()
            );
            return $stmt->execute($param);
        } catch (PDOException $ex) {
            echo "ERRO 205: {$ex->getMessage()}";
        }
    }

    function contarEditoras()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(edi_cod) FROM editoras");
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

    function pegarInfos($edi_cod)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM editoras WHERE edi_cod = :edi_cod");
            $param = array(":edi_cod" => $edi_cod);
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

    function pegarPais($edi_cod)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT edi_pais FROM editoras WHERE edi_cod = :edi_cod");
            $param = array(":edi_cod" => $edi_cod);
            $stmt->execute($param);

            if ($stmt->rowCount() > 0) {
                $consulta = $stmt->fetch(PDO::FETCH_ASSOC);
                return $consulta['edi_pais'];
            } else {
                return '';
            }
        } catch (PDOException $ex) {
            echo "ERRO 203: {$ex->getMessage()}";
        }
    }

    function todasEditoras()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM editoras ORDER BY edi_prioridade");
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $retorno[$dados['edi_cod']] = ['edi_cod' => $dados['edi_cod'], 'edi_nome' => $dados['edi_nome']];
                }
                return $retorno;
            } else {
                return '';
            }
        } catch (PDOException $ex) {
            echo "ERRO 203: {$ex->getMessage()}";
        }
    }

    function tabelaEditoras($limite, $quantPag, $orderby)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM editoras ORDER BY :orderby LIMIT :limite, :quantPag");
            $param = array(":limite" => $limite, ":quantPag" => $quantPag, ":orderby" => $orderby);
            $stmt->execute($param);

            if ($stmt->rowCount() > 0) {
                $cel = $stmt->rowCount();
                $col = 1;
                $qtdcol = $quantPag;
                $celconstruida = 0;
                $colConstruida = 0;
                echo '<table class="table table-striped text-center"><thead class="thead text-white bg-vermelho-claro">
                <th>ID</th>
                <th>Nome</th>
                <th></th>
                </thead><tbody>';
                for ($a = 0; $a < $qtdcol; $a++) {
                    if ($col == 1) {
                        echo '<tr>';
                        $celconstruida++;
                    }
                    if ($celconstruida <= $cel) {
                        while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {

                            echo '<td>' . $dados['edi_cod'] . '</td>';
                            echo '<td class="text-left">' . $dados['edi_nome'] . '</td>';
                            echo '<td><a class="text-uppercase font-weight-bold" href="' . URL::getBase() . 'editar-editora/' . $dados['edi_cod'] . '">Editar</a></td>';
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
                echo '<a class="btn btn-outline-warning" href="' . URL::getBase() . 'cadastrar-editora">Cadastrar editoras</a>';
            }
        } catch (PDOException $ex) {
            echo "ERRO 206: {$ex->getMessage()}";
        }
    }

    function pegarEditoras($edi_nome)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM editoras WHERE edi_nome = :edi_nome AND edi_ativo = 1 ORDER BY edi_nome");
            $param = array(":edi_nome" => $edi_nome);
            $stmt->execute($param);

            if ($stmt->rowCount() > 0) {
                $cont = 0;
                echo '<h2 class="text-center text-capitalize my-2">' . $edi_nome . '</h2>';
                while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<input type="checkbox" name="' . $dados['edi_nome'] . '[' . $cont . ']" value="' . $dados['edi_nome'] . '">
                        <input type="number" class="qtd" name="' . $dados['edi_nome'] . 'Qnt[' . $cont . ']" style="width: 40px; text-align: center;" value="1">
                        <label for="impg">' . $dados['edi_nome'] . '</label>
                        <label for="preco">R$</label>
                        <input type="number" class="preco" name="' . $dados['edi_nome'] . 'Vlr[' . $cont . ']" value="' . $dados['edi_prioridade'] . '" readonly>
                        <br>';
                    $cont++;
                }
            }
        } catch (PDOException $ex) {
            echo "ERRO 206: {$ex->getMessage()}";
        }
    }

    function selectEditora(string $antigaCat = '')
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM editoras ORDER BY edi_nome");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                echo '<select class="form-control ls-select" name="hqEditora" required>';
                while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($dados['edi_nome'] != $antigaCat) {
                        echo '<option value="' . $dados['edi_cod'] . '">' . $dados['edi_nome'] . '</option>';
                    } else {
                        echo '<option value="' . $antigaCat . '" selected>' . $dados['edi_nome'] . '</option>';
                    }
                }
                echo '</select>';
            } else {
                echo '<script type="text/javascript">
                alert("Cadastre editoras primeiro!");
                document.location.href = "' . URL::getBase() . 'cadastrar-editora";
                </script>';
            }
        } catch (PDOException $ex) {
            echo "ERRO 206: {$ex->getMessage()}";
        }
    }
}

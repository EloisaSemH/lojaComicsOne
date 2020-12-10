<?php
require_once("conexao.php");
class AutorDAO
{

    function __construct()
    {
        $this->con = new Conexao();
        $this->pdo = $this->con->Connect();
    }

    function cadastrar(Autor $entAut)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO autores VALUES (null, :aut_nomeArtistico, :aut_nomeVerdadeiro, :aut_genero, :aut_sobre, :aut_pais, :aut_site, :aut_dataHoraCriacao, :aut_dataHoraEdicao)");
            $param = array(
                ":aut_nomeArtistico" => $entAut->getAut_nomeArtistico(),
                ":aut_nomeVerdadeiro" => $entAut->getAut_nomeVerdadeiro(),
                ":aut_genero" => $entAut->getAut_genero(),
                ":aut_sobre" => $entAut->getAut_sobre(),
                ":aut_pais" => $entAut->getAut_pais(),
                ":aut_site" => $entAut->getAut_site(),
                ":aut_dataHoraCriacao" => date("Y-m-d H:i:s"),
                ":aut_dataHoraEdicao" => date("Y-m-d H:i:s"),
            );
            return $stmt->execute($param);
        } catch (PDOException $ex) {
            echo "ERRO 201: {$ex->getMessage()}";
        }
    }

    function atualizarAutor(Autor $entAut)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE autores SET aut_nomeArtistico = :aut_nomeArtistico, aut_nomeVerdadeiro = :aut_nomeVerdadeiro, aut_genero = :aut_genero, aut_sobre = :aut_sobre, aut_pais = :aut_pais, aut_site = :aut_site, aut_dataHoraEdicao = :aut_dataHoraEdicao WHERE aut_cod = :aut_cod");
            $param = array(
                ":aut_nomeArtistico" => $entAut->getAut_nomeArtistico(),
                ":aut_nomeVerdadeiro" => $entAut->getAut_nomeVerdadeiro(),
                ":aut_genero" => $entAut->getAut_genero(),
                ":aut_sobre" => $entAut->getAut_sobre(),
                ":aut_pais" => $entAut->getAut_pais(),
                ":aut_site" => $entAut->getAut_site(),
                ":aut_dataHoraEdicao" => date("Y-m-d H:i:s"),
                ":aut_cod" => $entAut->getAut_cod()
            );
            return $stmt->execute($param);
        } catch (PDOException $ex) {
            echo "ERRO 204: {$ex->getMessage()}";
        }
    }

    function excluirAutor(Autor $entAut)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM autores WHERE aut_cod = :aut_cod");
            $param = array(
                ":aut_cod" => $entAut->getAut_cod()
            );
            return $stmt->execute($param);
        } catch (PDOException $ex) {
            echo "ERRO 205: {$ex->getMessage()}";
        }
    }

    function cadastrarRelacaoQuadrinho(Autor $entAut)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO rel_quadrinhos_autores VALUES (:hq_cod, :aut_cod)");
            $param = array(
                ":hq_cod" => $entAut->getHq_cod(),
                ":aut_cod" => $entAut->getAut_cod(),
            );
            return $stmt->execute($param);
        } catch (PDOException $ex) {
            echo "ERRO 201: {$ex->getMessage()}";
        }
    }

    function contarAutores()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT aut_cod FROM autores");
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

    function pegarInfos($aut_cod)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM autores WHERE aut_cod = :aut_cod");
            $param = array(":aut_cod" => $aut_cod);
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

    function pegarPais($aut_cod)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT aut_pais FROM autores WHERE aut_cod = :aut_cod");
            $param = array(":aut_cod" => $aut_cod);
            $stmt->execute($param);

            if ($stmt->rowCount() > 0) {
                $consulta = $stmt->fetch(PDO::FETCH_ASSOC);
                return $consulta['aut_pais'];
            } else {
                return '';
            }
        } catch (PDOException $ex) {
            echo "ERRO 203: {$ex->getMessage()}";
        }
    }

    function tabelaAutores($limite, $quantPag, $orderby)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM autores ORDER BY :orderby LIMIT :limite, :quantPag");
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
                <th>Nome artístico</th>
                <th>Nome verdadeiro</th>
                <th></th>
                </thead><tbody>';
                for ($a = 0; $a < $qtdcol; $a++) {
                    if ($col == 1) {
                        echo '<tr>';
                        $celconstruida++;
                    }
                    if ($celconstruida <= $cel) {
                        while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {

                            echo '<td>' . $dados['aut_cod'] . '</td>';
                            echo '<td class="text-left">' . $dados['aut_nomeArtistico'] . '</td>';
                            echo '<td class="text-left">' . $dados['aut_nomeVerdadeiro'] . '</td>';
                            echo '<td><a class="text-uppercase font-weight-bold" href="' . URL::getBase() . 'editar-autor/' . $dados['aut_cod'] . '">Editar</a></td>';
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
                echo '<a class="btn btn-outline-vermelho-claro" href="' . URL::getBase() . 'cadastrar-autor">Cadastrar autores</a>';
            }
        } catch (PDOException $ex) {
            echo "ERRO 206: {$ex->getMessage()}";
        }
    }

    function selectAutor(string $antigoAutor = '')
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM autores ORDER BY aut_nomeArtistico");
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($dados['aut_cod'] != $antigoAutor) {
                        echo '<option value="' . $dados['aut_cod'] . '">' . $dados['aut_nomeArtistico'] . '</option>';
                    }else{
                    echo '<option value="' . $antigoAutor . '" selected>' . $dados['aut_nomeArtistico'] . '</option>';

                    }
                }
            } else {
                echo '<script type="text/javascript">
                alert("Cadastre autores primeiro!");
                document.location.href = "' . URL::getBase() . 'cadastrar-autor";
                </script>';
            }
        } catch (PDOException $ex) {
            echo "ERRO 206: {$ex->getMessage()}";
        }
    }
}

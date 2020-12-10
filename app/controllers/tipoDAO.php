<?php
require_once ("conexao.php");
class TipoDAO {

    function __construct() {
        $this->con = new Conexao();
        $this->pdo = $this->con->Connect();
    }

    function cadastrar(Tipo $entTipo) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO tipos VALUES (null, :tipo_nome)");
            $param = array(
                ":tipo_nome" => $entTipo->getTipo_nome(),
            );
            return $stmt->execute($param);
        } catch (PDOException $ex) {
            echo "ERRO 201: {$ex->getMessage()}";
        }
    }

    function atualizarTipo(Tipo $entTipo){
        try {
            $stmt = $this->pdo->prepare("UPDATE tipos SET tipo_nome = :tipo_nome WHERE tipo_cod = :tipo_cod");
            $param = array(
                ":tipo_nome" => $entTipo->getTipo_nome(),
                ":tipo_cod" => $entTipo->getTipo_cod()
            );
            return $stmt->execute($param);

        } catch (PDOException $ex) {
            echo "ERRO 204: {$ex->getMessage()}";
        }
    }

    function excluirTipo(Tipo $entTipo){
        try {
            $stmt = $this->pdo->prepare("DELETE FROM tipos WHERE tipo_cod = :tipo_cod");
            $param = array(
                ":tipo_cod" => $entTipo->getTipo_cod()
            );
            return $stmt->execute($param);

        } catch (PDOException $ex) {
            echo "ERRO 205: {$ex->getMessage()}";
        }
    }

    function contarTipos() {
        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(tipo_cod) FROM tipos");
            $stmt->execute();
            
            if($stmt->rowCount() > 0){
                return $stmt->rowCount();
            }else{
                return 0;
            }
        } catch (PDOException $ex) {
            echo "ERRO 202: {$ex->getMessage()}";
        }
    }

    function todosTipos() {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM tipos");
            $stmt->execute();
            
            if($stmt->rowCount() > 0){
                while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $retorno[] = $dados;
                }
                return $retorno;
            }else{
                return 0;
            }
        } catch (PDOException $ex) {
            echo "ERRO 202: {$ex->getMessage()}";
        }
    }

    function pegarInfos($tipo_cod){
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM tipos WHERE tipo_cod = :tipo_cod");
            $param = array(":tipo_cod" => $tipo_cod);
            $stmt->execute($param);
            
            if($stmt->rowCount() > 0){
                $consulta = $stmt->fetch(PDO::FETCH_ASSOC);
                return $consulta;
            }else{
                return '';
            }
        } catch (PDOException $ex) {
            echo "ERRO 203: {$ex->getMessage()}";
        }
    }

    function todasTipos(){
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM tipos ORDER BY tipo_prioridade");
            $stmt->execute();
            
            if($stmt->rowCount() > 0){
                while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $retorno[$dados['tipo_cod']] = ['tipo_cod' => $dados['tipo_cod'], 'tipo_nome' => $dados['tipo_nome']];
                }
                return $retorno;
            }else{
                return '';
            }
        } catch (PDOException $ex) {
            echo "ERRO 203: {$ex->getMessage()}";
        }
    }

    function tabelaTipos($limite, $quantPag, $orderby){
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM tipos ORDER BY :orderby LIMIT :limite, :quantPag");
            $param = array(":limite" => $limite, ":quantPag" => $quantPag, ":orderby" => $orderby);
            $stmt->execute($param);
            
            if($stmt->rowCount() > 0){
                $cel = $stmt->rowCount();
                $col = 1;
                $qtdcol = $quantPag;
                $celconstruida = 0;
                $colConstruida = 0;
                echo '<table class="table table-striped text-center"><thead class="thead text-white bg-vermelho-claro">
                <th>ID</th><th>Tipo</th><th></th></thead><tbody>';   
                for ($a = 0; $a < $qtdcol; $a++) {
                    if ($col == 1) {
                        echo '<tr>';
                        $celconstruida++;
                    }
                    if ($celconstruida <= $cel) {
                        while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            
                            echo '<td>' . $dados['tipo_cod'] . '</td>';
                            echo '<td class="text-left">' . $dados['tipo_nome'] . '</td>';
                            echo '<td><a class="text-uppercase font-weight-bold" href="' . URL::getBase() . 'editarTipo&id=' . $dados['tipo_cod'] . '">Editar</a></td>';
                            echo '</tr>';

                            $colConstruida++;
                            if($colConstruida == $qtdcol){
                                $colConstruida = 0;
                            }
                        }
                    }
                }
            echo '</tbody></table>';
            }else{
                echo '<a class="btn btn-outline-warning" href="' . URL::getBase() . 'cadastrar-tipo">Cadastrar Tipo</a>';
            }
        }catch (PDOException $ex){
            echo "ERRO 206: {$ex->getMessage()}";
        }
    }

    function pegarTipo($tipo_nome){
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM Tipo WHERE tipo_nome = :tipo_nome AND tipo_ativo = 1 ORDER BY tipo_nome");
            $param = array(":tipo_nome" => $tipo_nome);
            $stmt->execute($param);
            
            if($stmt->rowCount() > 0){
                $cont = 0;
                echo '<h2 class="text-center text-capitalize my-2">' . $tipo_nome . '</h2>';
                while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
                    echo '<input type="checkbox" name="' . $dados['tipo_nome'] . '[' . $cont . ']" value="' . $dados['tipo_nome'] . '">
                        <input type="number" class="qtd" name="' . $dados['tipo_nome'] . 'Qnt[' . $cont . ']" style="width: 40px; text-align: center;" value="1">
                        <label for="impg">' . $dados['tipo_nome'] . '</label>
                        <label for="preco">R$</label>
                        <input type="number" class="preco" name="' . $dados['tipo_nome'] . 'Vlr[' . $cont . ']" value="' . $dados['tipo_prioridade'] . '" readonly>
                        <br>';
                    $cont++;
                }
                
            }

        }catch (PDOException $ex){
            echo "ERRO 206: {$ex->getMessage()}";
        }
    }

    function selectTipo(string $antigaCat = ''){
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM tipos ORDER BY tipo_nome");
            // $param = array();
            $stmt->execute();
            
            if($stmt->rowCount() > 0){
                echo '<select class="form-control ls-select" name="hqTipo" id="pesquisa" required>'; 
                if($antigaCat != ''){
                    echo '<option value="'. $antigaCat .'">'. $antigaCat .'</option>';
                }
                while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
                    if($dados['tipo_nome'] != $antigaCat){
                        echo '<option value="'. $dados['tipo_nome'] .'">'. $dados['tipo_nome'] .'</option>';
                    }
                }
                echo '</select>';
            }else{
                echo '<script type="text/javascript">
                alert("Cadastre tipos primeiro!");
                document.location.href = "' . URL::getBase() . 'cadastrar-tipo";
                </script>';
            }

        }catch (PDOException $ex){
            echo "ERRO 206: {$ex->getMessage()}";
        }
    }

    function selecaoTiposPedido(){
        try {
            $stmt = $this->pdo->prepare("SELECT tipo_nome FROM tipos ORDER BY tipo_prioridade");
            // $param = array();
            $stmt->execute();
            
            if($stmt->rowCount() > 0){
                $i = 0;
                while($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $i++;
                    if($i === 1){
                        $ativo = 'active';
                    }else{
                        $ativo = '';
                    }
                    echo '<a class="list-group-item list-group-item-action text-uppercase '. $ativo . '" id="list-'. $dados['tipo_nome'] . '-list" data-toggle="list" href="#list-'. $dados['tipo_nome'] . '" role="tab" aria-controls="'. $dados['tipo_nome'] . '">'. $dados['tipo_nome'] . '</a>';
                }
            }else{
                echo '<script type="text/javascript">
                alert("Cadastre tipos primeiro!");
                document.location.href = "' . URL::getBase() . 'cadastrar-tipo";
                </script>';
            }

        }catch (PDOException $ex){
            echo "ERRO 206: {$ex->getMessage()}";
        }
    }
}

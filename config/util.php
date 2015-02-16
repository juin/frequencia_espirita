<?
	//Define Parametros do sistema
	$url_site = "http://www.pronano.com.br/ena2015/";
	
	// verifica se ocorreu um envio do formulario atraves do metodo POST
	function isPostBack() { 
	    return ($_SERVER['REQUEST_METHOD'] == 'POST');
	}

  	/**
     * Método que conecta e SELECIONA o banco de dados
     */
    function conectarBD() {
        //servidor,usuário_bd,usuario_bd_senha,BD
		$mysqli = new mysqli('localhost', 'root', 'nano2012', 'ceac');
        /* check connection */
        if (mysqli_connect_errno()) {
            printf("Falha na Conexão: %s\n", mysqli_connect_error());
            exit();
        }
        return $mysqli;
    }

    function consultar($query) {
        $mysqli = conectarBD();
        $resultado = $mysqli->query($query);

		if($mysqli->errno!=0)
			printf("Codigo de erro: %d\n", $mysqli->errno);
		
        $registros = null;
        $i = 0;

        while ($saida = $resultado->fetch_array(MYSQLI_BOTH)) {
            $registros[$i] = $saida;
            $i++;
        }
		$mysqli -> close();
        return $registros;
    }
	
	function fecharDB(){
		
	}

    function inserir($query) {
        $mysqli = conectarBD();
        $res = $mysqli->query($query);
		 
        $id = $mysqli->insert_id;
		if($mysqli->errno!=0)
			printf("Codigo de erro: %d\n", $mysqli->errno);
        $mysqli->close();
        return $id;
    }

    function atualizar($query){
        $mysqli = conectarBD();
        $mysqli->query($query);
        $resultado = $mysqli->affected_rows;        
        $mysqli->close();
        return $resultado;   
    }
	
	function lista_cidades($id_estado){
		$mysqli = conectarBD();
		$sql = "SELECT * FROM cidade WHERE id_estado = '$id_estado' ORDER BY nome";
		$rs = $mysqli->query($query);

		while($reg = mysql_fetch_object($rs)){
	    	echo "<option value='$reg->id_cidade'>$reg->nome</option>";
		}
	}
	
	//Muda o padrão de data do SQL para "Normal" (YYYY-MM-DD => DD-MM-YYYY)
	function arrumaData($data){
		$data_tmp = explode("-",$data);
		$data = $data_tmp[2]."/".$data_tmp[1]."/".$data_tmp[0];
		return $data;
	}
	
	function formataCpf($cpf){
		if ($cpf!=""){
			$a= substr("$cpf", 0,3);
			$b= substr("$cpf", 4,3);
			$c1= substr("$cpf", 8,3);
			$d= substr("$cpf", 12,2);
			 return $a.$b.$c1.$d;
		}else{
			return null;
		}
	}
	
	//Montar data 02/10/2012 -> 2014-01-31
	function formataData($data){
		if ($data!=""){
			$a= substr("$data", 0,2);
			$b= substr("$data", 3,2);
			$c= substr("$data", 6,4);
			$d= "-";
			return $c.$d.$b.$d.$a;
		}else{
			return null;
		}
	}
	
	//Aqui eh retirado a mascara do CEP (com mascara: 45.000-000)
	function formataCep($cep){
		if ($cep!=""){
			$a= substr("$cep", 0,2);
			$b= substr("$cep", 3,3);
			$c= substr("$cep", 7,3);
			return $a.$b.$c;
		}else{
			return null;
		}
	}
	
	//Aqui eh retirado a mascara do Telefone (Mascara: 77.9999-0000)
	function formataTelefone($telefone){
		if ($telefone!=""){
			$a= substr("$telefone", 0,2);
			$b= substr("$telefone", 3,4);
			$c= substr("$telefone", 8,4);
			return $a.$b.$c;
		}else{
			return null;
		}
	}
	
	//Função para remover código malicioso dos campos
	function removerCodigoMalicioso($comSeguranca) {
        $comSeguranca = addslashes($comSeguranca);
        $comSeguranca = htmlspecialchars($comSeguranca);
        $comSeguranca = str_replace("SELECT", "", $comSeguranca);
        $comSeguranca = str_replace("FROM", "", $comSeguranca);
        $comSeguranca = str_replace("WHERE", "", $comSeguranca);
        $comSeguranca = str_replace("INSERT", "", $comSeguranca);
        $comSeguranca = str_replace("UPDATE", "", $comSeguranca);
        $comSeguranca = str_replace("DELETE", "", $comSeguranca);
        $comSeguranca = str_replace("DROP", "", $comSeguranca);
        $comSeguranca = str_replace("DATABASE", "", $comSeguranca);
        return $comSeguranca;
    }

	function consultarVagasDisponiveisPorCodigoAtividade($codigo,$vagas){
		$sql = "SELECT COUNT(*) as qtd FROM Inscricao i 
		WHERE i.ultima_inscricao='sim' AND i.codigo_atividade = ".$codigo;
		$total_inscricoes = consultar($sql);
		$disponiveis = $vagas - $total_inscricoes[0][0];
		
		return $disponiveis; 
	}
	
	function consultarInscricoesporEstado($uf,$status){
		$sql = "SELECT COUNT(*) as inscricoes FROM Inscricao i, Pessoa p, Cidade c, Estado e 
		WHERE i.codigo_pessoa = p.codigo AND p.codigo_cidade = c.codigo AND c.codigo_estado = e.codigo 
		AND i.ultima_inscricao = 'sim' AND i.status = '".$status."' AND e.codigo = ".$uf;
		$inscricoes = consultar($sql);
		$inscricoes = $inscricoes[0][0];
		return $inscricoes;
	}
	
	function consultarInscricoesPorCondir($condir,$status,$ultima_inscricao,$tipo){
		$sql = "SELECT COUNT(*) as inscricoes FROM Inscricao i, Pessoa p, Pessoa_Complementar pc, 
		Cidade c, Estado e, Condir con 
		WHERE i.codigo_pessoa = p.codigo AND p.codigo_cidade = c.codigo AND c.codigo_estado = e.codigo 
		AND p.codigo = pc.codigo_pessoa 
		AND e.codigo_condir = con.codigo AND i.ultima_inscricao = '".utf8_decode($ultima_inscricao)."' 
		AND con.codigo = ".$condir." AND i.tipo LIKE '".$tipo."' AND i.status LIKE '".$status."'";
		
		$inscricoes = consultar($sql);
		$inscricoes = $inscricoes[0][0];
		return $inscricoes;
	}

	function listarInscricoesPorCondir($condir,$status,$ultima_inscricao,$tipo){
		
		$sql = "SELECT i.codigo,p.nome as nome_completo,p.cpf,pc.faixa_etaria,i.data_hora,i.tipo,c.nome as cidade,
		e.sigla as uf,i.status FROM Inscricao i, Pessoa p, Pessoa_Complementar pc, 
		Cidade c, Estado e, Condir con 
		WHERE i.codigo_pessoa = p.codigo AND p.codigo_cidade = c.codigo AND c.codigo_estado = e.codigo 
		AND p.codigo = pc.codigo_pessoa 
		AND e.codigo_condir = con.codigo AND i.ultima_inscricao = '".utf8_decode($ultima_inscricao)."' AND i.status LIKE '".$status."' 
		AND con.codigo = ".$condir." AND i.tipo LIKE '".$tipo."'";
		
		$inscricoes = consultar($sql);
		return $inscricoes;
	}
	
		function listarInscricoesPorEstado($estado,$status,$ultima_inscricao,$tipo){
		if($tipo == "Jovem"){
			$sql = "SELECT i.codigo,p.nome,p.cpf,pc.faixa_etaria,i.data_hora,c.nome,i.tipo FROM Inscricao i, Pessoa p, Pessoa_Complementar pc, 
			Cidade c, Estado e, Condir con 
			WHERE i.codigo_pessoa = p.codigo AND p.codigo_cidade = c.codigo AND c.codigo_estado = e.codigo 
			AND p.codigo = pc.codigo_pessoa 
			AND e.codigo_condir = con.codigo AND i.ultima_inscricao = '".utf8_decode($ultima_inscricao)."' AND i.status LIKE '".$status."' 
			AND e.sigla = '".$estado."' AND pc.faixa_etaria = '".$tipo."'";
		} else if($tipo == "Adulto"){
			$sql = "SELECT i.codigo,p.nome,p.cpf,pc.faixa_etaria,i.data_hora,c.nome,i.tipo FROM Inscricao i, Pessoa p, Pessoa_Complementar pc, 
			Cidade c, Estado e, Condir con 
			WHERE i.codigo_pessoa = p.codigo AND p.codigo_cidade = c.codigo AND c.codigo_estado = e.codigo 
			AND p.codigo = pc.codigo_pessoa 
			AND e.codigo_condir = con.codigo AND i.ultima_inscricao = '".utf8_decode($ultima_inscricao)."' AND i.status LIKE '".$status."' 
			AND e.sigla = '".$estado."' AND pc.faixa_etaria != '15-24'";
		} else{
			$sql = "SELECT i.codigo,p.nome as nome_completo,p.cpf,pc.faixa_etaria,
			i.tipo,i.data_hora,c.nome as cidade, i.status 
			FROM Inscricao i, Pessoa p, Pessoa_Complementar pc, 
			Cidade c, Estado e, Condir con 
			WHERE i.codigo_pessoa = p.codigo AND p.codigo_cidade = c.codigo AND c.codigo_estado = e.codigo 
			AND p.codigo = pc.codigo_pessoa 
			AND e.codigo_condir = con.codigo AND i.ultima_inscricao = '".utf8_decode($ultima_inscricao)."' AND i.status LIKE '".$status."' 
			AND e.sigla = '".$estado."'";
		}
		$inscricoes = consultar($sql);
		return $inscricoes;
	}
	
	function consultarVagasPorCondir($condir,$tipo){
		if($tipo == "Adulto")
			$sql = "SELECT vaga_adulto FROM Condir WHERE codigo = ".$condir;
		else if($tipo == "Jovem")
			$sql = "SELECT vaga_jovem FROM Condir WHERE codigo = ".$condir;
		else 
			$sql = "SELECT vaga_jovem + vaga_adulto FROM Condir WHERE codigo = ".$condir;
		$vagas = consultar($sql);
		$vagas = $vagas[0][0];
		
		return $vagas;
	}
	
	function consultarVagasDisponiveisPorCondir($condir,$tipo){
		if($tipo == "Jovem"){
			$vagas = consultarVagasPorCondir($condir,"Jovem");
			$inscricoes = consultarInscricoesPorCondir($condir,'Em Andamento','Sim','Jovem') + 
				consultarInscricoesPorCondir($condir,'Paga','Sim','Jovem') +
				consultarInscricoesPorCondir($condir,'Confirmada','Sim','Jovem');	
		} else if($tipo == "Adulto"){
			$vagas = consultarVagasPorCondir($condir,"Adulto");
			$inscricoes = consultarInscricoesPorCondir($condir,'Em Andamento','Sim','Adulto') + 
				consultarInscricoesPorCondir($condir,'Paga','Sim','Adulto') +
				consultarInscricoesPorCondir($condir,'Confirmada','Sim','Adulto');
		} else{
			$vagas = consultarVagasPorCondir($condir,"Adulto") + consultarVagasPorCondir($condir,"Jovem");
			$inscricoes = consultarInscricoesPorCondir($condir,'Em Andamento','Sim','Todos') + 
				consultarInscricoesPorCondir($condir,'Paga','Sim','Todos') +
				consultarInscricoesPorCondir($condir,'Confirmada','Sim','Todos');
		}
		return $vagas - $inscricoes;
	}
	
	function consultarInscricaoPorCodigo($codigo){
		if (isset($codigo)) {
		    $sql = "SELECT i.codigo,p.nome as nome_completo,p.cpf,pc.faixa_etaria,i.data_hora,
		    c.nome as cidade, e.nome as uf,i.status, con.codigo as condir,i.tipo FROM Inscricao i, Pessoa p, Pessoa_Complementar pc, 
			Cidade c, Estado e, Condir con 
			WHERE i.codigo_pessoa = p.codigo AND p.codigo_cidade = c.codigo AND c.codigo_estado = e.codigo 
			AND p.codigo = pc.codigo_pessoa 
			AND e.codigo_condir = con.codigo AND i.ultima_inscricao = 'Sim' AND i.codigo = ".$codigo;
			return consultar($sql);
		}
	}
?>
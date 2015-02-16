<?php
require_once '../topo.php';

$sql = "SELECT * FROM Bairro ORDER BY nome";
$bairros = consultar($sql);

$sql = "SELECT * FROM Cidade ORDER BY nome";
$cidades = consultar($sql);

$sql = "SELECT * FROM Escolaridade ORDER BY descricao";
$escolaridades = consultar($sql);

$sql = "SELECT * FROM Responsavel ORDER BY nomeResponsavel";
$responsaveis = consultar($sql);

if(isPostBack()){
	print_r($_POST);
	//$logradouro = $_POST['logradouro'];
	//$cep = $_POST['cep'];
	//$codigo_bairro = $_POST['bairro'];
	
	//$sql = "INSERT INTO Logradouro (nome,cep,codigoBairro) VALUES ('$logradouro','$cep',$codigo_bairro);";
	//$resultado = inserir($sql);
	
	//if ($resultado!=0){
	//	echo "Cadastrado com Sucesso! Aguarde redirecionamento em 2 segundos.";
	//	echo "<meta http-equiv=\"refresh\" content=\"2;url=http://localhost/frequencia_espirita/gerencia/\">";
	//} else{
	//	echo $sql;
	//	echo "Problema no cadastro! ".$resultado;
	//}
}
?>
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h2>Cadastro de Pessoa</h2>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<form class="form-horizontal" role="form" action="pessoa.php" method="post" accept-charset="utf-8">
				<div class="form-group">
					<label class="control-label col-sm-2" for="nome">Nome Completo:</label>
					<div class="col-sm-4">
				    	<input type="text" class="form-control" id="nome" name="nome" placeholder="Informe o Nome Completo">
				    </div>
				    <label class="control-label col-sm-2" for="nome_cracha">Nome Crachá:</label>
					<div class="col-sm-4">
				    	<input type="text" class="form-control" id="nome_cracha" name="nome_cracha" placeholder="Informe o Nome que deseja exibir no Crachá.">
				    </div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="cpf">CPF:</label>
					<div class="col-sm-4">
				    	<input type="text" class="form-control" id="cpf" name="cpf" placeholder="Informe o CPF">
				    </div>
				    <label class="control-label col-sm-2" for="data_nascimento">Data Nascimento:</label>
					<div class="col-sm-4">
				    	<input type="date" class="form-control" id="data_nascimento" name="data_nascimento" placeholder="Informe a data de Nascimento.">
				    </div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="religia">Religião:</label>
					<div class="col-sm-4">
				    	<select class="form-control" id="religiao" name="religiao">
				    		<option value="Espírita">Espírita</option>
				    		<option value="Católico">Católico</option>
				    		<option value="Protestante">Protestante</option>
				    		<option value="Candomblé">Candomblé</option>
				    		<option value="Umbanda">Umbanda</option>
				    		<option value="Outras">Outras</option>
				    	</select>
				    </div>
				    <label class="control-label col-sm-2" for="profissao">Profissão:</label>
					<div class="col-sm-4">
				    	<input type="text" class="form-control" id="profissao" name="profissao" placeholder="Informe a sua Profissão.">
				    </div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="escolaridade">Escolaridade:</label>
					<div class="col-sm-4">
						<select class="form-control" id="escolaridade" name="escolaridade">
							<option value="">Escolha o nível de escolaridade</option>
							<?php foreach ($escolaridades as $escolaridade) {?>
							<option value="<?php echo $escolaridade['codigoEscolaridade']; ?>"><?php echo utf8_encode($escolaridade['descricao']); ?></option>
							<?php } ?>
						</select>
				    </div>
				    <label class="control-label col-sm-2" for="curso">Curso/Série:</label>
					<div class="col-sm-4">
				    	<input type="text" class="form-control" id="curso" name="curso" placeholder="Informe o curso ou série.">
				    </div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="estado_civil">Estado Civil:</label>
					<div class="col-sm-4">
						<select class="form-control" id="estado_civil" name="estado_civil">
							<option value="Solteiro(a)">Solteiro(a)</option>
							<option value="Casado(a)">Casado(a)</option>
							<option value="Divorciado(a)">Divorciado(a)</option>
							<option value="Viúvo(a)">Viúvo(a)</option>
							<option value="Outros">Outros</option>							
						</select>
				    </div>
				    <label class="control-label col-sm-2" for="responsavel">Responsável:</label>
					<div class="col-sm-3">
				    	<select class="form-control" id="responsavel" name="responsavel">
							<option value="">Responsável</option>
							<?php foreach ($responsaveis as $responsavel) {?>
							<option value="<?php echo $responsavel['codigoResponsavel']; ?>"><?php echo utf8_encode($responsavel['nomeResponsavel']); ?></option>
							<?php } ?>
						</select>
				    </div>
				    <div class="col-sm-1">
				    	<a href="#">
				          <span class="glyphicon glyphicon-refresh"></span>
				        </a>
				        <a href="#">
				          <span class="glyphicon glyphicon-plus"></span>
				        </a>
				    </div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="telefone">Telefone:</label>
					<div class="col-sm-4">
						   <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Informe o seu Telefone.">
					</div>
					<label class="control-label col-sm-2" for="celular">Celular:</label>
					<div class="col-sm-4">
						   <input type="text" class="form-control" id="celular" name="celular" placeholder="Informe o seu Celular.">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="email">E-mail:</label>
					<div class="col-sm-4">
						   <input type="text" class="form-control" id="email" name="email" placeholder="Informe o seu E-mail.">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<label class="control-label col-sm-8" for="receber_email">Aceita receber contato por e-mail?</label>
						<label class="radio-inline">
					      <input type="radio" id="receber_email" name="receber_email" value="Sim">Sim
					    </label>
					    <label class="radio-inline">
					      <input type="radio" id="receber_email" name="receber_email" value="Não">Não
					    </label>
					</div>
					<div class="col-sm-6">
						<label class="control-label col-sm-8" for="receber_telefone">Aceita receber contato por telefone?</label>
						<label class="radio-inline">
					      <input type="radio" id="receber_email" name="receber_telefone" value="Sim">Sim
					    </label>
					    <label class="radio-inline">
					      <input type="radio" id="receber_email" name="receber_telefone" value="Não">Não
					    </label>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="logradouro">Logradouro:</label>
					<div class="col-sm-4">
				    	<input type="text" class="form-control" id="logradouro" name="logradouro" placeholder="Informe o Nome da Rua">
				    	<span class="help-block">Logradouro completo, nome da rua e número da residência.</span>
				    </div>
				    <label class="control-label col-sm-2" for="cep">CEP:</label>
					<div class="col-sm-4">
				    	<input type="text" class="form-control" id="cep" name="cep" placeholder="Informe o CEP (Apenas números)">
				    	<span class="help-block">Digite apenas números, sem traços.</span>
				    </div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="complemento">Complemento:</label>
					<div class="col-sm-4">
				    	<input type="text" class="form-control" id="complemento" name="complemento" placeholder="Informe o Complemento de endereço">
				    </div>
				    <label class="control-label col-sm-2" for="ponto_referencia">Ponto de Referência:</label>
					<div class="col-sm-4">
				    	<input type="text" class="form-control" id="ponto_referencia" name="ponto_referencia" placeholder="Informe um Ponto de Referência">
				    </div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="bairro">Bairro:</label>
						<div class="col-sm-4">
					    	<input type="text" class="form-control" id="bairro" name="bairro" placeholder="Informe o Bairro">
					    </div>
					<label class="control-label col-sm-2" for="cidade">Cidade:</label>
					<div class="col-sm-4">
				    	<select class="form-control" id="cidade" name="Cidade">
				    		<option value="1">Vitória da Conquista</option>
							<?php foreach ($cidades as $cidade) {?>
							<option value="<?php echo $cidade['codigoCidade']; ?>"><?php echo utf8_encode($cidade['nome']); ?></option>
							<?php } ?>
				    	</select>
				    </div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
				    	<button type="submit" class="btn btn-default">Gravar</button>
				    </div>
				</div>
			</form> 
	  	</div>
	</div>
<?php require_once '../rodape.php'; ?>
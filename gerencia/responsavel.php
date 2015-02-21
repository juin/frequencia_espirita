<?php
require_once '../topo.php';

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
				<h2>Cadastro de Responsável</h2>
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
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="parentesco">Grau Parentesco:</label>
					<div class="col-sm-4">
						<select class="form-control" id="parentesco" name="parentesco">
							<option value="Pai">Pai</option>
							<option value="Mãe">Mãe</option>
							<option value="Tio(a)">Tio(a)</option>
							<option value="Irmão/Irmã">Irmão/Irmã</option>
							<option value="Outros">Outros</option>							
						</select>
				    </div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="telefone">Telefone:</label>
					<div class="col-sm-4">
						   <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Informe o seu Telefone.">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="email">E-mail:</label>
					<div class="col-sm-4">
						   <input type="text" class="form-control" id="email" name="email" placeholder="Informe o seu E-mail.">
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
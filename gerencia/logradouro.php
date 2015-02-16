<?php
require_once '../topo.php';

$sql = "SELECT * FROM Bairro ORDER BY nome";
$bairros = consultar($sql);

$sql = "SELECT * FROM Cidade ORDER BY nome";
$cidades = consultar($sql);

if(isPostBack()){
	
	$logradouro = $_POST['logradouro'];
	$cep = $_POST['cep'];
	$codigo_bairro = $_POST['bairro'];
	
	$sql = "INSERT INTO Logradouro (nome,cep,codigoBairro) VALUES ('$logradouro','$cep',$codigo_bairro);";
	$resultado = inserir($sql);
	
	if ($resultado!=0){
		echo "Cadastrado com Sucesso! Aguarde redirecionamento em 2 segundos.";
		echo "<meta http-equiv=\"refresh\" content=\"2;url=http://localhost/frequencia_espirita/gerencia/\">";
	} else{
		echo $sql;
		echo "Problema no cadastro! ".$resultado;
	}
}
?>
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h2>Cadastro de Logradouro</h2>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<form class="form-horizontal" role="form" action="logradouro.php" method="post" accept-charset="utf-8">
				<div class="form-group">
					<label class="control-label col-sm-2" for="logradouro">Logradouro:</label>
					<div class="col-sm-10">
				    	<input type="text" class="form-control" id="logradouro" name="logradouro" placeholder="Informe o Logradouro">
				    </div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="cep">CEP:</label>
					<div class="col-sm-10">
				    	<input type="text" class="form-control" id="cep" name="cep" placeholder="Informe o CEP (Apenas números)">
				    	<span class="help-block">Digite apenas números, sem traços.</span>
				    </div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="cidade">Cidade:</label>
					<div class="col-sm-10">
				    	<select class="form-control" id="cidade">
				    		<option value="">Escolha a Cidade</option>
							<?php foreach ($cidades as $cidade) {?>
							<option value="<?php echo $cidade['codigoCidade']; ?>"><?php echo utf8_encode($cidade['nome']); ?></option>
							<?php } ?>
				    	</select>
				    </div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="bairro">Bairro:</label>
					<div class="col-sm-10">
				    	<select class="form-control" id="bairro" name="bairro">
				    		<option value="">Escolha o Bairro</option>
							<?php foreach ($bairros as $bairro) {?>
							<option value="<?php echo $bairro['codigoBairro']; ?>"><?php echo utf8_encode($bairro['nome']); ?></option>
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
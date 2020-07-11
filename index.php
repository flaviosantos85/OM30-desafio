<!DOCTYPE html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Cadastro de Pacientes - OM30</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
		<style>
			#table-pac { margin-top:100px }
			.bt-add-pac { right:0;position:relative;top:100px }
			.container-photo { border:1px solid silver;width:150px;height:180px; float:left }
			.up-photo { display:none }
			.required { color:red }
			.preview { width:100%; height:100%  }
			.input-empty { border:1px solid red; }
			.input-filled { border:1px solid #495057; }
			#btn-cam { cursor:pointer;text-align:center;border:1px solid silver;position:relative;top:140px;width:40px;height:40px }
		</style>
	</head>
	<body>
		
		<div class="container-fluid" style="text-align:center;margin-top:50px">
			<h2>Cadastro de Pacientes</h2>
			<button class="btn float-right btn-primary bt-add-pac" data-toggle="modal" data-target="#modal-add">Novo Paciente</button>
			<div class="clearfix"></div>
			<table class="table table-hover" id="table-pac">
				<thead>
				<tr>
					<th>Nome</th>
					<th>Nome da Mae</th>
					<th>Data de Nasc</th>
					<th>cep</th>
					<th>Endereço</th>
					<th>numero</th>
					<th>cpf</th>
					<th>CNS</th>
					<th>acao</th>
				</tr>
				</thead>
				<tbody id="table-data">
			
				</tbody>
			</table>
		</div>
		<!-- Modal add -->
		<div id="modal-add" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Novo Paciente</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="container-photo" id="add"> 
					
				</div>
				<label for="upphoto" id="btn-cam">
					<i class="fa fa-camera" style="position:relative;top:5px"></i>
				</label>
				<div class="clearfix"></div>
				<form class="form-add" method="post" enctype="multipart/form-data">
					<p><input type="file" name="photo" id="upphoto"  class="up-photo"></p>
					<p>
					Nome completo<label class="required">*</label>
					<input type="text" name="nome"  class="form-control"></p>
					<p>
					Nome da mae completo <label class="required">*</label>
					<input type="text" name="nome-mae"  class="form-control"></p>
					<p>
					Data de Nascimento<label class="required">*</label>
					<input type="text" name="dt-nasc"  class="form-control"></p>
					<p>
					CEP<label class="required">*</label>
					<input type="text" name="cep"  class="form-control cep"></p>
					<p>
					<div class="row">
						<div class="col-md-6">
						<p>
							Endereço completo <label class="required">*</label>
							<input type="text" name="end-completo"  class="form-control"></p>
						<p>
						</div>
						<div class="col-md-6">
						<p>
							Numero <label class="required">*</label>
							<input type="text" name="numero"  class="form-control"></p>
						<p>	
						</div>
					</div>
					<p>
					CPF <label class="required">*</label>
					<input type="text" name="cpf"  class="form-control"></p>
					CNS <label class="required">*</label>
					<input type="text" name="cns"  class="form-control"></p>
					
					<button type="submit" class="btn btn-primary float-right">Cadastrar</button>	
				</form>	
			</div>
			<div class="modal-footer">
				
				
			</div>
			</div>

		</div>
		</div>
		
		<!-- Modal edit -->
		<div id="modal-edit" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Editar Paciente</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="container-photo edit">
					<img src="" id="preview-edit" class="preview" alt="">
				</div>
				<label for="upphoto-edit" id="btn-cam">
					<i class="fa fa-camera" style="position:relative;top:5px"></i>
				</label>
				<div class="clearfix"></div>
				<form class="form-edit" enctype="multipart/form-data">
					<p><input type="file" name="photo-edit" data-id="edit" id="upphoto-edit" class="up-photo"></p>
					<p>
					Nome completo<label class="required">*</label>
					<input type="text" name="nome-edit"  class="form-control"></p>
					<p>
					Nome da mae completo <label class="required">*</label>
					<input type="text" name="nome-mae-edit"  class="form-control"></p>
					<p>
					Data de Nascimento<label class="required">*</label>
					<input type="text" name="dt-nasc-edit"  class="form-control"></p>
					<p>
					CEP<label class="required">*</label>
					<input type="text" name="cep-edit"  class="form-control cep"></p>
					<p>
					<div class="row">
						<div class="col-md-6">
						<p>
							Endereço completo <label class="required">*</label>
							<input type="text" name="end-completo-edit"  class="form-control"></p>
						<p>
						</div>
						<div class="col-md-6">
						<p>
							Numero <label class="required">*</label>
							<input type="text" name="numero-edit"  class="form-control"></p>
						<p>	
						</div>
					</div>
					<p>
					CPF <label class="required">*</label>
					<input type="text" name="cpf-edit"  class="form-control"></p>
					CNS <label class="required">*</label>
					<input type="text" name="cns-edit"  class="form-control"></p>
					<input type="hidden" name="paciente-edit"  class="form-control">
					<input type="hidden" name="old-photo"  class="form-control">
					<button type="submit" class="btn btn-primary float-right">Salvar</button>	
				</form>	
			</div>
			<div class="modal-footer">
				
				
			</div>
			</div>

		</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
		<script src="assets/js/behavior.js"></script>
		<script>
			$('input[name="cpf"]').mask('000.000.000-00');
			$('input[name="dt-nasc"]').mask('00/00/0000');
			$('input[name="cep"]').mask('00000-000');
			$('input[name="cns"]').mask('000000000000000');
			$('input[name="cpf-edit"]').mask('000.000.000-00');
			$('input[name="dt-nasc-edit"]').mask('00/00/0000');
			$('input[name="cep-edit"]').mask('00000-000');
			$('input[name="cns-edit"]').mask('000000000000000');
			
		</script>
	</body>
</html>
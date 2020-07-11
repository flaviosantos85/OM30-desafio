<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
	session_start();
	//unset($_SESSION['newclients']);
	//unset($_SESSION['contador']);
	//session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CRUD Rest</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
</head>
<body>
<div class="container" style="width:70%;margin:0 auto">
	<div class="row">
		<div class="col-md-12" style="margin-top:100px">
		<button class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal">Novo Cliente</button>
		<table class="table table-hover">
			<thead>
			<tr>
				<th>Nome</th>
				<th>Email</th>
				<th>Telefone</th>
				<th>Estado</th>
				<th>Cidade</th>
				<th>Data Nascimento</th>
				
				<th>açao</th>
			</tr>
			</thead>
			<tbody class="body-table">
			
				<?php foreach($clients as $key => $value): ?>
					<tr id="<?php echo $key; ?>">
					<td><?php echo $value[0]; ?></td>
					<td><?php echo $value[1]; ?></td>
					<td><?php echo $value[2]; ?></td>
					<td><?php echo $value[3]; ?></td>
					<td><?php echo $value[4]; ?></td>
					<td><?php echo $value[5]; ?></td>
				
					<td><button class="btn btn-primary btn-edit" data-id="<?php echo $key; ?>" data-toggle="modal" data-target="#myModal2"><i class="fa fa-edit"></i></button></td>
					<td><button class="btn btn-danger btn-del" data-id="<?php echo $key; ?>"><i class="fa fa-trash"></i></button></td>
					</tr>
					
				<?php endforeach; ?>
				<?php if(isset($_SESSION['newclients'])): ?>
				<?php foreach($_SESSION['newclients'] as $clients => $vl) :  ?>
					<tr><td><?php echo $vl[0]; ?></td>
					<td><?php echo $vl[1]; ?></td>
					<td><?php echo $vl[2]; ?></td>
					<td><?php echo $vl[3]; ?></td>
					<td><?php echo $vl[4]; ?></td>
					<td><?php echo $vl[5]; ?></td>
					<td><button class="btn btn-primary btn-edit" data-id="<?php echo $clients; ?>" data-toggle="modal" data-target="#myModal2"><i class="fa fa-edit"></i></button></td>
					<td><button class="btn btn-danger btn-del" data-id="<?php echo $clients; ?>"><i class="fa fa-trash"></i></button></td></tr>
				<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
		</div>
	</div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal add content-->
    <div class="modal-content">
      <div class="modal-header">
	  <h4 class="modal-title">Novo Cliente</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form class="add-form" method="post">
			<p>
				nome:
				<input type="text" name="nome" required class="form-control">
			</p>
			<p>
				Email:
				<input type="text" name="email" required class="form-control">
			</p>
			<p>
				Telefone:
				<input type="telefone" name="telefone" required class="form-control">
			</p>
			<p>
				Estado:
				<input type="text" name="estado" required class="form-control">
			</p>
			<p>
				Cidade:
				<input type="text" name="cidade" required class="form-control">
			</p>
			<p>
				Data Nascimento:
				<input type="text" name="nascimento" required class="form-control">
			</p>
			<p>Planos:</p>
				<input type="checkbox" name="planosx[]" value="free"> Free - R$ 0<br>
				<input type="checkbox" name="planosx[]" value="basic"> Basic - R$ 100,00/mensal<br>
				<input type="checkbox" name="planosx[]" value="plus"> Plus - R$ 180,00/mensal
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
	  </form>
    </div>

  </div>
</div>

<!-- Modal editar -->
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal  content-->
    <div class="modal-content">
      <div class="modal-header">
	  <h4 class="modal-title">Editar Cliente</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post" class="edit-form">
			<p>
				nome:
				<input type="text" name="edit-nome" required class="form-control">
				<input type="hidden" name="edit-email">
			</p>
			
			<p>
				Telefone:
				<input type="telefone" name="edit-telefone" required class="form-control">
			</p>
			<p>
				Estado:
				<input type="text" name="edit-estado" required class="form-control">
			</p>
			<p>
				Cidade:
				<input type="text" name="edit-cidade" required class="form-control">
			</p>
			<p>
				Data Nascimento:
				<input type="text" name="edit-nascimento" required class="form-control">
				<input type="hidden" name="edit-client">
			</p>
			<p>Planos:</p>
				<input type="checkbox" name="edit-planos[]" value="free"> Free - R$ 0<br>
				<input type="checkbox" name="edit-planos[]" value="basic"> Basic - R$ 100,00/mensal<br>
				<input type="checkbox" name="edit-planos[]" value="plus"> Plus - R$ 180,00/mensal
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-update">Salvar alteraçoes</button>
      </div>
	  </form>
    </div>

  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.12/jquery.mask.js"></script>
<script>

	$('input[name="nascimento"]').mask('00/00/0000');

	var url = 'http://localhost/testrest/index.php/';

	$('body').on('click', '.btn-edit', function(){

		
		var idClient = $(this).data('id');
		
		
		$.get(url + 'client/retrieve/' + idClient)
		.done(function(data){
			
			$('input[name="edit-nome"]').val(data['client'][0]);
			$('input[name="edit-email"]').val(data['client'][1]);
			$('input[name="edit-telefone"]').val(data['client'][2]);
			$('input[name="edit-estado"]').val(data['client'][3]);
			$('input[name="edit-cidade"]').val(data['client'][4]);
			$('input[name="edit-nascimento"]').val(data['client'][5]);
			$('input[name="edit-client"]').val(data['id']);

				var i=0;
				for(i; i < data['client']['planosx'].length; i++){
					$('input[name="edit-planos[]"][value="'+ data['client']['planosx'][i] +'"]').prop('checked', true);
					
				}
				//console.log(data['client']['planosx'].length);
		});
	});

	$('body').on('hidden.bs.modal', '.modal', function () {
    
    	$("input[name='edit-planos[]']").prop('checked', false);
    
	});

	
	$('.add-form').on('submit', function(e){
		e.preventDefault();

		var nome = $(this)[0][0].value;
		var email = $(this)[0][1].value;
		var telefone = $(this)[0][2].value;
		var estado = $(this)[0][3].value;
		var cidade = $(this)[0][4].value;
		var nascimento = $(this)[0][5].value;

		
		$.post(url + 'client/insert', $(this).serialize())
		.done(function(data){

			//var result = JSON.parse(data);
			
			//console.log(data.id);
			buildHTML(data);
			
			alert('Cliente registrado com sucesso');
			$('.add-form').trigger('reset');
		})
	});

	$('body').on('click', '.btn-del', function(){
		var idClient = $(this).data('id');
	
		$.ajax({
			url : url + 'client/delete/' + idClient,
			type : 'delete',
			success: function(data){
				//console.log(data);
				if(data.status === 200){
					$('#' + idClient).remove();
					alert('cliente removido');
				}
				
			},
			error: function(data){
				alert('Este cliente nao pode ser removido');
			}

		});
	});

	$('.edit-form').on('submit', function(e){
		e.preventDefault();

		var id = $(this)[0][6].value; // client ID

		$.ajax({
			url : url + 'client/edit/' + id, 
			type: 'put',
			data: $('.edit-form').serialize(),
			success : function(data){
				$('#' + id).remove();
				buildHTML(data);
			},
			error: function(data){
				console.log(data);
			}
		});
	});

	function buildHTML(data){
		//console.log(data);
		var newTr = '<tr id="'+ data.id +'">';
				newTr += '<td>';
				newTr += data['client'][0];
				newTr += '</td>';
				newTr += '<td>';
				newTr += data['client'][1];
				newTr += '</td>';
				newTr += '<td>';
				newTr += data['client'][2];
				newTr += '</td>';
				newTr += '<td>';
				newTr += data['client'][3];
				newTr += '</td>';
				newTr += '<td>';
				newTr += data['client'][4];
				newTr += '</td>';
				newTr += '<td>';
				newTr += data['client'][5];
				newTr += '</td>';
				newTr += '<td>';
				newTr += '<button class="btn btn-primary btn-edit" data-id="'+ data.id +'" data-toggle="modal" data-target="#myModal2"><i class="fa fa-edit"></i></button></td><td><button class="btn btn-danger btn-del" data-id="'+ data.id +'"><i class="fa fa-trash"></i></button>';
				newTr += '</td>';
				newTr += '</tr>';

			$('.body-table').prepend(newTr);	

	}

</script>
</body>
</html>

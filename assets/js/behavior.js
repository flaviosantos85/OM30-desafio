var url = 'http://localhost/om30/api/1.0/index.php/';

/***** if there is a patient as argument then return only specific patient and fill out the edit modal *******/ 
function ajaxRenderPatient(pat = null){
    var resource = (pat == null) ? 'paciente/get-pacientes' : 'paciente/get-paciente/' + pat;

    $.ajax({
        url : url + resource,
        type : 'GET',
        success: function(data){
            if(pat){
                $.each(data, function(id, val){
                    $.each(val, function(inn, vl){
                        
                        $('#preview-edit').attr('src', 'assets/uploads/' + vl.photo);
                        $('input[name="nome-edit"]').val(vl.nome);
                        $('input[name="nome-mae-edit"]').val(vl.nome_mae);
                        $('input[name="dt-nasc-edit"]').val(vl.dt_nasc);
                        $('input[name="cep-edit"]').val(vl.cep);
                        $('input[name="end-completo-edit"]').val(vl.endereco);
                        $('input[name="numero-edit"]').val(vl.numero);
                        $('input[name="cpf-edit"]').val(vl.cpf);
                        $('input[name="cns-edit"]').val(vl.cns);
                        $('input[name="paciente-edit"]').val(vl.paciente_id);
                        $('input[name="old-photo"]').val(vl.photo);
                    });
                });  
                return false;
            }
            /**** end if */
            var html;
            if(!data){
                    
                $('#table-data').append(nopatient());
                return false;
            }
            $.each(data, function(id, val){
                $.each(val, function(ixx, value){
                    html = '<tr id="'+ value.paciente_id +'">';
                    html += '<td>'+ value.nome +'</td>';
                    html += '<td>'+ value.nome_mae +'</td>';
                    html += '<td>'+ value.dt_nasc +'</td>';
                    html += '<td>'+ value.cep +'</td>';
                    html += '<td>'+ value.endereco +'</td>';
                    html += '<td>'+ value.numero +'</td>';
                    html += '<td>'+ value.cpf +'</td>';
                    html += '<td>'+ value.cns +'</td>';
                    html += '<td><button class="btn btn-primary btn-edit" data-id="'+ value.paciente_id +'" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i></button> <button class="btn btn-danger btn-del" data-id="'+ value.paciente_id +'" data-toggle="modal" data-target=""><i class="fa fa-trash"></i></button></td>';
                    html += '</tr>';
                    $('#nopatient').remove();
                    $('#table-data').append(html);
                })
            });
        },
        error: function(e){
            swal('', e.responseJSON.message, 'warning')
        }
    });

}

ajaxRenderPatient(); // optional argument (patient id) otherwise return all patients

function nopatient(){
    html = '<tr id="nopatient">';
    html += "<td colspan='9' style='font-weight:bold;text-align:center'>Nenhum paciente no sistema<td>";
    html += '</tr>';
    $('#table-data').html(html);
}

function readURL(input, ref) {

    
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        if(ref == 'edit'){
            $('#preview-edit').attr('src', e.target.result);
            
        }else{
            $('#add').html('<img id="preview" class="preview">');
            $('#preview').attr('src', e.target.result);
        }
        
      }
      
      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }

  $('body').on('change', '.up-photo', function(){
    readURL(this, $(this).data('id'));
 
  });


  $('body').on('blur','.cep', function(){
     
    var modalEditOrAdd = $(this).attr('name');
    $.getJSON("https://viacep.com.br/ws/"+ $(this).val() +"/json/?callback=?", function(dados) {
    var end = dados.logradouro + ', ' + dados.bairro + ' ' + dados.localidade + ', ' + dados.uf;   
    switch(modalEditOrAdd){
        case 'cep':
        filloutAddress('end-completo', end);
        break;
        case 'cep-edit':
        filloutAddress('end-completo-edit', end);    
    }
    })
  })

  function filloutAddress(component, data){
    $('input[name="'+ component +'"]').val(data);
  }

  $('input[name="numero"]').keyup(function() {
    $(this).val(this.value.replace(/\D/g, ''));
  });

  // add paciente
  $('.form-add').on('submit', function(e){
      e.preventDefault();

      var hasFieldEmpty = false;
      $.each($('.form-add input'), function(inx, val){
          if($(this).val() === ''){
            if($(this).attr('name') != 'photo'){
                $(this).addClass('input-empty');
                hasFieldEmpty = true;
            }   
          }else{
            $(this).removeClass('input-empty');
        }
      });

      if(hasFieldEmpty){
          swal('Atençao', 'Verifique os campos obrigatórios', 'warning');
          return false;
      }

      var formdata = new FormData($(this)[0]);

      $.ajax({
          url : url + 'paciente/add-paciente',
          type : 'post',
          data : formdata,
          processData: false, // important
          contentType: false, // important
          success: function(data){
           //console.log(data); return false;
            if(data.status === 201){
                var html = "<tr id='"+ data.paciente.paciente_id +"' >";
                    html += "<td>"+ data.paciente.nome +"</td>";
                    html += "<td>"+ data.paciente.nome_mae +"</td>";
                    html += "<td>"+ data.paciente.dt_nasc +"</td>";
                    html += "<td>"+ data.paciente.cep +"</td>";
                    html += "<td>"+ data.paciente.endereco +"</td>";
                    html += "<td>"+ data.paciente.numero +"</td>";
                    html += "<td>"+ data.paciente.cpf +"</td>";
                    html += "<td>"+ data.paciente.cns +"</td>";
                    html += '<td><button class="btn btn-primary btn-edit" data-id="'+ data.paciente.paciente_id +'" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i></button> <button class="btn btn-danger btn-del" data-id="'+ data.paciente.paciente_id +'" data-toggle="modal" data-target=""><i class="fa fa-trash"></i></button></td>';
                    html += "</tr>";
                $('#table-data').prepend(html);
                swal('', data.message, 'success');
                $('.form-add').trigger('reset');
                clearPreview();
                $('#nopatient').remove();
                return false;    
            }
              
          },
          error: function(e){
            //console.log(e); return false;
            swal('', e.responseJSON.message, 'warning');
              
          }
          
      });
  })

  $('.form-edit').on('submit', function(e){
      e.preventDefault();

      var hasFieldEmpty = false;
      $.each($('.form-edit input'), function(inx, val){
          if($(this).val() === ''){
            if($(this).attr('name') != 'photo-edit'){
                $(this).addClass('input-empty');
                hasFieldEmpty = true;
            }   
          }else{
            $(this).removeClass('input-empty');
        }
      });

      if(hasFieldEmpty){
          swal('Atençao', 'Verifique os campos obrigatórios', 'warning');
          return false;
      }

      var formdata = new FormData($(this)[0]);
      var pat = $('input[name="paciente-edit"]').val();
      $.ajax({
          url : url + 'paciente/edit-paciente/' + pat,
          type : 'POST',
          data : formdata,
          processData: false, // important
          contentType: false, // important
          success: function(data){
           //console.log(data); return false;
            if(data.status === 200){
                
                var html = "<td>"+ $('input[name="nome-edit"]').val() +"</td>";
                    html += "<td>"+ $('input[name="nome-mae-edit"]').val() +"</td>";
                    html += "<td>"+ $('input[name="dt-nasc-edit"]').val() +"</td>";
                    html += "<td>"+ $('input[name="cep-edit"]').val() +"</td>";
                    html += "<td>"+ $('input[name="end-completo-edit"]').val() +"</td>";
                    html += "<td>"+ $('input[name="numero-edit"]').val() +"</td>";
                    html += "<td>"+ $('input[name="cpf-edit"]').val() +"</td>";
                    html += "<td>"+ $('input[name="cns-edit"]').val() +"</td>";
                    html += '<td><button class="btn btn-primary btn-edit" data-id="'+ $('input[name="paciente-edit"]').val() +'" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i></button> <button class="btn btn-danger btn-del" data-id="'+ $('input[name="paciente-edit"]').val() +'" data-toggle="modal" data-target=""><i class="fa fa-trash"></i></button></td>';
                    
                $('tr#' + pat).html(html);
                swal('', data.message, 'success');
                
                return false;    
            }
              
          },
          error: function(e){
            //console.log(e); return false;
            swal('', e.responseJSON.message, 'warning');
              
          }
          
      });
  });

  function clearPreview(){
    $('#add').html('');
  }

  $('body').on('click', '.btn-edit', function(){
      var patient =  $(this).data('id');
        
      ajaxRenderPatient(patient); // in this case fill out data into edit modal

  });

  $('body').on('click', '.btn-del', function(){
    var patient =  $(this).data('id');
     
    swal({
        title: "Tem certeza?",
        text: "Que deseja remover paciente?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Sim",
        closeOnConfirm: false
      },
      function(){
        $.ajax({
            url : url + 'paciente/delete-paciente/' + patient,
            type : 'DELETE',
            success: function(data){
                if(!$.hasPatient()){
                    nopatient();           
                }
                $('tr#' + patient).remove();
                swal("Removido!", data.message, "success");
            },
            error: function(e){
                swal('', e.responseJSON.message, 'warning');
            }
        });
        
      });
    });

    $.extend({
        hasPatient: function(pat) {

            var resource = (pat == null) ? 'paciente/get-pacientes' : 'paciente/get-paciente/' + pat;
            var theResponse = null;
            
            $.ajax({
                url: url + resource,
                type: 'GET',
                async: false,
                success: function(respText) {
                    theResponse = respText;
                }
            });
            // Return the response text
            return theResponse;
        }
    });

    $('body').on('hidden.bs.modal', function(){
        $('.form-add').trigger('reset');
        clearPreview();
    })
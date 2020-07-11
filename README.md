# OM30-desafio

No desafio om30, foi desenvolvida uma api usando framework codeigniter e alimentando um crud com suas devidas operaçoes create, read, upate e delete (softdelete), fazendo uso do material fornecido e usando outras fontes de pesquisa como google.

# Api OM30
endpoints e funcionalidades

method: GET - get-pacientes uri => http://localhost/om30/api/v1.0/index.php/paciente/get-pacientes (retorna todos os pacientes no sistema)

method: GET - get-paciente/id uri => http://localhost/om30/api/v1.0/index.php/paciente/get-paciente/id-paciente (retorna um paciente especifico)

method: POST - add-paciente (seguintes parametros: nome, nome-mae, dt-nasc, cep, end-completo, numero, cpf, cns e photo opcional) uri => http://localhost/om30/api/v1.0/index.php/paciente/add-paciente/ (insere um novo paciente no sistema)

method: POST edit-paciente/id uri => http://localhost/om30/api/v1.0/index.php/paciente/edit-paciente/id-paciente (update um paciente especifico) obs. a ideia aki era usar o metodo put sendo o ideal, mas nao consegui fazer put com upload junto :(

method: DELETE delete-paciente/id uri => http://localhost/om30/api/v1.0/index.php/paciente/delete-paciente/id-paciente (deleta um paciente especifico, nao removendo totalmente do sistema)

# Instalaçao
desafio feito todo em localhost usando xampp, aconselho colocar o projeto dentro da pasta htdocs

Obrigado a todos pela oportunidade :)

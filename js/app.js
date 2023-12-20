
$(document).ready(function () {
    // ------> acá listamos todos los registros de la bd en el html <--------
    showInfoTable();

    // esto hace la busqueda en la bd en tiempo real (por nombres)
    $('#search').keyup(function(){
        
        if($('#search').val()){
            let dataObjetoSearch = {
                nombres: $("#search").val(),
            };    

            // peticion ajax al servidor:
            $.ajax({
                type: "POST",
                url: "../model/users/search_user.php",
                data: {dataObjetoSearch},
                
                success: function (response) {
                    
                    let platillaInHtml = "";
                    let dataJsonSearch = JSON.parse(response);

                    // verifico si el json devuelto contiene la info
                    if(!$.isEmptyObject(dataJsonSearch)){
                        dataJsonSearch.forEach(dataJsonSearch => {
                            platillaInHtml += `
                                <tr>
                                    <td>${dataJsonSearch.nombres}</td>
                                    <td>${dataJsonSearch.apellidos}</td>
                                    <td>${dataJsonSearch.correo}</td>
                                    <td>${dataJsonSearch.telefono}</td>
                                    <td>
                                        <a href="#editClienteModal" class="edit" 
                                            onclick="asignationToUpdate(${dataJsonSearch.id},'${dataJsonSearch.nombres}',
                                            '${dataJsonSearch.apellidos}','${dataJsonSearch.correo}',${dataJsonSearch.telefono})"
                                            data-toggle="modal">
                                            <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                                        </a>
                                        <a href="#deleteClienteModal" class="delete" onclick="asignationID(${dataJsonSearch.id})" data-toggle="modal">
                                            <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                                        </a>
                                    </td>
                                </tr>
                            `;
                        });
                    }else{
                        platillaInHtml+= `
                            <span class="not-found">No encontrado</span>
                        `;
                    }
                    //se muestra la busqueda en tiempo real en la tabla 
                    $('#list-tableBD').html(platillaInHtml);
                }
            });
        }else{
            showInfoTable();
        }
    });


    

    //esta funcion es para evitar el recargo de los registros
    function showInfoTable(){
        $.ajax({
            type: "GET",
            url: "../model/users/list_user.php",
            success: function (response) {
                // este json obtiene toda la informacion de la tabla
                var infoJson = JSON.parse(response); 

                // plantilla para mostrar en el html
                plantilla = ``;
    
                // recorre toda la info de la tabla
                infoJson.forEach(infoJson =>{
                    plantilla += `
                        <tr>
                            <td>${infoJson.nombres}</td>
                            <td>${infoJson.apellidos}</td>
                            <td>${infoJson.correo}</td>
                            <td>${infoJson.telefono}</td>
                            <td>
                                <a href="#editClienteModal" class="edit" 
                                    onclick="asignationToUpdate(${infoJson.id},'${infoJson.nombres}',
                                    '${infoJson.apellidos}','${infoJson.correo}',${infoJson.telefono})"
                                    data-toggle="modal">
                                    <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                                </a>
                                <a href="#deleteClienteModal" class="delete" onclick="asignationID(${infoJson.id})" data-toggle="modal">
                                    <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                                </a>
                            </td>
                        </tr>    
                    `;
                });
                // en caso de que no haya ningun registro en la bd, la platilla
                //muestra otro mensaje
                
                if( $(infoJson).empty() ){
                    plantilla+= `
                            <span class="not-found">Agregue un cliente</span>
                    `;
                }
    
                // la plantilla es mostrada en el html:
                $('#list-tableBD').html(plantilla);
            }
        });
    }
    


    // ------> acá insertamos registros en la bd <--------
    $("#addClient").on("click", function (e) { 
        
        // obtengo toda la info del modal 'add'
        let dataObjetoInsert = {
            nombres: $("#name").val(),
            apellidos: $("#lastName").val(),
            correo: $("#correo").val(),
            num_celular: $("#telefono").val()
        };
        
        $.ajax({
            type: "POST",
            url: "../model/users/create_user.php",
            data: dataObjetoInsert,
            success: function (response) {
                swal(response, {
                    buttons: false,
                });
                $('#añadirCliente').modal('hide');
                e.preventDefault();
                showInfoTable();
            }
        });
    });

    // ------> acá elimina registro en la bd <--------
    $("#deleteModal").click(function (e) { 
        var dataObjetoId = { id: id_global };
        $.ajax({
            type: "POST",
            url: "../model/users/delete_user.php",
            data: dataObjetoId,
            success: function (response) {
                if(response){
                    $('#deleteClienteModal').modal('hide');
                    swal(response, {
                        buttons: false,
                    });
                    e.preventDefault();
                    showInfoTable();
                }
            }
        });
    });
    
    

    // ------> acá actualiza registros en la bd <--------
    $("#editClient").click(function (e) { 
        let dataObjetoEdit = {
            id: id_global,
            nombres: $("#nameEdit").val(),
            apellidos: $("#lastNameEdit").val(),
            correo: $("#correoEdit").val(),
            num_celular: $("#num_telefonoEdit").val()
        };

        $.ajax({
            type: "POST",
            url: "../model/users/update_user.php",
            data: dataObjetoEdit,
            success: function (response) {
                $('#editClienteModal').modal('hide');
                swal(response, {
                    buttons: false,
                });
                e.preventDefault();
                showInfoTable();
            }
        });
    });
});

// creo un id global para eliminar un registro de la tabla
var id_global = null;

function asignationID(id){
    id_global = id;
}
// funcion que rellena los campos del modal para editar un registro
function asignationToUpdate(id,nombres,apellidos,correo,celular){
    id_global = id;
    $("#nameEdit").val(nombres);
    $("#lastNameEdit").val(apellidos);
    $("#correoEdit").val(correo);
    $("#num_telefonoEdit").val(celular);
}

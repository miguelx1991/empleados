// The root URL for the RESTful services
var rootURL = "https://miguelx1991.github.io/empleados/api/empleados";

// Retrieve wine list when application starts 
findAll();

function findAll() {
	console.log('findAll');
	$.ajax({
		type: 'GET',
		url: rootURL,
		dataType: "json", // data type of response
		success: renderList
	});
}

function renderList(data) {
	// JAX-RS serializes an empty list as null, and a 'collection of one' as an object (not an 'array of one')
	var list = data == null ? [] : (data.empleados instanceof Array ? data.empleados : [data.empleados]);
	var lcCabecera = '<table style="width:100%"><tr><th>Nombre</th><th>Email</th><th>Posicion</th><th>Salario</th><th>Prueba</th></tr>';
	var lcCuerpo = '';
	var lcFooter = '</table>';
	
	//$('#wineList li').remove();
	$.each(list, function(index, empleados) {
		lcCuerpo += '<tr><td>'+ empleados.name+'</td><td>'+ 
                     empleados.email+'</td><td>'+ 
                     empleados.position+'</td><td>'+ 
                     empleados.salary+'</td><td>' + 
                     '<a id="idMostrar' + empleados.id +'" href="' + rootURL + '/' + empleados.id + '" onclick="return mxMostrarProductoEditar(' + empleados.id + ')"> Mostrar </a></td></tr>';
	});
	
	$('#wineList').append(lcCabecera + lcCuerpo + lcFooter);
}

$('#btnCadAbc').click(function() {
    //alert($('#idCadAbc').val());
	ConvertirCadena($('#idCadAbc').val());
	return false;
});

$('#btnMosArr').click(function() {
    //alert($('#idCadAbc').val());
	MostrarArray();
	return false;
});

$('#btnQuiCar').click(function() {
    //alert($('#idCadCar').val());
	QuitarCaracter($('#idCadCar').val());
	return false;
});

function ConvertirCadena(tcCadena)
{
    $.ajax({
		type: 'GET',
		url: rootURL + '/cadena/' + tcCadena,
		//dataType: "json",
		success: MostrarCadena
	});
}

function MostrarCadena(data)
{
    alert(data);
}

function MostrarArray()
{
    $.ajax({
		type: 'GET',
		url: 'https://miguelx1991.github.io/empleados/api/array',
		//dataType: "json", // data type of response
		success: MostrarDatosArray
	});
}

function MostrarDatosArray(data)
{
    alert(data);
}

function QuitarCaracter(tcQuiCar)
{
    $.ajax({
		type: 'GET',
		url: 'https://miguelx1991.github.io/empleados/api/caracter/cadena/' + tcQuiCar,
		//dataType: "json",
		success: MostrarCadena
	});
}

function mxMostrarProductoEditar(tcCodigo)
{
    var loRuta = $("#idMostrar" + tcCodigo);

    $('#idContenidoModal').load(loRuta[0].href, function () {
        $('#idModal').modal({
            keyboard: true
        }, 'show');
        mxEnlazarFormulario(this);
    });
    return false;
}

function mxEnlazarFormulario(toDialogo) {

    $('#idNuevoUsuario', toDialogo).submit(function () {
        $.ajax({
            url: this.action,
            type: this.method,
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    $('#idModal').modal('hide');
                    location.reload();
                } else {
                    $('#idContenidoModal').html(result);
                    mxEnlazarFormulario();
                }
            }
        });
        return false;
    });
}

// Constantes para establecer las rutas y parámetros de comunicación con la API.
const API_RECU = '../app/api/recuperar.php?action=';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.

document.getElementById('cambiar').disabled = true;

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('cambiar').disabled = true;
  });

document.getElementById('save-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    fetch(API_RECU + 'generarCodigo', {
        method: 'post',
        body: new FormData(document.getElementById('save-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    sweetAlert(1, response.message, null);
                    document.getElementById('usuario2').value = document.getElementById('usuario').value
                    document.getElementById('cambiar').disabled = false;
                    document.getElementById('action').disabled = true;
                    document.getElementById('usuario').disabled = true;
                    sweetAlert(1, 'Revise su bandeja de entrada para continuar el proceso de recuperación.', null);
                } else {                                        
                    sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
});

document.getElementById('save-form2').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    fetch(API_RECU + 'recuContra', {
        method: 'post',
        body: new FormData(document.getElementById('save-form2'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    sweetAlert(1, response.message, 'index.php');
                } else {
                    sweetAlert(2, response.exception, null);         
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
});
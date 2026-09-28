<?php
$router->get('/login', 'ControladorAutenticacion@mostrarLogin');
$router->post('/login', 'ControladorAutenticacion@procesarLogin');
$router->post('/salir', 'ControladorAutenticacion@salir');

$router->get('/', 'ControladorCuenta@panel');

$router->get('/retiros', 'ControladorRetiro@formulario');
$router->post('/retiros', 'ControladorRetiro@procesar');
$router->get('/retiros/historial', 'ControladorRetiro@historial');

$router->get('/transferencias', 'ControladorTransferencia@formulario');
$router->post('/transferencias', 'ControladorTransferencia@procesar');
$router->get('/transferencias/historial', 'ControladorTransferencia@historial');

?>
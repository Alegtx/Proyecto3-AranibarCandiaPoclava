<!DOCTYPE html>
<html lang="es">
  <head>
      <title>Registro</title>
      <?php include './incluir/link.php'; ?>
      <link rel="stylesheet" href="css/gsdk-bootstrap-wizard.css"/>
      <style type="text/css">
        input: invalid,
        textarea: invalid{
            border: 2px solid red;
            border-radius: 4px;
        }
      </style>
  </head>
  <body id="container-page-registration">
    <?php include './incluir/navbar.php'; ?>
    <section id="form-registration">
      <div class="container">
        <div class="row">
          <div class="page-header">
            <h1>Registro de usuarios <small class="tittles-pages-logo">Shopon-line</small></h1>
          </div>
          <div class="col-xs-12 col-sm-6 text-center">
            <br><br><br>
            <p><i class="fa fa-users fa-5x"></i></p>
            <p class="lead">
                Al registrarse recibira notificaciones de nuestros productos y ofertas más recientes en nuestra tienda.
            </p>
            <br>
            <img src="assets/img/img-registro.png" alt="compras" class="img-responsive">
          </div>
          <div class="col-xs-12 col-sm-6">
            <br><br>
            <div id="container-form">
              <p style="color:#fff;" class="text-center lead">Debera de llenar todos los campos para registrarse</p>
              <!-- ==================== Wizard =============== -->
              <div class="card wizard-card" data-color="dark-red" id="wizardProfile">
                <form id="form-registro" class="form-horizontal FormCatElec" action="procesos/registrarCliente.php" role="form" method="post" data-form="save">
                  <div class="wizard-header">
                    <h3>
                    <small>Esta informacion nos ayuda a concocerte.</small>
                    </h3>
                  </div>
                  <div class="wizard-navigation">
                    <ul>
                      <li><a href="#credenciales" data-toggle="tab">Credenciales de tu cuenta</a></li>
                      <li><a href="#datos" data-toggle="tab">Datos personales</a></li>
                      <li><a href="#contacto" data-toggle="tab">Direccion y contacto</a></li>
                      <li><a href="#captcha" data-toggle="tab">Termina tu registro</a></li>
                    </ul>
                  </div>
                  <div class="tab-content">
                    <!-- ==================== Credenciales =============== -->
                    <div class="tab-pane" id="credenciales">
                      <div class="row">
                        <h4 class="info-text"> Vamos a empezar con informacion basica.</h4>
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-8">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-user"></i></div>
                              <input class="form-control all-elements-tooltip" type="text" placeholder="Ingrese su nombre de usuario" required name="clien-usuario" data-toggle="tooltip" data-placement="top" title="Ingrese su nombre. Máximo 9 caracteres." pattern="[a-zA-Z]{1,9}" maxlength="9" onChange="ValidarEspacios(event,'next')">
                              <div id="error-clien-usuario"></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                              <input class="form-control all-elements-tooltip" id="password" type="password" placeholder="Introduzca una contraseña" required name="clien-pass" data-toggle="tooltip" data-placement="top" title="Defina una contraseña para iniciar sesión" onChange="ValidarEspacios(event,'next')">
                              <div id="error-clien-pass" ></div>
                              <div class="input-group-addon">
                                <span id="mostrar-ocultar" style="cursor:pointer;" class="fa fa-eye"></span>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- ==================== Fin credenciales =============== -->

                    <!-- ==================== Datos personales =============== -->
                    <div class="tab-pane" id="datos">
                      <div class="row">
                        <h4 class="info-text"> Ahora vamos con tus datos personales.</h4>
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-8">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                              <input class="form-control all-elements-tooltip" type="text" placeholder="Ingrese su número de NIT o CI" required name="clien-nit" data-toggle="tooltip" data-placement="top" title="Ingrese su número de NIT. Solamente números." minlength="7" maxlength="30" number="[0-9-]" pattern="[0-9-]{7,30}">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-user"></i></div>
                              <input class="form-control all-elements-tooltip" type="text" placeholder="Ingrese sus nombres" required name="clien-nombre" data-toggle="tooltip" data-placement="top" title="Ingrese sus nombres." pattern="[a-zA-Z ]{1,50}" maxlength="50" onChange="ValidarEspacios(event,'next')">
                              <div id="error-clien-nombre"></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-user"></i></div>
                              <input class="form-control all-elements-tooltip" type="text" placeholder="Ingrese sus apellidos" required name="clien-apellidos" data-toggle="tooltip" data-placement="top" title="Ingrese sus apellidos. " pattern="[a-zA-Z ]{1,50}" maxlength="50" onChange="ValidarEspacios(event'next')">
                              <div id="error-clien-apellidos"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- ==================== Fin datos personales =============== -->

                    <!-- ==================== Contacto =============== -->
                    <div class="tab-pane" id="contacto">
                      <div class="row">
                        <h4 class="info-text"> Como te encontramos y a donde te contactamos?</h4>
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-8">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-home"></i></div>
                              <input class="form-control all-elements-tooltip" type="text" placeholder="Ingrese su dirección" required name="clien-dir" data-toggle="tooltip" data-placement="top" title="Ingrese la direción en la reside actualmente" maxlength="100" onChange="ValidarEspacios(event'next')">
                              <div id="error-clien-dir"></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-mobile"></i></div>
                              <input class="form-control all-elements-tooltip" type="tel" placeholder="Ingrese su número telefónico" required name="clien-phone" minlength="7" maxlength="13" number="[0-9]" pattern="[0-9]{7,13}" data-toggle="tooltip" data-placement="top" title="Ingrese su número telefónico. Mínimo 7 digitos máximo 13.">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-at"></i></div>
                              <input class="form-control all-elements-tooltip" type="email" placeholder="Ingrese su Email" required name="clien-email" data-toggle="tooltip" data-placement="top" title="Ingrese la dirección de su Email." maxlength="50">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- ==================== Fin contacto =============== -->

                    <!-- ==================== Contacto =============== -->
                    <div class="tab-pane" id="captcha">
                      <div class="row">
                        <h4 class="info-text"> Como te encontramos y a donde te contactamos?</h4>
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-8">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><img id="img-captcha" src="./captcha/Captcha.php"></div>
                              <input class="form-control all-elements-tooltip" type="text" placeholder="Ingrese el captcha" required name="clien-captcha" data-toggle="tooltip" data-placement="top" title="Ingrese el captcha." maxlength="6" onChange="ValidarEspacios(event, 'next')"> 
                              <div id="error-clien-captcha"></div>
                            </div>
                          </div>
                          <br>
                          <p><button type="submit" id="botonRegistro" class="btn btn-success btn-block"><i class="fa fa-pencil"></i>&nbsp; Registrarse</button></p>
                          <div class="ResForm" style="width: 100%; color: black; text-align: center; margin: 0;"></div>
                          <div id="errores-form" class="errores-form"></div>
                        </div>
                      </div>
                    </div>
                    <!-- ==================== Fin contacto =============== -->
                  </div>
                  <!-- ==================== Wizard Footer =============== --> 
                  <div class="wizard-footer height-wizard">
                    <div class="pull-right">
                      <input type='button' class='btn btn-next btn-fill btn-wd btn-sm btn-color' id="next" name='next' value='Siguiente'/>
                    </div>
                    <div class="pull-left">
                      <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='Anterior'/>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <!-- ==================== Fin wizard footer =============== --> 
                </form>
              </div>
              <!-- ==================== Fin Wizard =============== -->
            </div> 
          </div>
        </div>
      </div>
    </section>
    <script src="js/gsdk-bootstrap-wizard.js"></script>
    <script src="js/jquery.bootstrap.wizard.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/messages_es.js"></script>
    <?php include './incluir/footer.php'; ?>
  </body>
</html>
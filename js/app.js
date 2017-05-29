//cliente

    function load(page){
        var parametros = {"action":"ajax","page":page};
        $("#loadCliente").fadeIn('slow');
        $.ajax({
            url:'consulta/cargarCliente.php',
            data: parametros,
             beforeSend: function(objeto){
            $("#loadCliente").html("<img src='imagenes/loader.gif'>");
            },
            success:function(data){
                $(".outer_div").html(data).fadeIn('slow');
                $("#loadCliente").html("");
            }
        })
    }

        $('#modificarCliente').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Botón que activó el modal
          var nombre = button.data('nombre') // Extraer la información de atributos de datos
          var id = button.data('id') // Extraer la información de atributos de datos
          var fijo = button.data('fijo') // Extraer la información de atributos de datos
          var celular = button.data('celular') // Extraer la información de atributos de datos
          var correo = button.data('correo') // Extraer la información de atributos de datos
          var nit = button.data('nit') // Extraer la información de atributos de datos
          
          var modal = $(this)
          modal.find('.modal-title').text('Modificar cliente: '+nombre)
          modal.find('.modal-body #id').val(id)
          modal.find('.modal-body #nombre').val(nombre)
          modal.find('.modal-body #fijo').val(fijo)
          modal.find('.modal-body #celular').val(celular)
          modal.find('.modal-body #correo').val(correo)
          modal.find('.modal-body #nit').val(nit)
          $('.alert').hide();//Oculto alert
        })
        
        $('#eliminarCliente').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Botón que activó el modal
          var id = button.data('id') // Extraer la información de atributos de datos
          var modal = $(this)
          modal.find('#id').val(id)
        })

    $( "#actualizarCliente" ).submit(function( event ) {
        var parametros = $(this).serialize();
             $.ajax({
                    type: "POST",
                    url: "consulta/actualizarCliente.php",
                    data: parametros,
                     beforeSend: function(objeto){
                       
                      },
                    success: function(datos){
                    $('#modificarCliente').modal('hide');
                    $('.modal-backdrop').remove();
                    location.reload();
                    
                  }
            });
          event.preventDefault();
        });
        
        $( "#guardarCliente" ).submit(function( event ) {
        var parametros = $(this).serialize();
             $.ajax({
                    type: "POST",
                    url: "consulta/nuevoCliente.php",
                    data: parametros,
                     beforeSend: function(objeto){
                       
                      },
                    success: function(datos){
                    
                    $('#registroCliente').modal('hide');
                    $('.modal-backdrop').remove();

                    location.reload();
                  }
            });
          event.preventDefault();
        });
        
        $( "#deshabilitarCliente" ).submit(function( event ) {
        var parametros = $(this).serialize();
             $.ajax({
                    type: "POST",
                    url: "consulta/deshabilitarCliente.php",
                    data: parametros,
                     beforeSend: function(objeto){
                        
                      },
                    success: function(datos){
               
                    $('#eliminarCliente').modal('hide');
                     $('.modal-backdrop').remove();
                     
                    location.reload();
                  }
            });
          event.preventDefault();
        });

        //finCliente

        //Empleado


 function load(page){
        var parametros = {"action":"ajax","page":page};
        $("#loadEmpleado").fadeIn('slow');
        $.ajax({
            url:'consulta/cargarEmpleado.php',
            data: parametros,
             beforeSend: function(objeto){
            $("#loadEmpleado").html("<img src='imagenes/loader.gif'>");
            },
            success:function(data){
                $(".outer_div").html(data).fadeIn('slow');
                $("#loadEmpleado").html("");
            }
        })
    }

        $('#modificarEmpleado').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Botón que activó el modal
          var nombreCompleto = button.data('nombre') // Extraer la información de atributos de datos
          var documento = button.data('documento') // Extraer la información de atributos de datos
          var telefono = button.data('fijo') // Extraer la información de atributos de datos
          var celular = button.data('celular') // Extraer la información de atributos de datos
          var email = button.data('correo') // Extraer la información de atributos de datos
          var direccion = button.data('direccion') // Extraer la información de atributos de datos
          var idEmpleado = button.data('id')
          var idUsuario = button.data('usuario')
          var idRol = button.data('rol')


          var modal = $(this)
          modal.find('.modal-title').text('Modificar empleado: '+nombreCompleto)
          modal.find('.modal-body #idEmpleado').val(idEmpleado)
          modal.find('.modal-body #documento').val(documento)
          modal.find('.modal-body #nombreCompleto').val(nombreCompleto)
          modal.find('.modal-body #telefono').val(telefono)
          modal.find('.modal-body #celular').val(celular)
          modal.find('.modal-body #email').val(email)
          modal.find('.modal-body #direccion').val(direccion)
          modal.find('.modal-body #idUsuario').val(idUsuario)
          modal.find('.modal-body #idRol').val(idRol)
          
     
          $('.alert').hide();//Oculto alert
        })
        
        $('#eliminarEmpleado').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Botón que activó el modal
          var id = button.data('id') // Extraer la información de atributos de datos
          var modal = $(this)
          modal.find('#id').val(id)
        })

    $( "#actualizarEmpleado" ).submit(function( event ) {
        var parametros = $(this).serialize();
             $.ajax({
                    type: "POST",
                    url: "../controladores/controladorEmpleado.php",
                    data: parametros,
                     beforeSend: function(objeto){
                        
                      },
                    success: function(datos){
                    $('#modificarEmpleado').modal('hide');
                    $('.modal-backdrop').remove();
                     
                    location.reload();
                  }
            });
          event.preventDefault();
        });
        
        $( "#guardarEmpleado" ).submit(function( event ) {
        var parametros = $(this).serialize();
             $.ajax({
                    type: "POST",
                    url: "../controladores/controladorEmpleado.php",
                    data: parametros,
                     beforeSend: function(objeto){
                        
                      },
                    success: function(datos){
                    
                    $('#registroEmpleado').modal('hide');
                    $('.modal-backdrop').remove();
                    location.reload();
                  }
            });
          event.preventDefault();
        });
        
        $( "#inhabilitarEmpleado" ).submit(function( event ) {
        var parametros = $(this).serialize();
             $.ajax({
                    type: "POST",
                    url: "../controladores/controladorEmpleado.php",
                    data: parametros,
                     beforeSend: function(objeto){
                        
                      },
                    success: function(datos){
               
                    $('#eliminarEmpleado').modal('hide');
                     $('.modal-backdrop').remove();
                     
                    location.reload();
                  }
            });
          event.preventDefault();
        });



        //FinEmpleado


        // gestion Proyecto



        $('#modificarProyecto').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Botón que activó el modal
          var nombre = button.data('nombre') // Extraer la información de atributos de datos
          var id = button.data('id') // Extraer la información de atributos de datos
          var inicio = button.data('inicio') // Extraer la información de atributos de datos
          var fin = button.data('fin') // Extraer la información de atributos de datos
          var avance = button.data('avance') // Extraer la información de atributos de datos
          var cliente = button.data('cliente') // Extraer la información de atributos de datos
          
          var idEstado = button.data('idestado')

          var modal = $(this)
          modal.find('.modal-title').text('Modificar proyecto: '+nombre)
          modal.find('.modal-body #id').val(id)
          modal.find('.modal-body #nombre').val(nombre)
          modal.find('.modal-body #inicio').val(inicio)
          modal.find('.modal-body #fin').val(fin)
          modal.find('.modal-body #cliente').val(cliente)
          modal.find('.modal-body #idEstado').val(idEstado)
          modal.find('.modal-body #avance').val(avance)

          $('.alert').hide();//Oculto alert

        })
        
        $('#eliminarProyecto').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Botón que activó el modal
          var id = button.data('id') // Extraer la información de atributos de datos
          var modal = $(this)
          modal.find('#id').val(id)
        })

    $( "#actualizarProyecto" ).submit(function( event ) {
        var parametros = $(this).serialize();
             $.ajax({
                    type: "POST",
                    url: "../controladores/controladorProyecto.php",
                    data: parametros,
                     beforeSend: function(objeto){
                        
                      },
                    success: function(datos){
                    $('#modificarProyecto').modal('hide');
                
                     $('.modal-backdrop').remove();
                     location.reload();

                   

                  }
            });
          event.preventDefault();
        });
        
        $( "#guardarProyecto" ).submit(function( event ) {
        var parametros = $(this).serialize();
             $.ajax({
                    type: "POST",
                    url: "../controladores/controladorProyecto.php",
                    data: parametros,
                     beforeSend: function(objeto){
                        
                      },
                    success: function(datos){
                    $('#registroProyecto').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove(); 

                    
                    location.reload();

                  }
            });
          event.preventDefault();
        });
        
        $( "#inhabilitarProyecto" ).submit(function( event ) {
        var parametros = $(this).serialize();
             $.ajax({
                    type: "POST",
                    url: "../controladores/controladorProyecto.php",
                    data: parametros,
                     beforeSend: function(objeto){
                        
                      },
                    success: function(datos){
                    $('#eliminarProyecto').modal('hide');
                     $('.modal-backdrop').remove();
                    location.reload();
                  }
            });
          event.preventDefault();
        });

        // fin gestion proyecto

        //material
         $('#modificarMaterial').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Botón que activó el modal
          var id = button.data('id') // Extraer la información de atributos de datos
          var ref = button.data('referencia') // Extraer la información de atributos de datos
          var esp = button.data('especificaciones') // Extraer la información de atributos de datos
          var can = button.data('cantidad') // Extraer la información de atributos de datos
          
          
          var modal = $(this)
          modal.find('.modal-title').text('Modificar material: '+ref)
          modal.find('.modal-body #id').val(id)
          modal.find('.modal-body #ref').val(ref)
          modal.find('.modal-body #esp').val(esp)
          modal.find('.modal-body #can').val(can)
  
          $('.alert').hide();//Oculto alert
        })
        
        $('#eliminarMaterial').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Botón que activó el modal
          var id = button.data('id') // Extraer la información de atributos de datos
          var modal = $(this)
          modal.find('#id').val(id)
        })

    $( "#actualizarMaterial" ).submit(function( event ) {
        var parametros = $(this).serialize();
             $.ajax({
                    type: "POST",
                    url: "consulta/actualizarMaterial.php",
                    data: parametros,
                     beforeSend: function(objeto){
                        
                      },
                    success: function(datos){
                    $('#modificarMaterial').modal('hide');
                     $('.modal-backdrop').remove();
                     

                    location.reload();
                  }
            });
          event.preventDefault();
        });
        
        $( "#guardarMaterial" ).submit(function( event ) {
        var parametros = $(this).serialize();
             $.ajax({
                    type: "POST",
                    url: "consulta/nuevoMaterial.php",
                    data: parametros,
                     beforeSend: function(objeto){
                        
                      },
                    success: function(datos){
                    
                    $('#registroMaterial').modal('hide');
                     $('.modal-backdrop').remove();
                    location.reload();
                  }
            });
          event.preventDefault();
        });
        
        $( "#deshabilitarMaterial" ).submit(function( event ) {
        var parametros = $(this).serialize();
             $.ajax({
                    type: "POST",
                    url: "consulta/deshabilitarMaterial.php",
                    data: parametros,
                     beforeSend: function(objeto){
                        
                      },
                    success: function(datos){
               
                    $('#eliminarMaterial').modal('hide');
                     $('.modal-backdrop').remove();
                     
                    location.reload();
                  }
            });
          event.preventDefault();
        });
//fin material



//Proveedor
         $('#modificarProveedor').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Botón que activó el modal
          var id = button.data('id') // Extraer la información de atributos de datos
          var nom = button.data('nombre') // Extraer la información de atributos de datos
          var ase = button.data('asesor') // Extraer la información de atributos de datos
          var tel = button.data('telefono') // Extraer la información de atributos de datos
          var cor = button.data('correo') // Extraer la información de atributos de datos
          var dir = button.data('direccion') // Extraer la información de atributos de datos
          
          var modal = $(this)
          modal.find('.modal-title').text('Modificar proveedor: '+nom)
          modal.find('.modal-body #id').val(id)
          modal.find('.modal-body #nombre').val(nom)
          modal.find('.modal-body #asesor').val(ase)
          modal.find('.modal-body #telefono').val(tel)
          modal.find('.modal-body #email').val(cor)
          modal.find('.modal-body #direccion').val(dir)
  
          $('.alert').hide();//Oculto alert
        })
        
        $('#eliminarProveedor').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Botón que activó el modal
          var id = button.data('id') // Extraer la información de atributos de datos
          var modal = $(this)
          modal.find('#id').val(id)
        })

    $( "#actualizarProveedor" ).submit(function( event ) {
        var parametros = $(this).serialize();
             $.ajax({
                    type: "POST",
                    url: "../controladores/controladorProveedor.php",
                    data: parametros,
                     beforeSend: function(objeto){
                        
                      },
                    success: function(datos){
                    $('#modificarProveedor').modal('hide');
                     $('.modal-backdrop').remove();
                     

                    location.reload();
                  }
            });
          event.preventDefault();
        });
        
        $( "#guardarProveedor" ).submit(function( event ) {
        var parametros = $(this).serialize();
             $.ajax({
                    type: "POST",
                    url: "../controladores/controladorProveedor.php",
                    data: parametros,
                     beforeSend: function(objeto){
                        
                      },
                    success: function(datos){
                    
                    $('#registroProveedor').modal('hide');
                     $('.modal-backdrop').remove();
                    location.reload();
                  }
            });
          event.preventDefault();
        });
        
        $( "#inhabilitarProveedor" ).submit(function( event ) {
        var parametros = $(this).serialize();
             $.ajax({
                    type: "POST",
                    url: "../controladores/controladorProveedor.php",
                    data: parametros,
                     beforeSend: function(objeto){
                        
                      },
                    success: function(datos){
               
                    $('#eliminarProveedor').modal('hide');
                     $('.modal-backdrop').remove();
                     
                    location.reload();
                  }
            });
          event.preventDefault();
        });
//fin Proveedor


//Equipo
        
        
        $('#registroEquipo').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Botón que activó el modal
          var id = button.data('id') // Extraer la información de atributos de datos
          var modal = $(this)
          modal.find('#idProyecto').val(id)
        })

$( "#guardarEquipo" ).submit(function( event ) {
        var parametros = $(this).serialize();
             $.ajax({
                    type: "POST",
                    url: "consulta/nuevoEquipo.php",
                    data: parametros,
                     beforeSend: function(objeto){
                        
                      },
                    success: function(datos){
                    
                    $('#registroEquipo').modal('hide');
                     $('.modal-backdrop').remove();
                    location.reload();
                  }
            });
          event.preventDefault();
        });
    
    $('#eliminarEquipo').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Botón que activó el modal
          var proy = button.data('pro') 
          var empl = button.data('emp') // Extraer la información de atributos de datos
          var modal = $(this)
          modal.find('.modal-body #emp').val(empl)
          modal.find('.modal-body #pro').val(proy)
          

        })

            $( "#deshabilitarEquipo" ).submit(function( event ) {
        var parametros = $(this).serialize();
             $.ajax({
                    type: "POST",
                    url: "consulta/deshabilitarEquipo.php",
                    data: parametros,
                     beforeSend: function(objeto){
                        
                      },
                    success: function(datos){
               
                    $('#eliminarEquipo').modal('hide');
                     $('.modal-backdrop').remove();
                     
                    location.reload();
                  }
            });
          event.preventDefault();
        });
//fin Equipo
//directorio

$('#registroDirectorio').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Botón que activó el modal
          var id = button.data('id') // Extraer la información de atributos de datos
          var modal = $(this)
          modal.find('#idMaterial').val(id)
        })
 
       
$( "#guardarDirectorio" ).submit(function( event ) {
        var parametros = $(this).serialize();
             $.ajax({
                    type: "POST",
                    url: "consulta/nuevoDirectorio.php",
                    data: parametros,
                     beforeSend: function(objeto){
                        
                      },
                    success: function(datos){
                    
                    $('#registroDirectorio').modal('hide');
                     $('.modal-backdrop').remove();
                    location.reload();
                  }
            });
          event.preventDefault();
        });

 $('#eliminarDirectorio').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Botón que activó el modal
          var material = button.data('mat') 
          var proveedor = button.data('pro') // Extraer la información de atributos de datos
          var modal = $(this)
          modal.find('.modal-body #mat').val(material)
          modal.find('.modal-body #pro').val(proveedor)
          

        })

            $( "#deshabilitarDirectorio" ).submit(function( event ) {
        var parametros = $(this).serialize();
             $.ajax({
                    type: "POST",
                    url: "consulta/deshabilitarDirectorio.php",
                    data: parametros,
                     beforeSend: function(objeto){
                        
                      },
                    success: function(datos){
               
                    $('#eliminarDirectorio').modal('hide');
                     $('.modal-backdrop').remove();
                     
                    location.reload();
                  }
            });
          event.preventDefault();
        });

            // fin directorio

            // Orden

    $('#registroOrden').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Botón que activó el modal
      var id = button.data('id') // Extraer la información de atributos de datos
      var modal = $(this)
      modal.find('#idPlano').val(id)
    })

   
    $( "#guardarOrden" ).submit(function( event ) {
      var parametros = $(this).serialize();
         $.ajax({
                type: "POST",
                url: "consulta/nuevoOrden.php",
                data: parametros,
                 beforeSend: function(objeto){
                    
                  },
                success: function(datos){
                
                $('#registroOrden').modal('hide');
                 $('.modal-backdrop').remove();
                location.reload();
              }
        });
      event.preventDefault();
    });

   $('#eliminarOrden').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Botón que activó el modal
      var id = button.data('id') // Extraer la información de atributos de datos
      var modal = $(this)
      modal.find('#idOrden').val(id)
    })

    $( "#deshabilitarOrden" ).submit(function( event ) {
      var parametros = $(this).serialize();
           $.ajax({
                  type: "POST",
                  url: "consulta/deshabilitarOrden.php",
                  data: parametros,
                   beforeSend: function(objeto){
                      
                    },
                  success: function(datos){
             
                  $('#eliminarOrden').modal('hide');
                   $('.modal-backdrop').remove();
                   
                  location.reload();
                }
          });
        event.preventDefault();
      });

    //Fin Orden

    //Tramite

    $('#registroTramite').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Botón que activó el modal
          var ord = button.data('ord') // Extraer la información de atributos de datos
          var mat = button.data('mat') // Extraer la información de atributos de datos
          var req = button.data('req') // Extraer la información de atributos de datos
          var disp = button.data('disp') // Extraer la información de atributos de datos
          var emp = button.data('emp') // Extraer la información de atributos de datos
          var modal = $(this)
          
          modal.find('.modal-body #ord').val(ord)
          modal.find('.modal-body #mat').val(mat)
          modal.find('.modal-body #req').val(req)
          modal.find('.modal-body #disp').val(disp)
          modal.find('.modal-body #emp').val(emp)
          $('.alert').hide();//Oculto alert

        })

        $( "#guardarTramite" ).submit(function( event ) {
      var parametros = $(this).serialize();
         $.ajax({
                type: "POST",
                url: "consulta/nuevoTramite.php",
                data: parametros,
                 beforeSend: function(objeto){
                    
                  },
                success: function(datos){
                
                $('#registroTramite').modal('hide');
                 $('.modal-backdrop').remove();
                location.reload();
              }
        });
      event.preventDefault();
    });

        //Tramite

        $( "#guardarEntradaTramite" ).submit(function( event ) {
        var parametros = $(this).serialize();
             $.ajax({
                    type: "POST",
                    url: "consulta/nuevoEntradaTramite.php",
                    data: parametros,
                     beforeSend: function(objeto){
                        
                      },
                    success: function(datos){
                    
                    $('#entradaTramite').modal('hide');
                     $('.modal-backdrop').remove();
                    location.reload();
                  }
            });
          event.preventDefault();
        });


    $('#devolucion').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Botón que activó el modal
          var ord = button.data('ord') // Extraer la información de atributos de datos
          var mat = button.data('mat') // Extraer la información de atributos de datos
          var con = button.data('con') // Extraer la información de atributos de datos
          var disp = button.data('disp') // Extraer la información de atributos de datos
          var emp = button.data('emp') // Extraer la información de atributos de datos
          var modal = $(this)
          
          modal.find('.modal-body #ord').val(ord)
          modal.find('.modal-body #mat').val(mat)
          modal.find('.modal-body #con').val(con)
          modal.find('.modal-body #disp').val(disp)
          modal.find('.modal-body #emp').val(emp)
          $('.alert').hide();//Oculto alert

        })

            $( "#guardarDevolucion" ).submit(function( event ) {
        var parametros = $(this).serialize();
             $.ajax({
                    type: "POST",
                    url: "consulta/nuevoDevolucion.php",
                    data: parametros,
                     beforeSend: function(objeto){
                        
                      },
                    success: function(datos){
                    
                    $('#devolucion').modal('hide');
                     $('.modal-backdrop').remove();
                    location.reload();
                  }
            });
          event.preventDefault();
        });

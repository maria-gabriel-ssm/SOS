<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Tester</title>
    <style type="text/css">
        body {
            font-family: "Lucida Console", "Courier New", monospace;
        }

        h4,
        h5 {
            font-weight: 600;
        }

        .form-control {
            background-color: gainsboro !important;
        }

        .form-dark {
            background-color: #444 !important;
        }
    </style>
</head>

<body class="bg-dark text-white">
    <div class="container mx-6">
        <form id="formi">
            <div class="row mt-4 pt-4">
                <div class="col-4">
                    <h6>Datos de la guía</h6>
                    <textarea type="text" id="texto" name="texto" rows="4" placeholder="Ingrese texto"
                        class="form-control mb-2" value="" required></textarea>
                    <h6>Lista de errores</h6>
                    <textarea type="text" id="error" name="error" rows="4" placeholder="Ingrese texto"
                        class="form-control mb-2" value=""></textarea>
                    <input type="checkbox" id="curps" name="curps" checked>&nbsp;Corregir Curps Formato GI<br>
                    <input type="checkbox" id="lista" name="lista">&nbsp;Corregir Lista Curps<br>
                    <input type="checkbox" id="errors" name="errors">&nbsp;Corregir Errores<br><br>
                    <button type="submit" class="btn btn-info" id="generar">Generar</button>
                    <button type="button" class="btn btn-secondary" id="limpiar">Limpiar</button>
                </div>
                <div class="col-8">
                    <textarea type="text" id="resul" rows="6" class="form-control form-dark text-white" readonly></textarea>
                    <textarea type="text" id="resul2" rows="5" class="form-control form-dark text-white" readonly></textarea>
                    <p id="totales" class="mt-2"></p>
                </div>
            </div>
            <div class="row pt-4">
                <div class="col-3">
                    <label>Fecha inicio</label>
                    <input type="date" id="feini" name="feini" placeholder="Fecha inicio" class="form-control"
                        value="" required>
                </div>
                <div class="col-3">
                    <label>Fecha fin</label>
                    <input type="date" id="fefin" name="fefin" placeholder="Fecha final" class="form-control"
                        value="" required>
                </div>
                <div class="col-6">
                    <label>Tipo consulta</label>
                    <select id="tipo" class="form-control" required>
                        <option value="">Seleccione opción</option>
                        <option value="CE">Consulta externa</option>
                        <option value="ENF">Enfermeria</option>
                        <option value="PF">Planificación familiar</option>
                        <option value="SM">Salud mental</option>
                        <option value="SB">Salud bocal</option>
                        <option value="DT">Detecciones</option>
                    </select>
                </div>
            </div>
            <div class="row pt-4">
                <div class="col-6">
                    <h5>Correctas</h5>
                    <textarea type="text" id="correctos" name="correctos" rows="5" placeholder="" class="form-control"
                        value=""></textarea>
                    <button type="submit" class="btn btn-info btn-block" id="copiar_ok">Guardar</button>
                </div>
                <div class="col-6">
                    <h5>Incorrectas</h5>
                    <textarea type="text" id="incorrectos" name="incorrectos" rows="5" placeholder="" class="form-control"
                        value=""></textarea>
                    <button type="submit" class="btn btn-info btn-block" id="copiar_nok">Guardar</button>
                </div>
            </div>
        </form>
    </div>
    <br>
</body>

</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    let curp;
    let check_curps;
    let check_errors;

    $('input[type="checkbox"]').on('change', function() {
        $('input[type="checkbox"]').not(this).prop('checked', false);
    });

    /*FUNCIONES PARA ANALIZAR QUE EL CURP SEA VALIDO ----------------------------------------------------------------------------------------*/

    (function(global) {
        'use strict';
        var comunes = ['MARIA', 'MA', 'MA.', 'JOSE', 'J', 'J.'];

        function filtraInconvenientes(str) {

            var inconvenientes = ['BACA', 'LOCO', 'BUEI', 'BUEY', 'MAME', 'CACA', 'MAMO', 'CACO',
                'MEAR', 'CAGA', 'MEAS', 'CAGO', 'MEON', 'CAKA', 'MIAR', 'CAKO', 'MION', 'COGE',
                'MOCO', 'COGI', 'MOKO', 'COJA', 'MULA', 'COJE', 'MULO', 'COJI', 'NACA', 'COJO',
                'NACO', 'COLA', 'PEDA', 'CULO', 'PEDO', 'FALO', 'PENE', 'FETO', 'PIPI', 'GETA',
                'PITO', 'GUEI', 'POPO', 'GUEY', 'PUTA', 'JETA', 'PUTO', 'JOTO', 'QULO', 'KACA',
                'RATA', 'KACO', 'ROBA', 'KAGA', 'ROBE', 'KAGO', 'ROBO', 'KAKA', 'RUIN', 'KAKO',
                'SENO', 'KOGE', 'TETA', 'KOGI', 'VACA', 'KOJA', 'VAGA', 'KOJE', 'VAGO', 'KOJI',
                'VAKA', 'KOJO', 'VUEI', 'KOLA', 'VUEY', 'KULO', 'WUEI', 'LILO', 'WUEY', 'LOCA'
            ];
            if (inconvenientes.indexOf(str) > -1) {
                str = str.replace(/^(\w)\w/, '$1X');
            }
            return str;
        }

        function ajustaCompuesto(str) {
            var compuestos = [/\bDA\b/, /\bDAS\b/, /\bDE\b/, /\bDEL\b/, /\bDER\b/, /\bDI\b/,
                /\bDIE\b/, /\bDD\b/, /\bEL\b/, /\bLA\b/, /\bLOS\b/, /\bLAS\b/, /\bLE\b/,
                /\bLES\b/, /\bMAC\b/, /\bMC\b/, /\bVAN\b/, /\bVON\b/, /\bY\b/
            ];
            compuestos.forEach(function(compuesto) {
                if (compuesto.test(str)) {
                    str = str.replace(compuesto, '');
                }
            });
            return str;
        }

        function zeropad(ancho, num) {
            var pad = Array.apply(0, Array.call(0, ancho)).map(function() {
                return 0;
            }).join('');
            return (pad + num).replace(new RegExp('^.*([0-9]{' + ancho + '})$'), '$1');
        }

        function primerConsonante(str) {
            if (str != undefined) {
              console.log("primer cosonante: "+ str.trim().substring(1)+"\n");
                str = str.trim().substring(1).replace(/[AEIOU]/ig, '').substring(0, 1);
                return (str === '' || str === 'Ñ') ? 'X' : str;
            } else {
                return 'X';
            }

        }

        function filtraCaracteres(str) {
            return str.toUpperCase().replace(/[\d_\-\.\/\\,]/g, 'X');
        }

        function estadoValido(str) {
            var estado = ['AS', 'BC', 'BS', 'CC', 'CS', 'CH', 'CL', 'CM', 'DF', 'DG',
                'GT', 'GR', 'HG', 'JC', 'MC', 'MN', 'MS', 'NT', 'NL', 'OC', 'PL', 'QT',
                'QR', 'SP', 'SL', 'SR', 'TC', 'TS', 'TL', 'VZ', 'YN', 'ZS', 'NE'
            ];
            return (estado.indexOf(str.toUpperCase()) > -1);
        }

        function normalizaString(str) {
            var origen, destino, salida;
            origen = ['Ã', 'À', 'Á', 'Ä', 'Â', 'È', 'É', 'Ë', 'Ê', 'Ì', 'Í', 'Ï', 'Î',
                'Ò', 'Ó', 'Ö', 'Ô', 'Ù', 'Ú', 'Ü', 'Û', 'ã', 'à', 'á', 'ä', 'â',
                'è', 'é', 'ë', 'ê', 'ì', 'í', 'ï', 'î', 'ò', 'ó', 'ö', 'ô', 'ù',
                'ú', 'ü', 'û', 'Ç', 'ç'
            ];
            destino = ['A', 'A', 'A', 'A', 'A', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I',
                'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'a', 'a', 'a', 'a', 'a',
                'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'u',
                'u', 'u', 'u', 'c', 'c'
            ];
            str = str.split('');
            salida = str.map(function(char) {
                var pos = origen.indexOf(char);
                return (pos > -1) ? destino[pos] : char;
            });
            return salida.join('');
        }

        function agregaDigitoVerificador(curp_str) {
            var curp, caracteres, curpNumerico, suma, digito;
            curp = curp_str.substring(0, 17).toUpperCase().split('');
            caracteres = [
                '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E',
                'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'Ñ', 'O', 'P', 'Q', 'R', 'S',
                'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
            ];
            curpNumerico = curp.map(function(caracter) {
                return caracteres.indexOf(caracter);
            });
            suma = curpNumerico.reduce(function(prev, valor, indice) {
                return prev + (valor * (18 - indice));
            }, 0);
            digito = (10 - (suma % 10));
            if (digito === 10) {
                digito = 0;
            }
            return curp_str + digito;
        }

        function extraerInicial(nombre) {
            var nombres, primerNombreEsComun;
            nombres = nombre.toUpperCase().trim().split(/\s+/);
            primerNombreEsComun = (nombres.length > 1 && comunes.indexOf(nombres[0]) > -1);
            if (primerNombreEsComun) {
                return nombres[1].substring(0, 1);
            }
            return nombres[0].substring(0, 1);
        }

        function generaCurp(param) {
            var inicial_nombre, vocal_apellido, posicion_1_4, posicion_14_16, curp, primera_letra_paterno,
                primera_letra_materno, nombres, nombre_a_usar, pad;

            pad = zeropad.bind(null, 2);
            if (!estadoValido(param.estado)) {
                return false;
            }

            param.nombre = ajustaCompuesto(normalizaString(param.nombre.toUpperCase())).trim();
            param.apellido_paterno = ajustaCompuesto(normalizaString(param.apellido_paterno.toUpperCase())).trim();

            param.apellido_materno = param.apellido_materno || "";
            param.apellido_materno = ajustaCompuesto(normalizaString(param.apellido_materno.toUpperCase())).trim();

            inicial_nombre = extraerInicial(param.nombre);

            vocal_apellido = param.apellido_paterno.trim().substring(1).replace(/[BCDFGHJKLMNÑPQRSTVWXYZ]/g, '')
                .substring(0, 1);
            vocal_apellido = (vocal_apellido === '') ? 'X' : vocal_apellido;

            primera_letra_paterno = param.apellido_paterno.substring(0, 1);
            primera_letra_paterno = primera_letra_paterno === 'Ñ' ? 'X' : primera_letra_paterno;

            if (!param.apellido_materno || param.apellido_materno === "") {
                primera_letra_materno = 'X';
            } else {
                primera_letra_materno = param.apellido_materno.substring(0, 1);
                primera_letra_materno = primera_letra_materno === 'Ñ' ? 'X' : primera_letra_materno;
            }

            posicion_1_4 = [primera_letra_paterno, vocal_apellido, primera_letra_materno, inicial_nombre].join('');
            posicion_1_4 = filtraInconvenientes(filtraCaracteres(posicion_1_4));

            nombres = param.nombre.split(" ").filter(function(palabra) {
                return palabra !== "";
            });
            nombre_a_usar = comunes.indexOf(nombres[0]) > -1 ? nombres[1] : nombres[0];

            posicion_14_16 = [primerConsonante(param.apellido_paterno), primerConsonante(param.apellido_materno),
                primerConsonante(nombre_a_usar)
            ].join('');

            curp = [
                posicion_1_4,
                pad(param.fecha_nacimiento[2] - 1900), pad(param.fecha_nacimiento[1]), pad(param
                    .fecha_nacimiento[0]),
                param.sexo.toUpperCase(), param.estado.toUpperCase(),
                posicion_14_16, param.homonimia || (param.fecha_nacimiento[2] > 1999 ? 'A' : 0)
            ].join('');
            return agregaDigitoVerificador(curp);
        }
        if (global.hasOwnProperty('window') && global.window === global) {
            global.generaCurp = generaCurp;
        } else {
            module.exports = generaCurp;
        }
    }(this));

    function calcularCurp(nom, apepa, apema, sex, est, dia, mes, anio) {
        var nombre = nom;
        var apellido_paterno = apepa;
        var apellido_materno = apema;
        var sexo = sex;
        var estado = est;
        var fecha_nacimiento = [dia, mes, anio];

        curp = generaCurp({
            nombre: nombre,
            apellido_paterno: apellido_paterno,
            apellido_materno: apellido_materno,
            sexo: sexo,
            estado: estado,
            fecha_nacimiento: fecha_nacimiento
        });
    }

    function validarInput(input) {
        var curp = input.toUpperCase(),
            resultado = document.getElementById("resultado2"),
            valido = "No válido";
        if (curpValida(curp)) {
            valido = "Válido";
            resultado.classList.add("ok");
        } else {
            resultado.classList.remove("ok");
        }
        resultado.innerText = "CURP: " + curp + "\nFormato: " + valido;
    }

    function extraerClave(clave) {
        if (clave == 0) {
            return "NE";
        } else if (clave == 1) {
            return "AS";
        } else if (clave == 2) {
            return "BC";
        } else if (clave == 3) {
            return "BS";
        } else if (clave == 4) {
            return "CC";
        } else if (clave == 5) {
            return "CL";
        } else if (clave == 6) {
            return "CM";
        } else if (clave == 7) {
            return "CS";
        } else if (clave == 8) {
            return "CH";
        } else if (clave == 9) {
            return "DF";
        } else if (clave == 10) {
            return "DG";
        } else if (clave == 11) {
            return "GT";
        } else if (clave == 12) {
            return "GR";
        } else if (clave == 13) {
            return "HG";
        } else if (clave == 14) {
            return "JC";
        } else if (clave == 15) {
            return "MC";
        } else if (clave == 16) {
            return "MN";
        } else if (clave == 17) {
            return "MS";
        } else if (clave == 18) {
            return "NT";
        } else if (clave == 19) {
            return "NL";
        } else if (clave == 20) {
            return "OC";
        } else if (clave == 21) {
            return "PL";
        } else if (clave == 22) {
            return "QT";
        } else if (clave == 23) {
            return "QR";
        } else if (clave == 24) {
            return "SP";
        } else if (clave == 25) {
            return "SL";
        } else if (clave == 26) {
            return "SR";
        } else if (clave == 27) {
            return "TC";
        } else if (clave == 28) {
            return "TS";
        } else if (clave == 29) {
            return "TL";
        } else if (clave == 30) {
            return "VZ";
        } else if (clave == 31) {
            return "YN";
        } else if (clave == 32) {
            return "ZS";
        } else if (clave == 88) {
            return "NA";
        } else if (clave == 99) {
            return "SI";
        } else {
            return "ERR"
        }
    }

    function curpValida(curp) {
        var re =
            /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0\d|1[0-2])(?:[0-2]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
            validado = curp.match(re);

        if (!validado)
            return false;

        function digitoVerificador(curp17) {
            var diccionario = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ",
                lngSuma = 0.0,
                lngDigito = 0.0;
            for (var i = 0; i < 17; i++)
                lngSuma = lngSuma + diccionario.indexOf(curp17.charAt(i)) * (18 - i);
            lngDigito = 10 - lngSuma % 10;
            if (lngDigito == 10)
                return 0;
            return lngDigito;
        }
        if (validado[2] != digitoVerificador(validado[1]))
            return false;

        return true;
    }

    $('#limpiar').on('click', function() {
        location.reload();
    });

    /*FUNCIONES PARA GUARDAR LOS ARCHIVOS CON LOS REGISTROS ---------------------------------------------------------------------------------*/

    $('#copiar_ok').on('click', function() {
        var feini = document.getElementById("feini").value;
        var fefin = document.getElementById("fefin").value;
        var tipo = document.getElementById("tipo").value;
        if (feini != '' && fefin != '' && tipo != '') {
            const a = document.createElement("a");
            const archivo = new Blob([document.getElementById("correctos").value], {
                type: 'text/plain'
            });
            const url = URL.createObjectURL(archivo);
            a.href = url;
            a.download = "CORRECTOS_" + tipo + "_" + feini + "-" + fefin;
            a.click();
            URL.revokeObjectURL(url);
        }
    });

    $('#copiar_nok').on('click', function() {
        var feini = document.getElementById("feini").value;
        var fefin = document.getElementById("fefin").value;
        var tipo = document.getElementById("tipo").value;
        if (feini != '' && fefin != '' && tipo != '') {
            const a = document.createElement("a");
            const archivo = new Blob([document.getElementById("incorrectos").value], {
                type: 'text/plain'
            });
            const url = URL.createObjectURL(archivo);
            a.href = url;
            a.download = "INCORRECTOS_" + tipo + "_" + feini + "-" + fefin;
            a.click();
            URL.revokeObjectURL(url);
        }
    });

    /*SE OBTIENE LA OPERACIÓN A EJECUTAR (CORREGIR CURPS O QUITAR ERRORES) ------------------------------------------------------------------*/

    $("#curps").on('change', function() {
        check_curps = document.getElementById('curps').checked;
        document.getElementById("error").required = false;
    });
    $("#lista").on('change', function() {
        check_lista = document.getElementById('lista').checked;
    });
    $("#errors").on('change', function() {
        check_errors = document.getElementById('errors').checked;
        document.getElementById("error").required = true;
    });

    $('#generar').on('click', function() {
        let texto = $('#texto').val().trim();
        let error = $('#error').val().trim();
        check_curps = document.getElementById('curps').checked;
        check_lista = document.getElementById('lista').checked;
        check_errors = document.getElementById('errors').checked;

        if (texto != '') {
            $('#resul').text('');
            $('#resul2').text('');
            $('#correctos').text('');
            $('#incorrectos').text('');
            let correctos = [];
            let incorrectos = [];
            let imprimir_datos = '';
            let imprimir_error = '';
            let imprimir_curp = '';
            let imprimir_retirar = '';
            let datos = texto.split('\n');
            let errores = error.split('\n');

    /*INICIAMOS GUARDANDO LOS ERRORES EN imprimir_error e imprimir_retirar ----------------------------------------------------------------*/

            for (var i = 0; i < errores.length; i++) {
                if (errores[i].startsWith('Registro')) {
                    imprimir_error = imprimir_error + (errores[i].replace(/[^0-9]/ig, "") + " ");
                    imprimir_retirar = imprimir_retirar + (errores[i].replace(/[^0-9]/ig, "") + " ");
                }
            }

            //se acomodan en forma de arreglo eliminando espacios en blanco 
            imprimir_retirar = imprimir_retirar.split(' ');
            imprimir_retirar.pop();
            imprimir_error = imprimir_error.split(' ');
            imprimir_error.pop();

            let tot_invalidas = 0;
            let tot_validas = 0;

            if (check_curps) {
                for (var i = 1; i < datos.length; i++) {
                    pacienteCurp = datos[i].split('|');
                    clave = extraerClave(pacienteCurp[12]);
                    if (clave != "ERR") {
                        //if (curpValida(pacienteCurp[7])) {
                            // console.log((i+1)+"! CURP: " + pacienteCurp[7] + " Formato: VALIDO");
                        //} else {
                            tot_invalidas += 1;
                            console.log((i + 1) + "! CURP: " + pacienteCurp[7] + " Formato: INVALIDO");
                            fecha = pacienteCurp[11].split('/');
                            if (pacienteCurp[13] == 2) {
                                sexo = "M"
                            } else {
                                sexo = "H"
                            }
                            calcularCurp(pacienteCurp[8], pacienteCurp[9], pacienteCurp[10], sexo, clave, fecha[
                                0], fecha[1], fecha[2]);
                            if (curpValida(curp)) {
                                imprimir_curp = imprimir_curp + (i + 1) + " ";
                                tot_validas += 1;
                                datos[i] = datos[i].replace(pacienteCurp[7], curp);
                                console.log("NUEVO GENERADO: " + curp);
                            } else {
                                console.log((i + 1) + "NO GENERADO: " + curp);
                            }
                        //}
                    }
                }
            }

            if (check_lista) {
                for (var i = 1; i < datos.length; i++) {
                    pacienteCurp = datos[i];
                        if (curpValida(pacienteCurp)) {
                             console.log((i+1)+"! CURP: " + pacienteCurp + " Formato: VALIDO");
                        } else {
                            tot_invalidas += 1;
                            console.error((i + 1) + "! CURP: " + pacienteCurp + " Formato: INVALIDO");
                            fecha = pacienteCurp.split('');
                            /*if (pacienteCurp[13] == 2) {
                                sexo = "M"
                            } else {
                                sexo = "H"
                            }
                            calcularCurp(pacienteCurp[8], pacienteCurp[9], pacienteCurp[10], sexo, clave, fecha[
                                0], fecha[1], fecha[2]);
                            if (curpValida(curp)) {
                                imprimir_curp = imprimir_curp + (i + 1) + " ";
                                tot_validas += 1;
                                datos[i] = datos[i].replace(pacienteCurp[7], curp);
                                console.log("NUEVO GENERADO: " + curp);
                            } else {
                                console.log((i + 1) + "NO GENERADO: " + curp);
                            }
                            */
                        }
                }
            }

            imprimir_curp = imprimir_curp.split(' ');
            imprimir_curp.pop();

            // if(check_curps){
            //   for (var i = 0; i < imprimir_retirar.length; i++) {
            //     for (var j = 0; j < imprimir_curp.length; j++) {
            //       if(imprimir_retirar[i] == imprimir_curp[j]){
            //         imprimir_retirar.splice(i, 1);
            //       }
            //     }
            //   }
            //   console.log(imprimir_retirar);
            // }


            for (var i = 0; i < datos.length; i++) {
                  encontrado = encuentra(i + 1);
                  if (encontrado) {
                      incorrectos[i] = datos[i];
                      console.log("se guarda en los incorrectos: "+datos[i]);
                  } else {
                      console.log("se guarda " + (i + 1));
                      correctos[i] = datos[i];
                  }
                imprimir_datos = imprimir_datos + ((i + 1) + "!" + datos[i]);
                if (i != datos.length - 1) {
                    imprimir_datos = imprimir_datos + "\n";
                }
            }

            function encuentra(linea) {
                for (var j = 0; j < imprimir_retirar.length; j++) {
                  if (check_errors) {
                    if (imprimir_retirar[j] == linea) {
                        imprimir_retirar.shift();
                        return true;
                    } else {
                        return false;
                    }
                    return false;
                  }
                }
            }

            let imp_correctos = '';
            let imp_incorrectos = '';
            let tot_correctos = 0;
            let tot_incorrectos = 0;

            for (var i = 0; i < correctos.length; i++) {
                if (correctos[i] != undefined) {
                    imp_correctos = imp_correctos + correctos[i];
                    if (i != correctos.length - 1) {
                        imp_correctos = imp_correctos + "\n";
                    }
                    tot_correctos += 1;
                }
            }
            imp_incorrectos = imp_incorrectos + datos[0] + "\n";
            for (var i = 0; i < incorrectos.length; i++) {
                if (incorrectos[i] != undefined) {
                    imp_incorrectos = imp_incorrectos + incorrectos[i];
                    if (i != incorrectos.length - 1) {
                        imp_incorrectos = imp_incorrectos + "\n";
                    }
                    tot_incorrectos += 1;
                }
            }

            imp_correctos.replace("undefined ", "");
            imp_incorrectos.replace("undefined ", "");
            $("#resul").text(imprimir_datos);
            if (check_curps) {
                $("#resul2").text("CURPS: [" + imprimir_curp + "]");
            }
            if (check_errors) {
                $("#resul2").text("ERROR: [" + imprimir_error + "]");
            }
            $("#correctos").text(imp_correctos);
            if (check_errors) {
                $("#incorrectos").text(imp_incorrectos);
            }

            $("#totales").text("Total: " + datos.length + "\nCorrectos: " + tot_correctos + "\nIncorrectos: " +
                tot_incorrectos + "\nCurps corregidas: " + tot_validas);
        }
    });
</script>

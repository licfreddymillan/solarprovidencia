<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Certificado</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <style>
            @font-face {
                font-family: 'Savoye LET Plain';
                src: url('template/fonts/Savoye LET Plain.ttf');
            }
            html{
              margin: 0;
              min-height: 100%;
            }
            body{
                font-family: Helvetica;
                background-image: url('https://academia.solarprovidencia.com/images/fondo.jpeg'); 
                background-repeat: no-repeat;
                background-size: cover;
            }
            .content{
                padding-top: 25%;
                text-align: center;
            }
            .h3{
                font-size: 30px;
                font-weight: bold;
                color: white;
            }
            .username{
                padding-top: 15px;
                font-size: 50px;
                color: gold;
                font-weight: normal;
            }
            .course-div{
                padding: 20px 10% 0px 10%;
                font-size: 28px;
                font-weight: bold;
                color: white;
            }
            .course{
                padding-top: 30px;
                font-size: 28px;
                color: white;
                font-weight: bold;
            }
            .ceo{
                text-align: center;
                padding: 25px 15% 0px 15%;
                position: relative;
            }
            .ceo-name{
                border: solid white 3px; 
                color: gold; 
                font-size: 24px; 
                padding: 15px 45px; 
                position: absolute; 
                top: 130px; 
                left: 45%;
            }
            .thin-line{
                height: 2px;
                background-color: white;
            }
            .thick-line{
                height: 8px;
                background-color: white;
            }
        </style>
    </head>
    <body>
        <div class="content">  
            <div class="h3">
                Solar Providencia otorga el <br>
                siguiente reconocimiento a:
            </div>
    
            <div class="username">{{ Auth::user()->name }}</div>
                
            <div class="course-div">
                <hr class="thin-line">
                <hr class="thick-line">
                Por concluir el taller de 

                <div class="course"><i>{{ $datosCurso->title }}</i></div>
                <hr class="thick-line">
                <hr class="thin-line">
            </div>

            <div class="ceo">
                <img src="https://academia.solarprovidencia.com/images/firma.png" width="30%" style="position: absolute; top: -15px; left: 55%;">
                <div class="ceo-name">Otorga S.P y Damián Chávez</div>
             </div>
        </div>
    </body>
</html>
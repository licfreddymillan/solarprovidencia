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
            }
            .h3{
                font-size: 25px;
                font-weight: normal;
            }
            h2{
                font-weight: bold;
            }
            .logo{
                margin-top: 20px;
                text-align: center;
            }
            .content{
                margin-top: 10px;
                text-align: center;
            }
            .username{
                font-size: 60px;
                color: #0862A9;
                font-weight: normal;
            }
            .course{
                padding-top: 10px;
                padding-left: 25px;
                padding-right: 25px;
                font-size: 25px;
                color: #0094CB;
                font-weight: normal;
            }
            .banner-inferior{
                position: absolute;
                bottom: 0;
                width: 100%;
                height: 40px;
            }
            .duration{
                font-size: 18px;
                /*color: #A1A1A1;*/
                padding-top: 5px;
                font-style: oblique;
            }
            .date{
                text-align: center;
                padding-top: 25px;
                font-size: 18px;
                font-style: oblique;
            }
            .ceo{
                text-align: center;
                padding-top: 20px;
            }
        </style>
    </head>
    <body>
        <div class="banner-superior">
            <img src="images/banner_inferior_certificado.png" width="100%">
        </div>
        
        <div class="logo">
            <img src="logos/logo.png" width="30%">
        </div>

        <div class="content">  
            <div>
                <span class="h3">En nombre de la academia Solar Providencia</span>

                <h2>SE CERTIFICA A</h2>
            </div>

            <div class="username">{{ Auth::user()->name }}</div>
            
            <div class="h3"> Cumpliendo los requisitos del curso en la plataforma Online exitosamente, <br>se le otorga con derechos de certificado de:</div>

            <div class="course">{{ $datosCurso->title }}</div>

            @if (!is_null($datosCurso->duration))
                <div class="duration">Con una duración de <b>{{ $datosCurso->duration }}</b></div>
            @endif
        </div>

        <div>
            
        </div>
        <div class="date">
            {{ $fecha_fin }}
        </div>

        <div class="banner-inferior">
            <img src="images/banner_inferior_certificado.png" width="100%">
        </div>

        <div class="ceo">
           <img src="images/firma_sty.png" width="20%"><br>
           <span><b>Damián Chávez</b></span><br>
           <span><b>CEO FUNDADOR</b></span>
        </div>
    </body>
</html>
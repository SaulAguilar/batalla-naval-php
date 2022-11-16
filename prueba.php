    <?php
    $n = $_GET["Jugador1"];
    $e = $_GET["Jugador2"];
    echo "<center>";
    echo "JUGADOR 1: ";
    echo $n;
    echo "<br>";
    echo "<br>";
    echo "JUGADOR 2: ";
    echo $e;
    echo "</center>";
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>JUEGO</title>
        <style>
            .fondo{
                background-size: cover;
                color: white;
            }
            .btni{
                color:white;
                background-color: black;
                transition: background-color .5s;
                width: 150px;
                height: 70px;
                font-size:x-large;
            }
            .btni:hover{
                background-color: red;
            }
            .tab1{
                width: 70px; 
                height: 70px; 
                background-color: white; 
                border: solid 2px red; 
                border-radius: 2px; 
                transition: background-color .5s;
            }
            .tab1:hover{
                background-color: black;
            }
            .tab2{
                width: 70px; 
                height: 70px; 
                background-color: white; 
                border: solid 2px red; 
                border-radius: 2px; 
                transition: background-color .5s;
            }
            .tab2:hover{
                background-color: black;
            }
        </style>
    </head>
    <body class="fondo" background="img/fondo.jpg">
        <center>
            <div>
                <br><br><br><br>
                <button class="btni" id="btnInicio">Iniciar</button>
            </div>
            <div>
                <br><br>
                <b><span id="txt" style="display:none; font-size:30px;">ELIJE LA CASILLA EN LA QUE QUIERES TIRAR</span></b>
                <br>
            </div>
            <div id="t1" style="display:none;">
            <h3>TE TOCA <?php echo $n;?></h3>
            <br><br>
            <table>
                <?php
                for($i=0;$i<10;$i++){
                ?>
                    <tr>
                    <?php
                    for($j=0;$j<10;$j++){
                    ?>
                    <td class="tab1" id="<?php echo $i;?>-<?php echo $j;?>-j2" onclick="tirarj1('<?php echo $i;?>','<?php echo $j;?>')"></td>
                    <?php
                    }
                    ?>
                    </tr>
                <?php
                }
                ?>
            </table>
            </div>
            <div id="t2" style="display:none;">
            <h3>ES TU TURNO <?php echo $e;?></h3>
            <br><br>
            <table>
                <?php
                for($i=0;$i<10;$i++){
                ?>
                    <tr>
                    <?php
                    for($j=0;$j<10;$j++){
                    ?>
                    <td class="tab2" id="<?php echo $i;?>-<?php echo $j;?>-j1"  onclick="tirarj2('<?php echo $i;?>','<?php echo $j;?>')"></td>
                    <?php
                    }
                    ?>
                    </tr>
                <?php
                }
                ?>
            </table>
            </div>
        </center>
        <script>
            nj1="<?php echo $n;?>";
            nj2="<?php echo $e;?>";
            var b=document.getElementById("btnInicio");
            var t1=document.getElementById("t1");
            var t2=document.getElementById("t2");
            var txt=document.getElementById("txt");
            var tj1=[[],[],[],[],[],[],[],[],[],[]];
            var tj2=[[],[],[],[],[],[],[],[],[],[]];
            var bj1=0;
            var bj2=0;
            var bj1x=[];
            var bj1y=[];
            var bj2x=[];
            var bj2y=[];
            var turnoj1=true;
            var turnoj2=false;
            var ganar=false;

            for(let i=0;i<10;i++){
                for(let j=0;j<10;j++){
                    tj1[i][j]=0;
                    tj2[i][j]=0;
                }
            }
            while(bj1<10){
                let x = Math.floor(Math.random()*(9-0)+0);
                let y = Math.floor(Math.random()*(9-0)+0);
                if(tj1[y][x]!=1){
                    bj1x[bj1]=x;
                    bj1y[bj1]=y;
                    tj1[y][x]=1
                    bj1++
                }
            }
            while(bj2<10){
                let x = Math.floor(Math.random()*(9-0)+0);
                let y = Math.floor(Math.random()*(9-0)+0);
                if(tj2[y][x]!=1){
                    bj2x[bj2]=x;
                    bj2y[bj2]=y;
                    tj2[y][x]=1
                    bj2++
                }
            }

            b.addEventListener('click', function(){
                b.style.display="none";
                t1.style.display="block";
                txt.style.display="block";
            })

            function tirarj1(y,x){
                if(ganar!=true){
                    if(tj2[y][x]==1){
                        txt.textContent=nj1+" ACERTASTE. VUELVE A TIRAR";
                        document.getElementById(y+"-"+x+"-j2").style.backgroundColor="green";
                        tj2[y][x]=2;
                        turnoj1=true;
                        bj2--;

                        if(bj2==0){
                            alert(nj1+" GANO");
                            txt.textContent=nj1+" GANO";
                            ganar=true;
                        }
                    }else if(tj2[y][x]==2){
                        txt.textContent="ESTA CASILLA YA NO ESTA DISPONIBLE";
                        turnoj1=true;
                    }else if(tj2[y][x]==0){
                        document.getElementById(y+"-"+x+"-j2").style.backgroundColor="black";
                        tj2[y][x]=2;
                        txt.textContent=nj1+" FALLO, ES TU TURNO "+nj2;
                        turnoj1=false
                    }
                    if(turnoj1==false){
                        t1.style.display="none";
                        t2.style.display="block";
                    }
                }
            }

            function tirarj2(y,x){
                if(ganar!=true){
                    if(tj1[y][x]==1){
                        txt.textContent=nj2+" ACERTASTE. VUELVE A TIRAR";
                        document.getElementById(y+"-"+x+"-j1").style.backgroundColor="green";
                        tj1[y][x]=2;
                        turnoj2=true;
                        bj1--;

                        
                        if(bj1==0){
                            alert(nj2+" GANO");
                            txt.textContent=nj2+" GANO";
                            ganar=true;
                        }
                    }else if(tj1[y][x]==2){
                        txt.textContent="ESTA CASILLA YA NO ESTA DISPONIBLE";
                        turnoj2=true;
                    }else if(tj1[y][x]==0){
                        document.getElementById(y+"-"+x+"-j1").style.backgroundColor="black";
                        tj1[y][x]=2;
                        txt.textContent=nj2+" FALLO, ES TU TURNO "+nj1;
                        turnoj2=false;
                    }
                    if(turnoj2==false){
                        t1.style.display="block";
                        t2.style.display="none";
                    }
                }
            }
        </script>
        <center>
        <button class="btni"> <a href="index.html">REINICIAR</a> </button>
        </center>
    </body>
    </html>
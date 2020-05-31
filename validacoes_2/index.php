<!doctype html>
<html lang="pt-br">
  <head>
    <title>Validação</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="estilo.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

    <main class="container">
        <section class="secao_form">
            <div class="card" style="width: 25rem;">
                <!-- A super global $_SERVER com PHP_SELF passado como parâmetro se refere ao nome do próprio arquivo que esta executando.
                -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form mt-3 mb-3">
                    <h1>Form</h1>

                    <div class="form-row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Idade</label>
                                <input type="text" class="form-control" id="idade"
                                name="idade" placeholder="Sua idade">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" id="email" 
                                name="email" placeholder="Seu email">
                            </div>
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <label>Peso</label>
                        <input type="text" class="form-control" id="peso"
                        name="peso" placeholder="Seu peso">
                    </div>
                        

                    <div class="btns mb-3">
                        <button type="submit" name="enviarForm" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="sw.js"></script>
  </body>
</html>

<?php 
    // Incluo arquivo de configurações
    include "./config.php";

    if(isset($_POST['enviarForm'])){
        // Validações
        $erros = [];

        // filter_input recebe o tipo de envio, o nome do campo, e o tipo de filtro
        if(!$idade = filter_input(INPUT_POST, 'idade', FILTER_VALIDATE_INT)){
            $erros[] = "A idade está incorreta";
        }

        else if(!$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)){
            $erros[] = "O email está incorreto";
        }

        else if(!$peso = filter_input(INPUT_POST, 'peso', FILTER_VALIDATE_FLOAT)){
            $erros[] = "O peso está incorreto";
        }

        // Erros
        if(!empty($erros)){
            // Mostrar erros
            foreach($erros as $erro){ ?>
                <script>
                    swal({
                        text: '<?php echo $erro; ?>',
                        icon: 'error'
                    })

                </script>   
            <?php
            }
        }   
        else{ ?>
            <script>
                swal({
                    text: 'Dados enviados com sucesso',
                    icon: 'success'
                })
            </script>
        <?php
            // Query
            $sql = "INSERT INTO cadastro (idade, email, peso) VALUES ('$idade', '$email', '$peso')";
            // Inserção no banco
            $mysqli -> query($sql);
        }     
    }
?>
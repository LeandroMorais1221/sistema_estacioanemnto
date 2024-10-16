<?php
include_once("./db/conexao.php");

if (isset($_GET["btnEfetuarEntrada"])) {
    $placa = $_GET["inputPlaca"];
    $dataEntrada = $_GET["inputDataEntrada"];
    $cor = $_GET["selectCor"];
    $tipo = $_GET["selectTipo"];
    $vaga = $_GET["selectVaga"];

    if ($placa && $dataEntrada && $cor && $tipo && $vaga) {
        $sql = "INSERT INTO entradas_veiculos(placa,data_entrada, cor, tipo, vaga) VALUES('$placa','$dataEntrada','$cor','$tipo','$vaga')";
        $sqlAtualizarVaga = "UPDATE vagas SET ocupada = '1' WHERE id_vaga = '$vaga'";
        if($conexao->query($sql) && $conexao->query($sqlAtualizarVaga)){
            

        }
        else{

        }
    } else {
    }
}

?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Estacionamento - Entrada</title>
    <link rel="stylesheet" href="./css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <header class="container p-3 border">
        <form class="d-flex gap-4 justify-content-center text-white">
            <div class="mb-3">
                <label for="inputPlaca" class="form-label">Placa</label>
                <input type="text" class="form-control" placeholder="Insira a placa do veículo" id="inputPlaca" name="inputPlaca" maxlength="8">
            </div>
            <div class="mb-3">
                <label for="inputDataEntrada" class="form-label">Data Entrada</label>
                <input type="datetime-local" class="form-control" id="inputDataEntrada" name="inputDataEntrada" value="<?= date('Y-m-d H:i') ?>" required>
            </div>
            <div class="mb-3">
                <label for="selectCor" class="form-label">Cor</label>
                <select class="form-select" id="selectCor" name="selectCor" required>
                    <option value="" selected>Selecione</option>
                    <?php
                    $sqlCores = "SELECT * FROM cores_veiculos";
                    $resultCores = $conexao->query($sqlCores);
                    while ($data = mysqli_fetch_object($resultCores)) { ?>
                        <option value=" <?= $data->id_cor ?>"> <?= $data->nome ?></option>

                    <?php  } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="selectTipo" class="form-label">Tipo</label>
                <select class="form-select" id="selectTipo" name="selectTipo" required>
                    <option value="" selected>Selecione</option>
                    <?php

                    $sqlTipos = "SELECT * FROM tipos_veiculos";
                    $resultTipos = $conexao->query($sqlTipos);
                    while ($data = mysqli_fetch_object($resultTipos)) { ?>
                    <option value="<?= $data->id_veiculo ?>"><?= $data->nome ?></option>
                <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="selectVaga" class="form-label">Vaga</label>
                <select class="form-select" id="selectVaga" name="selectVaga" required>
                    <option value="" selected>Selecione</option>
                    <?php
                    $sqlVagas = "SELECT id_vaga,numero FROM vagas WHERE ocupada = 0";
                    $resultVagas = $conexao->query($sqlVagas);
                    while ($data = mysqli_fetch_object($resultVagas)) { ?>
                        <option value="<?= $data->id_vaga ?>"><?= $data->numero ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-success" id="btnEfetuarEntrada" name="btnEfetuarEntrada">Efetuar Entrada</button>
            </div>
        </form>
    </header>

    <main>
        <div class="container d-flex align-items-center justify-content-between mt-4 bg-white py-2 border rounded-3">
            <nav class="navbar">
                <div class="container">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Buscar Veículo" aria-label="Search">
                        <button class="btn btn-warning text-white" type="submit">Pesquisar</button>
                    </form>
                </div>
            </nav>

            <nav aria-label="Page navigation example">
                <ul class="pagination my-0 mx-2">
                    <?php
                    $sqlTotalVagas = "SELECT numero FROM vagas WHERE ocupada = 0";
                    $resultTotalVagas = $conexao->query($sqlTotalVagas)
                    ?>
                    <li class="page-item"><a class="page-link bg-primary text-white" href="#">Vagas Disponiveis</a></li>
                    <li class="page-item"><a class="page-link" href="#"><?= mysqli_num_rows($resultTotalVagas) ?></a></li>
                </ul>
            </nav>
        </div>

        <div class="container mt-5 bg-white py-3 border rounded-3" id="vagas-container">
            <div class="text-center info-vagas">
                <img src="./img/vaga-disponivel.png" alt="">
                <p>Placa: </p>
                <p>Vaga: </p>
            </div>
            <div class="text-center info-vagas">
                <img src="./img/vaga-ocupada.png" alt="">
                <p>Placa: </p>
                <p>Vaga: </p>
            </div>
        </div>
    </main>


    <footer>
        <div id="relogio-container">
            <p>00:00:00</p>
        </div>
    </footer>


    <?php
    if (isset($_GET["msg"]) && $_GET["msg"] == 1) { ?>
        <div class="msg-container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Registro Efetuado Com <strong>Sucesso</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php } ?>


    <script src="./js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"

        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
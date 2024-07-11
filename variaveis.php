<?php

$alunos = [];
$notas = [];

function cadastrarAlunos(&$alunos) {
    for ($i = 0; $i < 5; $i++) {
        echo "Digite o nome do aluno " . ($i + 1) . ": ";
        $nome = trim(fgets(STDIN));
        $alunos[] = $nome;
    }
}

function atribuirNotas(&$alunos, &$notas) {
    foreach ($alunos as $index => $aluno) {
        echo "Atribuindo notas para $aluno\n";
        for ($j = 0; $j < 4; $j++) {
            do {
                echo "Digite a nota " . ($j + 1) . " (0 a 10): ";
                $nota = (float) trim(fgets(STDIN));
            } while ($nota < 0 || $nota > 10);
            $notas[$index][] = $nota;
        }
    }
}

function calcularResultado($notas) {
    $resultados = [];
    foreach ($notas as $index => $notasAluno) {
        $total = array_sum($notasAluno);
        $media = $total / count($notasAluno);
        if ($media < 4) {
            $status = "Aluno(a) Reprovado";
        } elseif ($media >= 4 && $media < 6) {
            $status = "Aluno(a) Recuperação";
        } else {
            $status = "Aluno(a) Aprovado";
        }
        $resultados[] = [
            'total' => $total,
            'media' => $media,
            'status' => $status
        ];
    }
    return $resultados;
}

function exibirResultadoGeral($alunos, $resultados) {
    foreach ($alunos as $index => $aluno) {
        echo "\nAluno: $aluno\n";
        echo "Nota Total: " . $resultados[$index]['total'] . "\n";
        echo "Média: " . $resultados[$index]['media'] . "\n";
        echo "Status: " . $resultados[$index]['status'] . "\n";
    }
}

function editarResultados(&$notas) {
    echo "Digite o número do aluno que você deseja editar (1 a 5): ";
    $index = (int) trim(fgets(STDIN)) - 1;
    if (isset($notas[$index])) {
        echo "Editando notas do aluno " . ($index + 1) . "\n";
        for ($j = 0; $j < 4; $j++) {
            do {
                echo "Digite a nova nota " . ($j + 1) . " (0 a 10): ";
                $nota = (float) trim(fgets(STDIN));
            } while ($nota < 0 || $nota > 10);
            $notas[$index][$j] = $nota;
        }
    } else {
        echo "Aluno inválido.\n";
    }
}

function menuPrincipal() {
    global $alunos, $notas;

    do {
        echo "\nMenu:\n";
        echo "1. Cadastrar os Alunos\n";
        echo "2. Atribuir as Notas\n";
        echo "3. Exibir Todos os Resultados\n";
        echo "4. Editar Resultados\n";
        echo "5. Sair\n";
        echo "Escolha uma opção: ";
        $opcao = trim(fgets(STDIN));

        switch ($opcao) {
            case 1:
                cadastrarAlunos($alunos);
                break;
            case 2:
                atribuirNotas($alunos, $notas);
                break;
            case 3:
                $resultados = calcularResultado($notas);
                exibirResultadoGeral($alunos, $resultados);
                break;
            case 4:
                editarResultados($notas);
                break;
            case 5:
                echo "Saindo...\n";
                break;
            default:
                echo "Opção inválida. Tente novamente.\n";
                break;
        }
    } while ($opcao != 5);
}


menuPrincipal();

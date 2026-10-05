<?php

$consultas = [
    ["Leonardo", "Cardiologia", "12/08/2026", "09:00"],
    ["Miguel", "Pediatria", "10/08/2026", "08:30"],
    ["Theo", "Cardiologia", "10/08/2026", "10:00"],
    ["Tiago", "Dermatologia", "10/08/2026", "11:00"],
    ["Mateus", "Pediatria", "10/08/2026", "09:30"]
];

function totalConsultas($consultas){
    return count($consultas);
}

function pacientesDiferentes($consultas){

    $pacientes = [];

    foreach($consultas as $consulta){

        if(!in_array($consulta[0], $pacientes)){
            $pacientes[] = $consulta[0];
        }

    }

    return count($pacientes);
}

function contarEspecialidades($consultas){

    $especialidades = [];

    foreach($consultas as $consulta){

        $especialidade = $consulta[1];

        if(isset($especialidades[$especialidade])){
            $especialidades[$especialidade]++;
        }else{
            $especialidades[$especialidade] = 1;
        }

    }

    return $especialidades;
}

function ordenarHorarios($consultas){

    for($i = 0; $i < count($consultas)-1; $i++){

        for($j = $i+1; $j < count($consultas); $j++){

            if($consultas[$i][3] > $consultas[$j][3]){

                $temp = $consultas[$i];
                $consultas[$i] = $consultas[$j];
                $consultas[$j] = $temp;

            }

        }

    }

    return $consultas;
}

function primeiroAtendimento($consultas){

    $ordenadas = ordenarHorarios($consultas);

    return $ordenadas[0];

}

function ultimoAtendimento($consultas){

    $ordenadas = ordenarHorarios($consultas);

    return $ordenadas[count($ordenadas)-1];

}

function pesquisarPaciente($consultas, $nome){

    $resultado = [];

    foreach($consultas as $consulta){

        if($consulta[0] == $nome){
            $resultado[] = $consulta;
        }

    }

    return $resultado;
}

function horariosDuplicados($consultas){

    $duplicados = [];

    for($i = 0; $i < count($consultas)-1; $i++){

        for($j = $i+1; $j < count($consultas); $j++){

            if($consultas[$i][3] == $consultas[$j][3]){
                $duplicados[] = $consultas[$i][3];
            }

        }

    }

    return $duplicados;
}

function organizarAgenda($consultas){

    $resultado = [];

    $resultado["Total de consultas"] = totalConsultas($consultas);
    $resultado["Pacientes diferentes"] = pacientesDiferentes($consultas);
    $resultado["Consultas por especialidade"] = contarEspecialidades($consultas);
    $resultado["Primeiro atendimento"] = primeiroAtendimento($consultas);
    $resultado["ultimo atendimento"] = ultimoAtendimento($consultas);
    $resultado["Lista ordenada"] = ordenarHorarios($consultas);
    $resultado["Pesquisa do paciente"] = pesquisarPaciente($consultas, "Juana");
    $resultado["Horarios duplicados"] = horariosDuplicados($consultas);

    return $resultado;
}

$resultado = organizarAgenda($consultas);

echo "<b>Total de consultas:</b> " . $resultado["Total de consultas"] . "<br>";

echo "<b>Pacientes diferentes:</b> " . $resultado["Pacientes diferentes"] . "<br><br>";

echo "<b>Consultas por especialidade:</b><br>";

foreach($resultado["Consultas por especialidade"] as $especialidade => $quantidade){
    echo "- $especialidade: $quantidade consulta(s)<br>";
}

echo "<br>";

echo "<b>Primeiro atendimento:</b> " . $resultado["Primeiro atendimento"][0] . "<br>";

echo "<b>ultimo atendimento:</b> " . $resultado["ultimo atendimento"][0] . "<br><br>";

echo "<b>Lista ordenada:</b><br>";

foreach($resultado["Lista ordenada"] as $consulta){

    echo $consulta[3] . " - ";
    echo $consulta[0] . " - ";
    echo $consulta[1] . "<br>";

}

echo "<br>";

echo "<b>Pesquisa do paciente:</b><br>";

if(count($resultado["Pesquisa do paciente"]) > 0){

    foreach($resultado["Pesquisa do paciente"] as $consulta){

        echo $consulta[0] . " - ";
        echo $consulta[1] . " - ";
        echo $consulta[2] . " - ";
        echo $consulta[3] . "<br>";

    }

}else{

    echo "Paciente nao encontrado.<br>";

}

echo "<br>";

echo "<b>Horarios duplicados:</b><br>";

if(count($resultado["Horarios duplicados"]) > 0){

    foreach($resultado["Horarios duplicados"] as $horario){
        echo $horario . "<br>";
    }

}else{

    echo "Nao existem horarios duplicados.";

}

?>
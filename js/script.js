Horario();

function Horario(){

    let textoHorario = document.querySelector('#relogio-container p');

    const colocarZero = (numero)=>{
        return ('0' + numero).slice(-2);
    }

    const interval = setInterval(()=>{
        const hora = new Date();
        const horaAtual = hora.getHours(), minutos = hora.getMinutes(), segundos = hora.getSeconds();

    
        let horarioFormatado = `${colocarZero(horaAtual)}:${colocarZero(minutos)}:${colocarZero(segundos)}`;
        
        textoHorario.innerHTML = horarioFormatado;
    }, 1000);

};
function toggleAnswer(answerId) {
          var answer = document.getElementById(answerId);
          if (answer.style.display === "block") {
            answer.style.display = "none";
          } else {
            answer.style.display = "block";
          }
}
  
function mostrarFormulario() {
    var formulario = document.getElementById('formulario');
    formulario.classList.toggle('hidden');
}

function enviarFormulario() {
    var textoIncomodo = document.getElementById('campoTexto').value;
    alert('Texto enviado: ' + textoIncomodo);
}
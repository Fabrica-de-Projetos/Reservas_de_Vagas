const form = document.getElementById("formulario-login")
const botao_submit = document.getElementById("botao-submit")
// const nomeCompleto = document.getElementById("input-nome-completo")
const email = document.getElementById("input-email")
const senha = document.getElementById("input-senha")
// const modeloVeiculo = document.getElementById("input-modelo-veiculo")
// const placaVeiculo = document.getElementById("input-placa")


function validarEmail(email){
    const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (regexEmail.test(email)){
        return true
    }
    else
    {
        return false
    }
}

function validarSenha(senha)
{

    if (senha == null || senha == "" )
    {
        return false
    }
    else
    {
        return true
    }

}

function CriarUsuario(json) {
    fetch("http://127.0.0.1:8000/api/spotLivre/login", {  //"https://backend-oh40.onrender.com/api/spotLivre/usuarios"
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: json
    })
        .then(response => {
            if (!response.ok) throw new Error("Erro na requisição")
            return response.json()
        })
        .then(data => {
            console.log(data)
            localStorage.setItem("token",data.token)

            window.location.href = "http://127.0.0.1:5500/frontend/home.html"
        })
        .catch(error => {
            console.error(error)
        })
}

botao_submit.addEventListener("click", (e) =>{
    e.preventDefault()

    const mensagemErro = document.getElementById("mensagem-erro")
    let validacaoEmail = null
    let validacaoSenha = null

    validacaoSenha = validarSenha(senha.value)
    validacaoEmail = validarEmail(email.value)

    if (validacaoEmail == true && validacaoSenha == true)
    {
        mensagemErro.classList.remove("mensagem-erro-ativo")

        let requisicao = {
            email: email.value,
            senha: senha.value,
        }

        let json = JSON.stringify(requisicao)
        CriarUsuario(json)
    }
    else
    {
        mensagemErro.classList.add("mensagem-erro-ativo")
    }
})
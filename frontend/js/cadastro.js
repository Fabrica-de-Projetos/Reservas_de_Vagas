const form = document.getElementById("formulario-cadastro")
const botao_submit = document.getElementById("botao-submit")
const nomeCompleto = document.getElementById("input-nome-completo")
const email = document.getElementById("input-email")
const senha = document.getElementById("input-senha")
const modeloVeiculo = document.getElementById("input-modelo-veiculo")
const placaVeiculo = document.getElementById("input-placa")

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

function validarSenha(senha,confirmarSenha)
{
    if (senha != confirmarSenha )
    {
        return false
    }
    else
    {
        return true
    }
}

function montarJson()
{
    let requisicao = {
        nome_usuario: nomeCompleto.value,
        email: email.value,
        senha: senha.value
    }
    return JSON.stringify(requisicao)
}

function consumirAPI(json)
{
    fetch("https://backend-oh40.onrender.com/api/spotLivre/usuarios", {
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
    })
    .catch(error => {
        console.error(error)
    })
}

botao_submit.addEventListener("click", (e) =>{
    e.preventDefault()
    const mensagemErroEmail = document.getElementById("mensagem-erro-email")
    const mensagemErroSenha = document.getElementById("mensagem-erro-senha")
    let inputs = form.getElementsByTagName("input")
    let arrayInputs = Array.from(inputs)
    let validacaoEmail = null
    let validacaoSenha = null
    let senhaLocal = null
    let confirmarSenha = null

    for(let i =0; i<inputs.length; i++)
    {
        if (arrayInputs[i].id == "input-email")
             validacaoEmail = validarEmail(arrayInputs[i].value)
            if (validacaoEmail == false)
            {
                let inputEmail = arrayInputs[i]
                let inputBox = inputEmail.closest(".input-box")
                inputBox.classList.add("input-box-error")
                mensagemErroEmail.classList.add("mensagem-erro-ativo")
                break
            }
            else
            {
                let inputEmail = arrayInputs[i]
                let inputBox = inputEmail.closest(".input-box")
                inputBox.classList.remove("input-box-error")
                mensagemErroEmail.classList.remove("mensagem-erro-ativo")
            }
        
        if (arrayInputs[i].id == "input-senha")
        {
            senhaLocal = arrayInputs[i]
        }
        else if (arrayInputs[i].id == "input-confirmar-senha")
        {
            confirmarSenha = arrayInputs[i]

            validacaoSenha = validarSenha(senhaLocal.value, confirmarSenha.value)

            if (validacaoSenha === false)
            {
                let inputBoxSenha = senhaLocal.closest(".input-box")
                let inputBoxConfirmar = confirmarSenha.closest(".input-box")
                inputBoxSenha.classList.add("input-box-error")
                inputBoxConfirmar.classList.add("input-box-error")
                mensagemErroSenha.classList.add("mensagem-erro-ativo")
                break
            }
            else
            {
                let inputBoxSenha = senhaLocal.closest(".input-box")
                let inputBoxConfirmar = confirmarSenha.closest(".input-box")
                inputBoxSenha.classList.remove("input-box-error")
                inputBoxConfirmar.classList.remove("input-box-error")
                mensagemErroSenha.classList.remove("mensagem-erro-ativo")
            }
        }

        if (i+1 == inputs.length)
        {
            let json = montarJson()
            console.log(json)
            consumirAPI(json)
        }
    }
})
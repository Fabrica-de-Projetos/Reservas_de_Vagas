export function verificarToken()
{
    if (localStorage.getItem("token") == null) {
        alert("Acesso não autorizado")
        window.location.href = "http://127.0.0.1:5500/frontend/cadastro.html" // ALTERAR CAMINHO
    }
    else
    {
        window.location.href = "http://127.0.0.1:5500/frontend/home.html" // ALTERAR CAMINHO
    }
}
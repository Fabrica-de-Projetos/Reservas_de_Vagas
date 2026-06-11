import { useRouter } from 'vue-router';

export function verificarToken()
{
  const router = useRouter()

    if (localStorage.getItem("TokenAuth") == null) {
        alert("Acesso não autorizado")
        router.push("/cadastro")
    }
    else
    {
        router.push("/vagas")
    }
}

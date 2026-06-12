import { navegar } from './navegar';

export function verificarToken()
{

    if (localStorage.getItem("TokenAuth") == null) {
        alert("Acesso não autorizado")
        navegar("/cadastro")
    }
}

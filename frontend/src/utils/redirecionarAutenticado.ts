import router from "@/router";

export function redirecionarAutenticado()
{
  if(localStorage.getItem("TokenAuth") != null)
  {
    router.push("/home")
  }
}

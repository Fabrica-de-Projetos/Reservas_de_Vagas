import { useRouter } from 'vue-router';

export function navegar(url : string)
{
  const router = useRouter()
  router.push(url)
}

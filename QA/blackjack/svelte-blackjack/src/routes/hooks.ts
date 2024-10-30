import type { Handle } from '@sveltejs/kit';
import { redirect } from '@sveltejs/kit';

export const handle = (async ({ event, resolve }) => {

    const token: string | null = localStorage.getItem('token');
    
    if (token !== null) {
        if (event.url.pathname.startsWith('/user')) {
            return await resolve(event);
        }

        return redirect(302, '/user');
    }

    if (event.url.pathname.startsWith('/user')) {
        return redirect(302, '/');
    }

    return await resolve(event); 
}) satisfies Handle;
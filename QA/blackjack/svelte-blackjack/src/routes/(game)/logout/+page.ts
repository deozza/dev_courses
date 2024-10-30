import { redirect } from '@sveltejs/kit';

export async function load({}){
    localStorage.removeItem('token');

    redirect(302, '/');
}
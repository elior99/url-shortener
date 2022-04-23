import Create from './components/Create.vue';
import Stats from './components/Stats.vue';




import { globalStore } from "./main.js"


function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return null;
}


export const routes = [
    {
        path: '/create', name: 'create', component: Create
    },
    {
        path: '/log/:id', name: 'stats', component: Stats
    },
   
    { path: '/redirect-me', redirect: { name: 'home' } },
   { path: '*', redirect: '/' },
];
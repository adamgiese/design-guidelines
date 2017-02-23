
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Setup router
 */

var home = Vue.component('Home', require('./pages/home.vue'));
var dashboard = Vue.component('Dashboard', require('./pages/dashboard.vue'));
var teams = Vue.component('Teams', require('./pages/teams.vue'));
var teamProjects = Vue.component('TeamProjects', require('./pages/team-projects.vue'));
var projects = Vue.component('Projects', require('./pages/projects.vue'));
var project = Vue.component('Project', require('./pages/project.vue'));
var branding = Vue.component('Branding', require('./pages/branding.vue'));
var typography = Vue.component('Typography', require('./pages/typography.vue'));
var fonts = Vue.component('Fonts', require('./pages/fonts.vue'));
var colors = Vue.component('Colors', require('./pages/colors.vue'));
var logos = Vue.component('Logos', require('./pages/logos.vue'));

var router = new VueRouter({
    routes: [
        { path: '/', name: 'home', component: home },
        { path: '/dashboard', name: 'dashboard', component: dashboard },
        { path: '/teams', name: 'teams', component: teams },
        { path: '/team/:id/', name: 'teamProjects', component: teamProjects },
        { path: '/projects', name: 'projects', component: projects },
        { path: '/project/:id', name: 'project', component: project },
        { path: '/project/:id/typography', name: 'typography', component: typography },
        { path: '/project/:id/fonts', name: 'fonts', component: fonts },
        { path: '/project/:id/colors', name: 'colors', component: colors },
        { path: '/project/:id/logos', name: 'logos', component: logos },
    ]
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('app-nav', require('./components/app-nav.vue'));

const app = new Vue({
    router: router,
    el: '#app'
});

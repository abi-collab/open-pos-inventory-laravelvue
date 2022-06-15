export default [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/invoice', component: require('./components/invoice.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/developer', component: require('./components/Developer.vue').default },
    { path: '/customers', component: require('./components/Customers.vue').default },
    { path: '/users', component: require('./components/Users.vue').default },
    { path: '/products', component: require('./components/product/Products.vue').default },
    { path: '/product/tag', component: require('./components/product/Tag.vue').default },
    { path: '/product/category', component: require('./components/product/Category.vue').default },
    { path: '/serialnos', component: require('./components/product/Serialnos.vue').default },
    { path: '/returns', component: require('./components/Returns.vue').default },
    { path: '*', component: require('./components/NotFound.vue').default },
   
];

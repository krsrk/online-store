window.Vue = require("vue");
import VueRouter from 'vue-router';




const Bar = { template: '<div>bar</div>' }


Vue.use(VueRouter);

export default new VueRouter(
    {
        routes:[
        { path: '/', component: Bar }
    ],
    mode: 'history'
});

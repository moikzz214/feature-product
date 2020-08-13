import BuilderDashboard from "../js/components/builder/BuilderDashboard";
import BuilderProducts from "../js/components/builder/BuilderProducts";
import BuilderNewProduct from "../js/components/builder/BuilderNewProduct";

export const routes = [
    {
        path: "/builder",
        component: BuilderDashboard
    },
    {
        path: "/builder/dashboard",
        component: BuilderDashboard
    },
    {
        path: "/builder/products",
        component: BuilderProducts
    },
    {
        path: "/builder/product/new",
        component: BuilderNewProduct
    }
    // {
    //     path: '/admin/post/edit/:id',
    //     name: 'EditPost',
    //     component: EditPost,
    //     props: true
    // },
];

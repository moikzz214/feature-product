import BuilderDashboard from "../js/components/builder/BuilderDashboard";
import BuilderProducts from "../js/components/builder/BuilderProducts";
// import BuilderNewProduct from "../js/components/builder/BuilderNewProduct";
import BuilderEditProduct from "../js/components/builder/BuilderEditProduct";
import UploadVideo from "../js/components/builder/UploadVideo";

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
    // {
    //     path: "/builder/product/new",
    //     component: BuilderNewProduct
    // },
    {
        path: "/builder/product/upload-video",
        component: UploadVideo
    },
    {
        path: "/builder/product/edit/:id",
        name: 'BuilderEditProduct',
        component: BuilderEditProduct,
        props: true
    }
    // {
    //     path: '/admin/post/edit/:id',
    //     name: 'EditPost',
    //     component: EditPost,
    //     props: true
    // },
];

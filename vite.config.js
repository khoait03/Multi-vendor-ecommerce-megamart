// import { defineConfig } from "vite";
// import laravel from "laravel-vite-plugin";

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: ["resources/css/app.css", "resources/js/app.js"],
//             refresh: [
//                 "resources/routes/**",
//                 "routes/**",
//                 "resources/views/**",
//                 "resources/css/**",
//                 "resources/js/**",
//             ],
//         }),
//     ],
// });

import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/admin.js",
                "resources/js/frontend.js",
                // "public/backend/assets/css/skins/style.css",
            ],
            refresh: [
                "resources/css/**",
                "resources/js/**",
                "resources/views/**",
                "routes/**",
                "public/backend/assets/css/**", // Thêm đường dẫn thư mục chứa file CSS để theo dõi
                "public/frontend/css/**", // Thêm đường dẫn thư mục chứa file CSS để theo dõi
            ],
        }),
    ],
});

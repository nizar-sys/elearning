import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',

                'resources/css/custom_dropzone.css',
                'resources/css/detail_course.css',
                'resources/css/student/elearnings/show_elearning.css',

                'resources/js/auth/script.js',
                'resources/js/console/about/script.js',
                'resources/js/console/articles/create_script.js',
                'resources/js/console/articles/edit_script.js',
                'resources/js/console/articles/script.js',
                'resources/js/console/banners/script.js',
                'resources/js/console/benefits/benefit_validation_script.js',
                'resources/js/console/benefits/script.js',
                'resources/js/console/categories/category_validation_script.js',
                'resources/js/console/categories/script.js',
                'resources/js/console/elearnings/create_validation_script.js',
                'resources/js/console/elearnings/edit_validation_script.js',
                'resources/js/console/elearnings/script.js',
                'resources/js/console/materials/create_validation_script.js',
                'resources/js/console/materials/edit_validation_script.js',
                'resources/js/console/materials/script.js',
                'resources/js/console/permissions/script.js',
                'resources/js/console/reviews/review_validation_script.js',
                'resources/js/console/reviews/script.js',
                'resources/js/console/roles/script.js',
                'resources/js/console/users/edit_script.js',
                'resources/js/console/users/script.js',
                'resources/js/console/users/show_script.js',
                'resources/js/console/videos/create_validation_script.js',
                'resources/js/console/videos/edit_validation_script.js',
                'resources/js/console/videos/script.js',
                'resources/js/profile/script.js',
                'resources/js/search/script.js',
                'resources/js/student/elearnings/show_elearning.js',
                'resources/js/app-logistics-dashboard.js',
                'resources/js/custom_dropzone.js',
                'resources/js/dashboard.js',
                'resources/js/main.js',
            ],
            refresh: true,
        }),
    ],
});

# MultiAuthentication-Fake-User-Datatable-Ajax

Special packages
1. composer require yajra/laravel-datatables

Run Commands 
1. composer install
2. Run seeder command: db:seeder --class:UserSeeder
3. php artisan serve - http://127.0.0.1:8000/
4. Register a user - For making an Admin
5. Change user role to "admin" users table in MySql db 
6. Login as Admin (or User from same) Login UI
7. Than only you can access: http://127.0.0.1:8000/admin/users [ User List - Fake user generated from UserSeeder except user role with "admin"]

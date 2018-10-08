# start server
php artisan serve

# user admin
 -email: root@gmail.com
 -pass: 1234

# laravel
  ใช้ภาษา php famework laravel มาพัฒนา(dev) mvc
  - doc https://laravel.com/

#code
 - VMC
   - controller คือ โค้ดที่เราเขียนทั้งหมด
   - models คือ ข้อมูลที่ดึงจาก DB
   - view คือ โค้ดที่เราใส html js css

 - staion  
    - controller app\Http\Controllers\StationController.php
    - models app\Models\Station.php
    - view resources\views\station

  - patient  
     - controller app\Http\Controllers\PatientController.php
     - models app\Models\Patient.php
     - view resources\views\patient

 - user  
    - controller app\Http\Controllers\UserController.php
    - models app\User.php
    - view resources\views\user

  - visit
     - controller app\Http\Controllers\VisitController.php
     - models app\Models\User.php
     - view resources\views\user

  - login
    - controller app\Http\Controllers\Auth
    - view resources\views\auth

# route laravel
    - file routes\web.php

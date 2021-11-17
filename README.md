## About installation of the project.

Step1: Downlaod the project and extract from zip
step2: Now open the env file and change the database and smtp configuration accordingly.
Step3: Open terminal and go to the project directory and hit the following command
-> Composer install -vvv
-> php artisan migrate
-> php artisan db:seed



So It will create a some user with following details
#user1
email: saurabh.naruka+sa@neosoftmail.com
password: pass@admin
Role: Super Admin

#user2
email: saurabh.naruka+user@neosoftmail.com
password: pass@user
Role: User Admin

#user3
email: saurabh.naruka+sales@neosoftmail.com
password: pass@sales
Role: Sales Manager


Note: for now only super admin can intimate and view the claim
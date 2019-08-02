# php_password_recovery_email
All in one PHP (core) based solution to change password of your website user accounts using OTP on their registered email. Just name the MySQL table and column name where password and email are stored.

This is a small project that will help you to have password reset procedure for your website account holders be taken care of.

Requirements : PHP and it works on MySQL Database

What you need to do is .....

1. Edit the credentials file 
   php_password_recover_email\password_recovery_email_credentials\password_reset_credentials.xml
   and provide the details as mentioned in comments.

2. copy and paste the entire 'src' folder to the directory where you want to have the password reset functionality on you.

3. Edit and provide the path to the credentials XML file in files 
   a. src \ validatecode.php
   b. src \ validateinput.php
   c. src \ getEmail.php
   
   comments are mentioned where this is supposed to be done.
   
 4. You can use your custom SMTP(like gmail,outlook, etc.) or The SMTP of you web hosting provider to send reset codes over email.

NOTE that : When being operated, The functionality unsets and destroys all the active $_SESSIONs 

For a full tutorial on on to leverage the watch our youtube video :

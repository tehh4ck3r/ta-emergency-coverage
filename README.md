# Installation Instructions  
1. Acquire a user account for the Linux machines at the SCU Engineering Design Center. Detailed instructions for acquiring the account may be found on the SCU Engineering Design Center's help pages: <http://wiki.helpme.engr.scu.edu/index.php/Accounts>.

2. Acquire a user account for the MySQL 5 server at the SCU Engineering Design Center. Detailed instructions for setting up a MySQL 5 account may be found under the "Preparation" section on the following SCU Engineering Design Center help page: <http://wiki.helpme.engr.scu.edu/index.php/MySQL-5#Preparation>.

3. Extract the archive containing the system's code. 

4. Open the file `dbconn.php`.

5. On line 10, replace `YOUR_USERNAME` with the MySQL server username you acquired from step 2.

6. On line 11, replace `YOUR_PASSWORD` with the MySQL server password you acquired from step 2.

7. On line 12, replace `YOUR_DATABASE_NAME` with the MySQL database name you acquired from step 2.

8. Open the file `.htaccess`.

9. On line 2, replace `YOUR_USERNAME` with the username to your account for the SCU Engineering Design Center. 

10. Copy the files from the extracted archive into your webpage's root directory, i.e. `/webpages/YOUR_USERNAME/` (where `YOUR_USERNAME` is the username you used in step 9).

11. Open a terminal and navigate to your webpage's root directory with the command `cd /webpages/YOUR_USERNAME/` (where `YOUR_USERNAME` is the username you used in step 9).

12. Run the following commands, in order: 
- `chmod 711 /cgi-bin/php.cgi`
- `chmod 644 .htaccess`
- `chmod 700 *.php`
- `chmod -R 755 css/`
- `chmod 755 cgi-bin/`
- `chmod -R 755 img`
- `chmod 755 *.js`
13. Run the command `setup mysql5`.

14. Run the command `mysql -h dbserver.engr.scu.edu -p -u YOUR_USERNAME YOUR_DATABASE_NAME` (where `YOUR_USERNAME` and `YOUR_DATABASE_NAME` are the MySQL server username and MySQL database name you acquired in step 2).

15. Login to the MySQL server by providing your password at the prompt. 

16. At the MySQL prompt, run the command `\. table_init.sql`. 

17. Exit the MySQL prompt by running the command `exit`. 

18. The system may now be used by navigating to <http://students.engr.scu.edu/~YOUR_USERNAME/index.php> (where `YOUR_USERNAME` is the username you used in step 9).
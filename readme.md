#PROJECT TITLE
Leave management system (Web-based): A leave management system for teaching and non-teaching staffs of IIIT Senapati, Manipur.

#GETTING STARTED
-Download the .tar file and extract it into "/var/www/html/" directory ( Ubuntu )
-Create the database "leave".
-Now go to the folder /leave_management_system/pgsql_file/
-Restore the dump file in the database with extension .pgsql available in forder named as pgsql_file
using "psql -U dbuser leave < leave.pgsql"
-While using the .php files make sure your internet connection is on because we have used some googleAPIs for GUI.

#PREREQUISITES
-Localhost Server- Apache2
-PgSQL
-PHP

#PROCEDURE
-In any browser(Firefox, Chrome... etc) type in address-bar.
    -To Admin login page : localhost/leave_management_system/admin/
        loginid='admin'
        password='Test@12345'
    -To Staff login page : localhost/leave_management_system/index.php
        1- loginId: kumarhritik38@gmail.com
            password: Test23@#
        2- loginId: r.raj@iiitmanipur.ac.in
            password: Test67^&
        3- loginId: rohit.kesarwani9898@gmail.com
            password: Test45$%
        4- loginId: shrishkumar@gmail.com
            password: shrish12
        5- loginId: naman@gmail.com
            password: naman@#


 # Display all site URLS without .php file extension

RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME}\.php -f
RewriteRule ^(.*)$ $1.php
RewriteCond %{REQUEST_FILENAME}\.xml -f
RewriteRule ^(.*)$ $1.xml

 # Display all site URLS without "www."

RewriteBase /
RewriteCond %{HTTP_HOST} !^mentalmathstest\.com$ [NC]
RewriteRule ^(.*)$ http://mentalmathstest.com/$1 [R=301,L]

RewriteCond %{HTTPS} !=on
RewriteRule ^.*$ http://%{SERVER_NAME}%{REQUEST_URI} [R=301,L]

RewriteCond %{HTTP_HOST} ^108\.167\.172\.144
RewriteRule (.*) http://mentalmathstest.com/$1 [R=301,L]

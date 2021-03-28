# Instructions

Clone this repo and place it under htdocs in MAMP or XAMPP.

## MySQL

In order for the application to run, the database must first be set up.
Copy and paste the code from createdb.sql into phpMyAdmin!

### Skip this if you are using XAMPP

If you are using MAMP, you also need to change the mysqli login credentials in helpers/db.php.
Change the password to be root and stash your changes in git.

## TLS

Note: It is not necessary to set up TLS in order to run and test the application.

Configuration files for TLS (tested on Mac using MAMP) are included in conf/tls.
It was set up based on the following guide:
https://really-simple-ssl.com/knowledge-base/how-to-install-an-ssl-certificate-on-mamp/?fbclid=IwAR3OW3OJAo6qv4fokowSWVWoFm3DYAIzBFzU9MzTr3-A-UN6O0M_2fK5X-I

#### Changes to httpd.conf

```
ServerName localhost:443

# Secure (SSL/TLS) connections
Include /Applications/MAMP/conf/apache/extra/httpd-ssl.conf

```

#### Changes httpd-ssl.conf

```
<VirtualHost *:443>

#   General setup for the virtual host
DocumentRoot "/Applications/MAMP/htdocs"
ServerName localhost:443
```

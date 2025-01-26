#!/bin/bash
clear
if [ "$EUID" -ne 0 ]; then
    echo "El script debe ser ejecutado como root"
    exit 1
fi
echo "Comprobando conectividad"
ping -c 2 208.67.220.220 > /dev/null 2> /dev/null
if [ $? -ne 0 ]; then
    echo "No hay conectividad. Comprueba la configuración e inténtalo de nuevo."
    exit 1
else
    echo "Hay conexión con Internet."
fi
echo "Actualizando índice de repositorios"
apt update > /dev/null 2> /dev/null
echo " ----- "
echo "Actualizando sistema"
apt upgrade -y > /dev/null 2> /dev/null
echo " ----- "
echo "Instalando Apache, PHP y MySQL"
apt install apache2 php-common libapache2-mod-php mysql-server mysql-client php-mysql -y > /dev/null 2> /dev/null
echo " ----- "
echo "Reiniciando apache y MySQL"
systemctl restart apache2 mysql-server > /dev/null 2> /dev/null
systemctl status apache2
systemctl status mysql-server
sleep 5
clear
echo "Versión de apache instalada: "
apachectl -V
echo " ----- "
echo "Versión de MySQL instalada: "
mysql -V
sed -i 's/display_errors = Off/display_errors = On/' /etc/php/*/apache2/php.ini
sleep 5
clear
echo "Se va a ejecutar la terminal de MySQL."
echo "Introduce el siguiente comando:"
echo "ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'contraseña';"
mysql -u root
mysql_secure_installation
echo "Instalación terminada."
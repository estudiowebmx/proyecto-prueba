# 📚 ProyectoPrueba - Sistema de Gestión de Usuarios

Este proyecto fue desarrollado como parte de una prueba técnica. Es una aplicación basada en **Laravel 11** que permite la gestión de usuarios con funcionalidades como login, recuperación de contraseña por código, carga de imagen de perfil.

---

## 🚀 Requisitos Previos

Antes de ejecutar el proyecto, asegúrate de tener instalado:

-   PHP 8.2
-   Composer
-   MySQL
-   Laravel CLI

---

## 📦 Instalación

1. **Clonar el repositorio**

    ```bash
    git clone https://github.com/estudiowebmx/proyecto-prueba.git
    cd proyectoprueba
    ```

2. **Instalar dependencias PHP**

    ```bash
    composer install
    ```

3. **Copiar archivo .env y generar la clave de aplicación**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Configurar base de datos**

    Edita el archivo `.env` y agrega tus credenciales de base de datos:

    ```env
    DB_DATABASE=nombre_de_tu_base_de_datos
    DB_USERNAME=tu_usuario
    DB_PASSWORD=tu_contraseña
    ```

5. **Ejecutar migraciones y seeders**

    ```bash
    php artisan migrate --seed
    ```

    Esto creará las tablas necesarias y generará:

    - 50 usuarios ficticios con datos generados aleatoriamente.
    - 1 usuario principal para pruebas:

    ```text
    Usuario: admin
    Contraseña: admin
    Correo: admin@example.com (para fines de recuperación)
    ```

---

## 🔐 Funcionalidades

-   Login con verificación de credenciales.
-   Recuperación de contraseña mediante código enviado por email (modo simulado).
-   Gestión de usuarios con imágenes de perfil.
-   Middleware de autenticación.
-   Validaciones en servidor y mensajes de error amigables.
-   Seeding con datos falsos usando `Faker`.

---

## 🖼️ Capturas

![Login de Acceso con Recuperación de contraseña](public/pantallazos/login.png)
![Recuperación de contraseña Correo elecetrónico](public/pantallazos/recu1.png)
![Recuperación de contraseña Código de Recuperación](public/pantallazos/recu2.png)
![Recuperación de contraseña Restablecimiento de Contraseña](public/pantallazos/recu3.png)
![Catalogo de usuarios](public/pantallazos/catalogo.png)
![Funcionalidad de asignación de imagen de perfil](public/pantallazos/avatar.png)

---

## 🛠️ Autor y Licencia

Funcionalidades de prueba desarrolladas por Raymundo Torres  
Este proyecto fue creado como parte de una prueba técnica y es de uso libre para fines demostrativos.

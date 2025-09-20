# Plataforma de Cursos - Prueba Técnica

Esta es una aplicación Laravel que simula una plataforma de cursos en línea, desarrollada como parte de una prueba técnica. Permite gestionar cursos, lecciones, instructores y usuarios, incluyendo funcionalidades como favoritos y reviews.

---

## Requisitos cubiertos

1. **Relaciones y modelos:**
   - `Instructor` (usuario con rol de instructor) tiene muchos `Course`.
   - `Course` pertenece a un `Instructor`.
   - `Course` tiene muchas `Lesson`.
   - `Lesson` tiene un video asociado.
   - `User` puede marcar cursos como favoritos.
   - `User` puede dejar comentarios y calificaciones (reviews).

2. **CRUD y validaciones para cursos:**
   - Los instructores pueden crear, leer, actualizar y eliminar sus cursos.
   - Cada curso puede tener múltiples lecciones, que se gestionan en el mismo formulario.
   - Validaciones aplicadas en todos los campos (`title`, `description`, `lessons`).

3. **Optimización:**
   - El listado de instructores se recupera de manera eficiente usando Eloquent (`select`, `with` y paginación si fuera necesario).
   - Servicio que calcula el **rating promedio de cada curso** implementado usando `withAvg('reviews', 'rating')`.

4. **Funcionalidades adicionales implementadas:**
   - Dashboard diferenciado para usuarios e instructores.
   - Middleware de permisos para asegurar que solo los instructores gestionen sus cursos y que los usuarios solo puedan interactuar con sus propios favoritos/reviews.
   - Usuarios pueden marcar cursos como favoritos y ver el estado en el dashboard.
   - Visualización de reviews y ratings en la página de detalle de curso.

## Instalación

1. **Clona el repositorio:**
git clone https://github.com/barbaraSantano/isid-prueba.git
cd isid-prueba

2. **Instala dependencias:**
composer install
npm install
npm run dev

3. **Configura el .env y genera la clave de aplicación:**
cp .env.example .env
php artisan key:

4. **Ejecuta migraciones y seeders de prueba:**
php artisan migrate --seed

Se crean cuatro usuarios de prueba:

    user1@test.com	Usuario (alumno)
    user2@test.com	Usuario (alumno)
    instructor1@test.com   Instructor
    instructor2@test.com   Instructor

**PWD: test12345

Los seeders también crean instructores adicionales y cursos de prueba.

5. **Inicia el servidor:**
php artisan serve

## Estructura del proyecto

- **app/Models**

    User, Instructor, Course, Lesson, Review, Favorite.

- **app/Http/Controllers**

    InstructorController → gestión de cursos y lecciones.

    UserController → gestión de favoritos y reviews.

    DashboardController → vistas de dashboards diferenciadas.

- **resources/views**

    layouts/ → plantillas base para usuarios e instructores.

    dashboard/ → dashboards

        * User:
<img width="1365" height="599" alt="dashboard-user" src="https://github.com/user-attachments/assets/033d19fc-16dc-4899-b83d-14cf4d56d26b" />

        * Instructor:
<img width="1365" height="590" alt="dashboard-instructor" src="https://github.com/user-attachments/assets/08748db8-2dc9-4a35-a930-35eef2768893" />

    courses/user/ → vistas de cursos para usuarios

        * Show (user):
<img width="1365" height="601" alt="show-user" src="https://github.com/user-attachments/assets/16609531-f72f-4955-a163-d03f1f5efb66" />

    courses/instructor/ → vistas de cursos para instructores

        * Show (instructor):
<img width="1364" height="590" alt="show-instructor" src="https://github.com/user-attachments/assets/57b1585a-f546-4dc8-9c90-eb4ea40a6c02" />

        * Create (instructor):
<img width="1362" height="571" alt="create-instructor" src="https://github.com/user-attachments/assets/e1ed543a-e02c-4d0d-a16d-194931a1b502" />

        * Edit (instructor):
<img width="1364" height="592" alt="edit-instructor" src="https://github.com/user-attachments/assets/d7bae1cd-0d24-4e97-8cfa-fca767559ed2" />

- **routes/web.php**

    Rutas diferenciadas por roles (auth, instructor, owner.course).

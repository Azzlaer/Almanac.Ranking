# 🛡️ Valheim Player Ranking - PHP Web App

Una aplicación web ligera en PHP que muestra un **ranking interactivo** de jugadores de **Valheim**, extraído automáticamente desde un archivo YAML que se actualiza dinámicamente.

---

## 🚀 Características

- 🎯 **Lectura automática** de estadísticas desde un archivo `PlayerListData.yml`.
- 🧝‍♂️ **Tabla de ranking** con:
  - Nombre del personaje
  - Logros completados
  - Total de asesinatos
  - Total de muertes
- 🔁 **Ordenamiento dinámico** (ASC/DESC) al hacer clic en los encabezados.
- 🌗 **Diseño visual estilo Valheim**: oscuro, medieval, con detalles dorados.
- 📱 Totalmente **centrado y responsivo**.
- ✨ Emojis y elementos visuales para una experiencia más amigable y "gamificada".
- ⚡ Compatible con servidores locales como **XAMPP**.

---

## 📁 Estructura de Archivos

/valheim-ranking/
│
├── index.php # Código principal PHP que genera la tabla
├── styles.css # Estilo visual del ranking (Valheim-style)
├── PlayerListData.yml # Archivo de datos actualizado dinámicamente
└── README.md # Documentación del proyecto

yaml
Copiar
Editar

---

## 📦 Requisitos

- PHP 7.x o superior
- Servidor local (como XAMPP, WAMP o LAMP)
- Navegador moderno (Chrome, Firefox, etc.)

---

## 🧪 Cómo usar

1. Clona o descarga este repositorio en tu carpeta `htdocs` (XAMPP):

C:/xampp/htdocs/valheim-ranking/

yaml
Copiar
Editar

2. Asegúrate de tener el archivo `PlayerListData.yml` en la misma carpeta. Ejemplo de contenido:

```yaml
InDiCa:
  completed_achievements: 3
  total_kills: 10
  total_deaths: 1
Ragnar:
  completed_achievements: 5
  total_kills: 20
  total_deaths: 4
Inicia Apache desde el Panel de XAMPP.

Abre tu navegador y accede a:

arduino
Copiar
Editar
http://localhost/valheim-ranking/
🧠 Personalización
Puedes editar el archivo styles.css para adaptar los colores o fuentes.

Para agregar nuevas métricas, modifica tanto index.php como el YAML de entrada.

💡 Ideas Futuras
🔍 Buscador en tiempo real por nombre

📊 Gráficos de estadísticas

📥 Carga de archivos YAML vía formulario

💬 Webhooks de Discord para mostrar los rankings

🧙 Inspirado por
El mundo vikingo de Valheim ⚔️

"Prepárate para la batalla. Cada muerte cuenta. Cada logro importa."

📜 Licencia
Este proyecto es de uso libre para fines educativos y de hobby. No afiliado oficialmente con Iron Gate Studio ni Valheim.

yaml
Copiar
Editar

---

¿Quieres que te genere también un `favicon.ico` temático o una imagen de banner para decorar el proyecto en GitHub?
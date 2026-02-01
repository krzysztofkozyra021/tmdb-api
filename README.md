# TMDB App

Application integrating with The Movie Database (TMDB) API, fetching data about movies and TV series

## Prerequisites

- Docker
- Docker Compose

## Installation and Setup

### 1. Clone the repository

```bash
git clone <repository-url>
cd tmdb-app
```

### 2. Configure the environment

Copy the example configuration file:

```bash
cp .env.example .env
```

Open `.env` and configure your TMDB API keys:

```dotenv
TMDB_API_KEY=your_api_key
TMDB_READ_ACCESS_TOKEN=your_read_access_token
```

### 3. Install Dependencies

Install PHP and JavaScript dependencies using one of the following methods:

**Option 1:** Using Laravel Sail (recommended)

```bash
./vendor/bin/sail composer install
./vendor/bin/sail npm install
```

**Option 2:** Using local PHP and Node
```bash
composer install
npm install
```

> **Note:** Make sure all required PHP extensions are installed (curl, mbstring, json, pdo_mysql) when using local PHP.
### 4. Start the Application

Start the application containers using Sail:

```bash
./vendor/bin/sail up -d
```

### 5. Setup Application Key and Database

Generate the application key and run migrations:

```bash
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
```

---

## Fetching Data from TMDB

To populate your local database with data from TMDB (movies, series, genres), run the fetch command:

```bash
./vendor/bin/sail artisan tmdb:fetch
```

> **Note:** This command dispatches jobs to the queue. You must run the queue worker to process them.

Process the queue:

```bash
./vendor/bin/sail artisan queue:work
```

---

## API Documentation

The application exposes the following REST API endpoints.

**Global Headers:**

- `Accept-Language`: Specifies the language for the response content (titles, overviews, names).
  - Supported values: `en` (default), `pl`, `de`.

### 1. Get Movies

Retrieve a paginated list of movies.

- **Endpoint:** `GET /api/movies`
- **Parameters:**
  - `page` (optional): Page number (default: 1)
- **Example Request:**

    ```bash
    curl -H "Accept-Language: pl" "http://localhost/api/movies?page=2"
    ```

### 2. Get TV Series

Retrieve a paginated list of TV series.

- **Endpoint:** `GET /api/series`
- **Parameters:**
  - `page` (optional): Page number (default: 1)
- **Example Request:**

    ```bash
    curl -H "Accept-Language: de" "http://localhost/api/series"
    ```

### 3. Get Genres

Retrieve a list of all genres (movies and series)

- **Endpoint:** `GET /api/genres`
- **Example Request:**

    ```bash
    curl "http://localhost/api/genres"
    ```

**Response Schema for Genres**

```json
{
    "data": [
        {
            "name": "Action"
            "type": "movie",
        },
        {
            "name": "Action & Adventure"
            "type": "serie",
        }
    ]
}
```

---

## Web Interface

App include a Livewire-based web interface for browsing movies at [http://localhost/movies](http://localhost/movies)

---

## Running Tests

To run the automated tests

```bash
./vendor/bin/sail artisan test
```

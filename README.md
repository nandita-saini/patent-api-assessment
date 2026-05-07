# Patent API Assessment

A backend REST API built using CakePHP 5 and PostgreSQL for importing, analyzing, and querying patent data related to Artificial Intelligence patents.

The project uses Docker and Docker Compose for containerized setup and includes a Python script for importing CSV data into PostgreSQL.

---

# Tech Stack

- PHP 8
- CakePHP 5
- PostgreSQL 15
- Docker
- Docker Compose
- Python 3
- pandas
- SQLAlchemy

---

# Project Features

- Import patent dataset into PostgreSQL
- REST API built with CakePHP
- Query patent records using filters
- Summary statistics endpoint
- Dockerized application setup
- JSON API responses

---

# Project Structure

patent-api/
├── config/
├── dataset/
│   └── patents.csv
├── scripts/
│   └── import_patents.py
├── src/
│   └── Controller/
│       └── ApiController.php
├── templates/
├── tests/
├── webroot/
├── docker-compose.yml
├── Dockerfile
├── composer.json
└── README.md


---

# Setup Instructions

## 1. Clone Repository

# bash
git clone <your-github-repository-url>
cd patent-api


---

## 2. Start Docker Containers

# bash
docker-compose up -d


This command starts:

* CakePHP application container
* PostgreSQL database container

Application URL:


http://localhost:8765


---

# Database Configuration

PostgreSQL configuration used in the project:

| Key      | Value    |
| -------- | -------- |
| Host     | db       |
| Port     | 5432     |
| Database | patents  |
| Username | postgres |
| Password | password |

---

# Install Python Dependencies

Install required Python packages:

# bash
pip3 install pandas sqlalchemy psycopg2-binary

---

# Import Patent Dataset

The dataset is stored in:

dataset/patents.csv

Run the import script:

# bash
python3 scripts/import_patents.py

Expected output:

Import completed successfully

---

# API Endpoints

## 1. Summary Endpoint

Returns:

* Total patents
* Patent type distribution

### Endpoint

GET /summary

### Example Request

http://localhost:8765/summary

### Sample Response

# json
{
  "success": true,
  "total_patents": 999,
  "patent_types": [
    {
      "patent_type": "A1",
      "count": 818
    },
    {
      "patent_type": "B2",
      "count": 103
    }
  ]
}

---

## 2. Query Endpoint

Filters patent records based on query parameters.

Supports:

* assignee
* patent_type
* year

---

### Query by Assignee

GET /query?assignee=Microsoft

Example:http://localhost:8765/query?assignee=Microsoft

---

### Query by Patent Type

GET /query?patent_type=A1

Example:http://localhost:8765/query?patent_type=A1

---

### Query by Year


GET /query?year=2025


Example:http://localhost:8765/query?year=2025


---

### Combined Filters

GET /query?assignee=Microsoft&patent_type=B2


Example:http://localhost:8765/query?assignee=Microsoft&patent_type=B2

---

# Docker Commands

## Start Containers

# bash
docker-compose up -d


## Stop Containers

# bash
docker-compose down


## Restart Containers

# bash
docker-compose restart


---

# Notes

* API responses are returned in JSON format.
* PostgreSQL is used as the primary database.
* Patent dataset contains 999 records.
* Missing values are cleaned during import.
* Query results are limited to 50 records for performance purposes.

---

# Future Improvements

Possible improvements for the project:

* Input validation
* Pagination
* Query caching
* Additional analytics endpoints
* Authentication

---

# Postman Collection

The exported Postman collection is included in the repository as:

postman_collection.json

---

# Developer

Nandita

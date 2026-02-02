# Carrier API (POC)

A logistics engine built with **Laravel 11**. This project demonstrates an approach to carrier rate calculation and asynchronous label processing.

---

## Key Features

* **Smart Rate Engine:** Calculates the cheapest shipping rate based on parcel weight.
* **Tie-Breaker Logic:** Automatically prefers carriers with higher weight capacity if prices are identical.
* **Asynchronous Processing:** Uses **Laravel Queues** to handle "heavy" label generation tasks in the background, keeping the API lightning-fast.
* **Professional API Docs:** Self-documenting API using **Scribe**, including an interactive "Try It Out" console.
* **Reliable Validation:** Custom FormRequests for strict input sanitization.

## Technical Stack & Patterns

- **PHP 8.2+ / Laravel 11**
- **Service Layer Pattern:** Business logic is decoupled from Controllers to remain DRY and testable.
- **Background Workers:** Database-driven queues for non-blocking task execution.
- **API Resources:** Clean JSON transformation layer.
- **CORS Configured:** Ready for frontend integration.

## Installation

1. **Clone & Install:** 
    git clone https://github.com/Sqelson/laravel-php-poc.git
    composer install

2. **Setup Environment:**
    cp .env.example .env
    php artisan key:generate

3. **Database and Migrations:**
    - Create a database in Laragon/HeidiSQL (e.g., api_project)
    - Update .env with your database credentials.
    - Run migrations and seed the carrier data: php artisan migrate --seed

4. **Run the Worker:**
    - In a separate terminal: php artisan queue:work

## Usage / Testing
    - Interactive Docs: Visit http://api-project.test/docs to test the API directly from the browser.
    - Manual Test: Send a POST request to /api/v1/quote with a JSON body:

    JSON
    {
        "weight": 12.5
    }

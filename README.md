# Car Booking System

A responsive PHP website and admin panel for Pocket Luxury Travel. The public site includes the homepage, Journey to Prayagraj page, fleet page, reviews page, partner page, about page, and Book Force Urbania page. The admin panel manages bookings, vehicles, reviews, gallery items, destinations, and partner leads.

## Local preview

1. Open a terminal in `C:\Users\DELL\Desktop\Car Booking System`
2. Run `php -S localhost:8000`
3. Open `http://localhost:8000`

## Admin login

Admin login now uses the `admins` table in MySQL.

Example insert:

```sql
INSERT INTO admins (name, email, password_hash)
VALUES (
    'Pocket Admin',
    'admin@pocketluxurytravel.com',
    '$2y$10$wD3ohsRVubkjmjB7p8AjseNaxDRh7FgkMNbZIzkvRv0.OJc2z1Oeq'
);
```

## Storage

- Local preview uses JSON files inside `storage/`
- Booking records now capture both pickup date and pickup time in local storage and in `database/schema.sql`
- Production deployment can move the same collections into MySQL using `database/schema.sql`
- Gallery and review forms accept Cloudinary URLs so assets can be managed without changing templates

## MySQL setup

- Database config file: `config/database.php`
- Reusable connection file: `includes/db.php`
- Use `db()` anywhere after bootstrap to get a PDO MySQL connection
- Environment overrides supported: `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, `DB_CHARSET`

## WhatsApp status notifications

- In admin booking status updates, `confirmed` and `cancelled` open WhatsApp to the customer phone with a ready message
- The WhatsApp business number used in the message is `+919234670937`
- Booking submit now shows a browser alert: `Your booking submitted successfully.`

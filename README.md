# Laravel API Test
[Тестовое задание](https://drive.google.com/drive/folders/0ByqxhUNvccJxdTdROE5aX3VSOWc?resourcekey=0-Cf8K_Zu0DCnnhfFs3aokDQ) 

## Стек

- **Backend:** Laravel 12, PHP 8.2+
- **Frontend:** Vue 3, Inertia.js, TypeScript, Vite, Element Plus
- **Окружение:** [Laravel Sail](https://laravel.com/docs/sail) Для скорости разработки

## Установка

```bash
composer setup
```

Скрипт установит зависимости, скопирует `.env.example` в `.env`, сгенерирует ключ, выполнит миграции, установит npm-зависимости и соберёт фронтенд.

## Запуск через Sail:

```bash
./vendor/bin/sail up -d
./vendor/bin/sail npm run dev
```

## API

- **GET** `/api/properties` — список объектов недвижимости с фильтрами:
  - `name` — поиск по названию
  - `price` — массив `[min, max]`
  - `bedrooms`, `bathrooms`, `storeys`, `garages` — число комнат/ванных/этажей/гаражей

## Тесты и линтер

```bash
composer test   # PHPUnit + Pint
npm run lint    # ESLint
```

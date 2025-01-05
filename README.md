<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Test work for Smart

Для того что бы запустить проект, скопируйте файл .env.example внесите свои данные от базы данных.  
Воспользуйтесь докером запустив команду docker compose up -d . В папке с репозиторием установлены все настройки для него.
  
Затем необходимо запустить команду php artisan key:generate  
После распакуйте содержимое архива films в папку `storage/app/public` там находится плейсхолдер для фильмов  
---
После чего выполните миграции + сидеры  
```javascript
php artisan migrate --seed
```

## Genres

Документация по маршрутам  Genres
- `GET` `${API_URL}/api/genres` - return genres
```javascript
{
  "success": true,
      "data": [
    {
      "id": 1,
      "name": "Ullam",
      "slug": "ullam"
    },
    {
      "id": 2,
      "name": "Qui",
      "slug": "qui"
    },
    {
      "id": 3,
      "name": "Optio",
      "slug": "optio"
    },
    {
      "id": 4,
      "name": "Facilis",
      "slug": "facilis"
    },
    {
      "id": 5,
      "name": "Quia",
      "slug": "quia"
    },
    {
      "id": 6,
      "name": "Sapiente",
      "slug": "sapiente"
    },
    {
      "id": 7,
      "name": "Incidunt",
      "slug": "incidunt"
    },
    {
      "id": 8,
      "name": "Enim",
      "slug": "enim"
    },
    {
      "id": 9,
      "name": "Id",
      "slug": "id"
    },
    {
      "id": 10,
      "name": "Rerum",
      "slug": "rerum"
    },
    {
      "id": 11,
      "name": "Aut",
      "slug": "aut"
    },
    {
      "id": 12,
      "name": "Autr",
      "slug": "autr"
    }
  ]
}
```
- `GET` `${API_URL}/api/genres/${slug}` - return films by selected category
```javascript
{
  "success": true,
      "name": "Sapiente",
      "data": [
    {
      "id": 1,
      "name": "Dolor et rem expedita.",
      "thumbnail": "http:\/\/localhost\/storage\/films\/placeholder.png"
    },
    {
      "id": 3,
      "name": "Sed fuga sapiente.",
      "thumbnail": "http:\/\/localhost\/storage\/films\/placeholder.png"
    },
    {
      "id": 6,
      "name": "Neque omnis earum est.",
      "thumbnail": "http:\/\/localhost\/storage\/films\/placeholder.png"
    },
    {
      "id": 8,
      "name": "Quos nihil tempore quaerat.",
      "thumbnail": "http:\/\/localhost\/storage\/films\/placeholder.png"
    },
    {
      "id": 10,
      "name": "Voluptatum modi delectus iusto.",
      "thumbnail": "http:\/\/localhost\/storage\/films\/placeholder.png"
    },
    {
      "id": 11,
      "name": "Consequatur consectetur rerum nobis similique.",
      "thumbnail": "http:\/\/localhost\/storage\/films\/placeholder.png"
    },
    {
      "id": 12,
      "name": "Sequi eos asperiores.",
      "thumbnail": "http:\/\/localhost\/storage\/films\/placeholder.png"
    },
    {
      "id": 13,
      "name": "Pariatur quasi qui.",
      "thumbnail": "http:\/\/localhost\/storage\/films\/placeholder.png"
    },
    {
      "id": 14,
      "name": "Quis asperiores recusandae occaecati.",
      "thumbnail": "http:\/\/localhost\/storage\/films\/placeholder.png"
    },
    {
      "id": 15,
      "name": "Repellendus veniam ut.",
      "thumbnail": "http:\/\/localhost\/storage\/films\/placeholder.png"
    }
  ],
      "meta": {
    "current_page": 1,
        "last_page": 7,
        "total": 65
  }
}
```
-  `POST`  `${API_URL}/api/genres` - Добавить новую category
```javascript
"Передавать в форме";
name:"Вестерн"
```
```javascript
{
  "success": true,
      "data": {
    "id": 14,
        "name": "Вестерн",
        "slug": "vestern"
  }
}
```

-  `PATCH/PUT`  `${API_URL}/api/genres/${slug}` - Обновить category
```javascript
"Передавать в форме"
name:'Новое имя категории'
```

```javascript
{
  "success": true,
      "data": {
        "id": 3,
        "name": "Новаякатегория",
        "slug": "novaiakategoriia"
  }
}
```


-  `DELETE`  `${API_URL}/api/genres/${slug}` - Удалить category


```javascript
204 "No content"
```

## Films

Документация по маршрутам  Films  

-  `GET`  `${API_URL}/api/films` - Возвращает все фильмы 


```javascript
{
  "success": true,
      "data": [
    {
      "id": 3,
      "name": "Sed fuga sapiente.",
      "thumbnail": "http:\/\/localhost\/storage\/films\/placeholder.png"
    },
    {
      "id": 4,
      "name": "Natus modi.",
      "thumbnail": "http:\/\/localhost\/storage\/films\/placeholder.png"
    },
    {
      "id": 12,
      "name": "Sequi eos asperiores.",
      "thumbnail": "http:\/\/localhost\/storage\/films\/placeholder.png"
    },
    {
      "id": 14,
      "name": "Quis asperiores recusandae occaecati.",
      "thumbnail": "http:\/\/localhost\/storage\/films\/placeholder.png"
    },
    {
      "id": 15,
      "name": "Repellendus veniam ut.",
      "thumbnail": "http:\/\/localhost\/storage\/films\/placeholder.png"
    },
    {
      "id": 16,
      "name": "Architecto ea est repellendus.",
      "thumbnail": "http:\/\/localhost\/storage\/films\/placeholder.png"
    },
    {
      "id": 20,
      "name": "Veritatis illum id et.",
      "thumbnail": "http:\/\/localhost\/storage\/films\/placeholder.png"
    },
    {
      "id": 23,
      "name": "Reprehenderit et assumenda sint fugit.",
      "thumbnail": "http:\/\/localhost\/storage\/films\/placeholder.png"
    },
    {
      "id": 25,
      "name": "Nihil dolores rerum animi.",
      "thumbnail": "http:\/\/localhost\/storage\/films\/placeholder.png"
    },
    {
      "id": 27,
      "name": "Nihil blanditiis eos ut.",
      "thumbnail": "http:\/\/localhost\/storage\/films\/placeholder.png"
    }
  ],
      "meta": {
    "current_page": 1,
        "per_page": 10,
        "last_page": 6,
        "total": 51
  }
}
```


-  `GET`  `${API_URL}/api/films/${id}` - найдет фильм по id
```javascript
if не опубликован route return 404;
```

```javascript
{
  "success": true,
      "data": {
    "id": 4,
        "name": "Natus modi.",
        "thumbnail": "http:\/\/localhost\/storage\/films\/placeholder.png"
  }
}
```
-  `POST`  `${API_URL}/api/films` - создать новый фильм
```javascript
"В форму нужно передавать данный обьект";
{
  title:"Строка"
  category:'slug - category'
  thumbnail: 'Новая картинка'
}
Если картинка не будет передана запишется стандартный плейсхолдер
```

```javascript
{
  "success": true,
      "data": {
        "id": 4,
        "name": "Natus modi.",
        "thumbnail": "http:\/\/localhost\/storage\/films\/placeholder.png"
  }
}
```

-  `PATCH/PUT`  `${API_URL}/api/films/${id}` - обновить фильм
```javascript
"В форму нужно передавать данный обьект";
{
  title:"Строка"
  category:'slug - category'
  thumbnail: 'Новая картинка'
}
Если картинка не будет передана она останется прежней
```

```javascript
{
  "success": true,
      "data": {
        "id": 4,
        "name": "Natus modi.",
        "thumbnail": "http:\/\/localhost\/storage\/films\/placeholder.png"
  }
}
```

-  `DELETE`  `${API_URL}/api/films/${id}` - обновить фильм
```javascript
204 - No Content
```

- `GET` `${API_URL}/api/films/${id}/publish` - опубликовать фильм
```javascript
{
	"success": true,
	"data": {
		"id": 6,
		"name": "Neque omnis earum est.",
		"thumbnail": "http:\/\/localhost\/storage\/films\/placeholder.png"
	}
}
```



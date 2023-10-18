# Хостинги для Synology Download station
На данный момент только LostFilm. Позволяет автоматически скачивать релизы через RSS

# Установка
* Скачать последнюю версию lostfilm.host со страницы [релизов](https://github.com/evd/synology-hosts/releases)
* В настройках Download Station в разделе "хостинг файлов" добавить скачанный файл
* В редатировании указать логин и пароль
    - Логин можно узнать в профиле (мой ID)
    - Пароль в открывшемся окне (выбор качества) при скачивании любого релиза кливнув по usess внизу рядом со значком RSS
* В каналы RSS добавить http://insearch.site/rssdd.xml (актуальный URL в окне выбора качества при скачивании любого релиза)
* Для автоматиеского скачивания добавить в фильтр загрузки по каждому сериалу:
  - Название - любое наименование
  - Совпадения - Stranger Things.*1080p (скачивать только в качестве 1080p)
  - Не совпадает - E999 (не скачивать когда выйдет сезон целиком)
  - Анализ с помощью регулярных выражений - поставить чекбокс
  

# Hosts for Synology Download station

### Contains
* Lostfilm RSS downloads
    
### Build
Run build.sh script

### Debug
1. Copy env.example.php to env.php
2. Setup credentials in env.php
3. Run php test.php

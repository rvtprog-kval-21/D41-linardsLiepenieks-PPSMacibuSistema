

# SIA “Pirmā programmēšanas skola” Mācību sistēmas izveide ar automatizētu uzdevumu risināšanu

## Projekta apraksts
PIKC "Rīgas Valsts tehnikums" kvalifikācijas darbs.
Mērķis - izveidot mācību sistēmu uzņēmumam "Pirmā programmēšanas skola" (Turpmāk "PPS")

    
## Izmantotās tehnoloģijas
- Laravel
- Vuejs
- SQLite
- Judge0 API
- NodeJS
- MySQL
- Composer
- HTML
- CSS
- Bootstrap
- JS
- AJAX
- Blade

## Izmantotie avoti
- Laravel ietvara apguvei izgāju kursu: https://www.youtube.com/watch?v=ImtZ5yENzgE
- Laravel ietvara dokumentācija - https://laravel.com/docs/8.x
-	VUE.js dokumentācija - https://vuejs.org/v2/guide/
-	CodeMirror koda redaktors - https://codemirror.net/
-	TinyMCE teksta redaktors - https://www.tiny.cloud/
-	Composer dependeny manager - https://getcomposer.org/
-	NodeJS - https://nodejs.org/en/docs/
-	MorrisJS - https://morrisjs.github.io/morris.js/
-	Judge0 - https://judge0.com/
-	Bootstrap ietvars - https://getbootstrap.com/
-	AdminLTE veidne - https://adminlte.io/



## Instalācija

### Sistēmai vajadzīgās programmas
* [Composer](https://getcomposer.org/)
* [NodeJS](hhttps://nodejs.org/en/)

### Uzstādīšana caur windows cmd
**Sekojot šīm instrukcijām jāatrodas mapē, kurā esat klonējuši github projektu!**
(Šis paredzēts, lai uzstādītu sistēmu uz lokālās mašīnas testa servera)
1. Instalēt failus no composer

`composer install`

2. Instalēt failus ar npm

`npm install`

3. izveidot env faila kopiju no env.example

`cp .env.example .env`

4. Izveidot datubāzi

`database` mapē izveidojiet failu ar nosaukumus `database.sqlite`

5. Uzstādīt datubāzi .env failā

`.env` failā izdzēst:

`DB_CONNECTION=mysql
 DB_HOST=127.0.0.1
 DB_PORT=3306
 DB_DATABASE=prakse4   
 DB_USERNAME=root 
 DB_PASSWORD=`

Tā vietā ierakstīt:

`DB_CONNECTION=sqlite`

6. Mainīt queue draiveri .env failā

Nomainīt:

`QUEUE_CONNECTION=sync`

Uz:

`QUEUE_CONNECTION=database`

7. Ģenerēt aplikācijas šifrēšanas atslēgu

`php artisan key:generate`

8. Migrēt datubāzi

`php artisan migrate`

### Palaist programmu

**Katru no minētajiem procesiem startēt savā cmd logā un nevērt logus ciet!!!**

1. Palaist vebserveri

`php artisan serve`

2. Palaist fona procesus

`php artisan queue:work`

3. Palaist npm

`npm run watch`

4. Pieslēgties aplikācijai

Tīmekļa pārlūkā dodaties uz ip adresi kas tika parādīta palaižot vebserveri

### Uzstādīt admin profilu


Caur mājaslapu izveidot profilu spiežot uz pogas "Register"

1. atvērt artisan tinker

`php artisan tinker`

2. Saglabāt lietotāju mainīgajā

`$user = User::Where('id', 1)->first();`

(where('id', 1) kur cipars 1 norāda uz user->id, ja vēlaties mainīt citu user atrodiet tā ID ar `User::All()` Komandu
 
3. Mainīt objekta admin parametru

`$user->admin = 1;`

4. Saglabāt izmaiņas datubāzē

`$user->save();`






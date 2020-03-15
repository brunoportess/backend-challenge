# Desafio back-end da mLearn

<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

- Sistema criado com Laravel 7.
- Para garantir o funcionamento do projeto caso não esteja usando Homestead, tenha certeza que está seguindo os seguintes requerimento em sua máquina:

    MariaDB ou MySQL
    
    Composer
    
    PHP >= 7.2.5

    BCMath PHP Extension

    Ctype PHP Extension

    Fileinfo PHP extension

    JSON PHP Extension

    Mbstring PHP Extension

    OpenSSL PHP Extension

    PDO PHP Extension

    Tokenizer PHP Extension

    XML PHP Extension
    
- OBS: Caso esteja usando linux, para garantir a executar do comando **composer install** primeiramente instale algumas bibliotecas necessários com o seguinte comando:
    
        apt install php7.2-common php7.2-cli php7.2-gd php7.2-mysql php7.2-curl php7.2-intl php7.2-mbstring php7.2-bcmath php7.2-imap php7.2-xml php7.2-zip
    
- Para executar o projeto siga os seguintes passos:

    1 - Clone ou faça download do projeto
    
    2 - Acesse a pasta do projeto
    
    3 - Faça a instalação das bibliotecas do projeto com o comando abaixo 
        
        composer install
    
    4 - Crie uma cópia do arquivo **.env.example** com o nome **.env**
    
        Windows: copy .env.example .env
        Linux: cp .env.example .env
    
    5 - No arquivo **.env** configure as variáveis de conexão do banco de dados
    
        DB_HOST = Ip/Hostname do servidor de banco de dados (ex: 127..0.0.1)
        DB_PORT = Porta de comuicação com banco de dados (padrão: 3306)
        DB_DATABASE = Nome do banco de dados (ex: desafio_bruno_portes)
        DB_USERNAME = Nome de usuário para conectar no banco de dados
        DB_PASSWORD = Senha do usuário de conexão do banco de dados
    
    6 - Gere uma nova chave para a aplicação com o comand **php artisan key:generate** 
    
    7 - Esteja conectado na internet, pois é utilizado algumas biblioetcas via CDN
    
    8 - Para evitar quaisquer problema na execução do projeto, execute os comandos de limpeza de cache
        
        php artisan route:cache
        php artisan cache:clear
        php artisan config:cache
        php artisan view:clear
        
    9 - Crie o banco de dados, garantindo que o usuario/senha configurado tenham acsso a bse criada e em seguida gere as tabelas com o comando:
        
        php artisan migrate       
    
    10 - Inicie a aplicação com o comando:
    
        php artisan serve
        
-  Ambos os desafios foram feitos utilizando PHP e Jquery.

 - As requisições foram executadas via axios e o consumo da API da mLearn consumida utilizando cURL para evitar a dependência de biblioetca de terceiros
 

